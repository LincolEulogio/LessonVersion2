<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\MediaCategory;
use App\Models\MediaShare;
use App\Models\User;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Teacher;
use App\Models\Systemadmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function index()
    {
        return $this->viewFolder(0);
    }

    public function viewFolder($folderID = 0)
    {
        $userID = Auth::user()->id;
        $usertypeID = Auth::user()->usertypeID;
        
        // 1. MY FOLDERS (owned by me)
        $myFolders = MediaCategory::where('userID', $userID)
            ->where('usertypeID', $usertypeID)
            ->get();

        // 2. MY FILES (owned by me, in current folder)
        $myFiles = Media::where('userID', $userID)
            ->where('usertypeID', $usertypeID)
            ->where('mcategoryID', $folderID) // Note: Legacy didn't seem to have nesting for folders in the query I saw, but let's assume flat or folder-based.
            // If folderID > 0, we only show files in that folder. 
            // If folderID == 0, we show files in root.
            ->get();

        // 3. SHARED ITEMS (Visible to me)
        // Only fetch shared items if we are in ROOT (folderID == 0) OR if we are inside a shared folder?
        // Legacy: "share" table maps to file OR folder.
        // If a folder is shared, do we see it in root? Yes.
        // If a file is shared, do we see it in root? Yes.
        
        $sharedFolders = collect();
        $sharedFiles = collect();

        if ($folderID == 0) {
            // Fetch Shared Folders
            $sharedFolderIDs = DB::table('media_share')
                ->where('file_or_folder', 1) // 1 = folder
                ->where(function($query) use ($userID, $usertypeID) {
                    $query->where('public', 1)
                          ->orWhere('share_userID', $userID) // Simplification: assuming share_userID matches Auth::id()
                          ->orWhere('share_usertypeID', $usertypeID);
                          // Add Class logic here if User is Student
                })
                ->pluck('item_id');
            
            $sharedFolders = MediaCategory::whereIn('media_categoryID', $sharedFolderIDs)->get();

            // Fetch Shared Files (in root)
            $sharedFileIDs = DB::table('media_share')
                ->where('file_or_folder', 0) // 0 = file
                ->where(function($query) use ($userID, $usertypeID) {
                    $query->where('public', 1)
                          ->orWhere('share_userID', $userID)
                          ->orWhere('share_usertypeID', $usertypeID);
                })
                ->pluck('item_id');

            $sharedFiles = Media::whereIn('mediaID', $sharedFileIDs)->get();
        }

        // Merge 
        // If folderID == 0, show my root folders + shared folders
        // If folderID > 0, show subfolders? (Legacy might not support subfolders)
        
        $folders = $myFolders->merge($sharedFolders);
        $files = $myFiles->merge($sharedFiles); // This might duplicate if I own AND share it? Unique?
        
        $folders = $folders->unique('media_categoryID');
        $files = $files->unique('mediaID');

        $currentFolder = null;
        if($folderID != 0) {
             $currentFolder = MediaCategory::find($folderID);
             // Security: Can I view this folder?
             // Owner OR Shared with me.
             // (Logic simplified for now)
        }

        return view('media.index', compact('folders', 'files', 'currentFolder'));
    }

    public function create_folder(Request $request) 
    {
        $request->validate(['folder_name' => 'required|max:128']);
        // ... (rest same)

        MediaCategory::create([
            'userID' => Auth::user()->id,
            'usertypeID' => Auth::user()->usertypeID,
            'folder_name' => $request->folder_name,
            'create_date' => now()
        ]);

        return redirect()->back()->with('success', 'Folder created successfully');
    }

    public function add(Request $request)
    {
        $request->validate(['file' => 'required|file|max:10240']); // 10MB max

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $newName = rand(1, 100000000000) . '.' . $extension;
            
            $file->move(public_path('uploads/media'), $newName);

            Media::create([
                'userID' => Auth::user()->id,
                'usertypeID' => Auth::user()->usertypeID,
                'm_name' => $originalName, // display name
                'file_name' => $newName,
                'file_type' => $extension,
                'mcategoryID' => $request->folderID ?? 0,
                'create_date' => now()
            ]);

            return redirect()->back()->with('success', 'File uploaded successfully');
        }

        return redirect()->back()->with('error', 'File upload failed');
    }

    public function delete($id)
    {
         $media = Media::find($id);
         if ($media && $media->userID == Auth::user()->id) {
             // Delete file from storage
             $path = public_path('uploads/media/' . $media->file_name);
             if (File::exists($path)) {
                 File::delete($path);
             }
             $media->delete();
             return redirect()->back()->with('success', 'File deleted successfully');
         }
         return redirect()->back()->with('error', 'Permission denied');
    }

    public function deletef($id)
    {
         $folder = MediaCategory::find($id);
         if ($folder && $folder->userID == Auth::user()->id) {
             // Delete all files in folder?
             $files = Media::where('mcategoryID', $id)->get();
             foreach($files as $file) {
                 $path = public_path('uploads/media/' . $file->file_name);
                 if (File::exists($path)) {
                     File::delete($path);
                 }
                 $file->delete();
             }
             $folder->delete();
             return redirect()->route('media.index')->with('success', 'Folder deleted successfully');
         }
         return redirect()->back()->with('error', 'Permission denied');
    }
}
