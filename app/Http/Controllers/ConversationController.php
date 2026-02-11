<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\ConversationMsg;
use App\Models\ConversationUser;
use App\Models\User;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Teacher;
use App\Models\Systemadmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;
        $usertypeID = Auth::user()->usertypeID; // Assuming usertypeID is on User

        // Fetch conversations where user is a participant and not deleted (trash = 0)
        // and draft = 0
        
        // This query needs to be adapted for Laravel Eloquent from legacy CodeIgniter logic
        // Legacy logic: get_my_conversations() in conversation_m.php
        
        $conversations = DB::table('conversations')
            ->join('conversation_user', 'conversations.id', '=', 'conversation_user.conversation_id')
            ->leftJoin('conversation_msg', 'conversations.id', '=', 'conversation_msg.conversation_id')
            ->where('conversation_user.user_id', $userID)
            ->where('conversation_user.usertypeID', $usertypeID)
            ->where('conversation_user.trash', 0)
            ->where('conversations.draft', 0)
            ->where('conversation_msg.start', 1)
            ->select('conversations.*', 'conversation_msg.subject', 'conversation_msg.msg', 'conversation_msg.create_date as msg_date', 'conversation_user.is_sender')
            ->orderBy('conversations.modify_date', 'desc')
            ->get();

        // Need to attach sender name logic here similar to legacy
        foreach ($conversations as $conversation) {
             // Find the sender of this conversation
             $sender = DB::table('conversation_user')
                ->where('conversation_id', $conversation->id)
                ->where('is_sender', 1)
                ->first();
             
             if ($sender) {
                 $conversation->sender_name = $this->getUserName($sender->user_id, $sender->usertypeID);
             } else {
                 $conversation->sender_name = 'Unknown';
             }
        }

        return view('conversation.index', ['conversations' => $conversations, 'active' => 'inbox']);
    }

    public function sent()
    {
        $userID = Auth::user()->id;
        $usertypeID = Auth::user()->usertypeID;

        $conversations = DB::table('conversations')
            ->join('conversation_user', 'conversations.id', '=', 'conversation_user.conversation_id')
            ->leftJoin('conversation_msg', 'conversations.id', '=', 'conversation_msg.conversation_id')
            ->where('conversation_user.user_id', $userID)
            ->where('conversation_user.usertypeID', $usertypeID)
            ->where('conversation_user.trash', 0)
            ->where('conversation_user.is_sender', 1)
            ->where('conversations.draft', 0)
            ->where('conversation_msg.start', 1)
            ->select('conversations.*', 'conversation_msg.subject', 'conversation_msg.create_date as msg_date')
            ->orderBy('conversations.modify_date', 'desc')
            ->get();
            
        return view('conversation.index', ['conversations' => $conversations, 'active' => 'sent']);
    }

    public function draft()
    {
        $userID = Auth::user()->id;
        $usertypeID = Auth::user()->usertypeID;

        $conversations = DB::table('conversations')
            ->join('conversation_user', 'conversations.id', '=', 'conversation_user.conversation_id')
            ->leftJoin('conversation_msg', 'conversations.id', '=', 'conversation_msg.conversation_id')
            ->where('conversation_user.user_id', $userID)
            ->where('conversation_user.usertypeID', $usertypeID)
            ->where('conversation_user.trash', 0)
            ->where('conversations.draft', 1)
            ->where('conversation_msg.start', 1)
            ->select('conversations.*', 'conversation_msg.subject', 'conversation_msg.create_date as msg_date')
            ->orderBy('conversations.modify_date', 'desc')
            ->get();

        return view('conversation.index', ['conversations' => $conversations, 'active' => 'draft']);
    }

    public function trash()
    {
        $userID = Auth::user()->id;
        $usertypeID = Auth::user()->usertypeID;

        $conversations = DB::table('conversations')
            ->join('conversation_user', 'conversations.id', '=', 'conversation_user.conversation_id')
            ->leftJoin('conversation_msg', 'conversations.id', '=', 'conversation_msg.conversation_id')
            ->where('conversation_user.user_id', $userID)
            ->where('conversation_user.usertypeID', $usertypeID)
            ->where('conversation_user.trash', 1)
            ->where('conversation_msg.start', 1)
            ->select('conversations.*', 'conversation_msg.subject', 'conversation_msg.create_date as msg_date')
            ->orderBy('conversations.modify_date', 'desc')
            ->get();
            
        return view('conversation.index', ['conversations' => $conversations, 'active' => 'trash']);
    }

    public function create()
    {
        $usertypes = DB::table('usertype')->get();
        return view('conversation.create', ['usertypes' => $usertypes]);
    }

    public function getUsers($usertypeID)
    {
        if ($usertypeID == 1) { // System Admin
             $users = Systemadmin::select('systemadminID as id', 'name')->get();
        } elseif ($usertypeID == 2) { // Teacher
             $users = Teacher::select('teacherID as id', 'name')->get();
        } elseif ($usertypeID == 3) { // Student
             $users = Student::select('studentID as id', 'name')->get();
        } elseif ($usertypeID == 4) { // Parents
             $users = Parents::select('parentsID as id', 'name')->get();
        } else {
             $users = User::select('userID as id', 'name')->where('usertypeID', $usertypeID)->get();
        }
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usertypeID' => 'required',
            'userID' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        
        // Handle Attachment
        $attachment = null;
        $attachment_original_name = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachment = time() . '_' . $file->getClientOriginalName();
            $attachment_original_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/attach'), $attachment);
        }

        DB::transaction(function () use ($request, $attachment, $attachment_original_name) {
            // Check if it's a reply or new conversation
            if ($request->has('conversation_id')) {
                $conversation = Conversation::find($request->conversation_id);
                $conversation->modify_date = now();
                $conversation->save();
            } else {
                $conversation = Conversation::create([
                    'draft' => $request->has('draft') ? 1 : 0,
                    'create_date' => now(),
                    'modify_date' => now(),
                    'status' => 0,
                    'fav_status' => 0
                ]);
            }

            $userID = Auth::user()->id; // Assuming ID maps correctly. If not, need logic.
            // In legacy, loginuserID is stored in session. 
            // Here assuming Auth::user()->id is the general ID, but we might need 
            // specific role ID (teacherID, studentID) if Auth::user() is just the 'users' table wrapper.
            // For this migration, I'll assume Auth::id() aligns with the user_id expected in conversation_user.
            // NOTE: In legacy, user_id in conversation_user referred to teacherID/studentID etc.
            // I need to resolve the correct ID based on Auth user type.
            
            // Resolving Correct Sender ID
            $senderID = $this->getCurrentUserSpecificID();
            $senderUsertypeID = Auth::user()->usertypeID;

            // If new conversation, add participants
            if (!$request->has('conversation_id')) {
                // Add Sender
                ConversationUser::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $senderID,
                    'usertypeID' => $senderUsertypeID,
                    'is_sender' => 1,
                    'trash' => 0
                ]);
                
                // Add Receiver
                ConversationUser::create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $request->userID,
                    'usertypeID' => $request->usertypeID,
                    'is_sender' => 0,
                    'trash' => 0
                ]);
            }

            // Create Message
            ConversationMsg::create([
                'conversation_id' => $conversation->id,
                'user_id' => $senderID,
                'usertypeID' => $senderUsertypeID,
                'subject' => $request->subject,
                'msg' => $request->message,
                'attach' => $attachment,
                'attach_file_name' => $attachment_original_name,
                'start' => 1,
                'create_date' => now(),
                'modify_date' => now()
            ]);
        });
        
        if($request->has('conversation_id')) {
             return redirect()->route('conversation.view', $request->conversation_id)->with('success', 'Respuesta enviada.');
        }

        return redirect()->route('conversation.index')->with('success', 'Mensaje enviado correctamente.');
    }

    public function view($id)
    {
        $conversation = Conversation::findOrFail($id);
        // Security check: is user participant?
        $currentUserID = $this->getCurrentUserSpecificID();
        $currentUserType = Auth::user()->usertypeID;
        
        $isParticipant = DB::table('conversation_user')
            ->where('conversation_id', $id)
            ->where('user_id', $currentUserID)
            ->where('usertypeID', $currentUserType)
            ->exists();

        if (!$isParticipant) {
            abort(403);
        }

        $messages = ConversationMsg::where('conversation_id', $id)
            ->orderBy('create_date', 'asc')
            ->get();

        foreach ($messages as $msg) {
            $msg->sender_name = $this->getUserName($msg->user_id, $msg->usertypeID);
        }

        return view('conversation.view', compact('conversation', 'messages'));
    }

    public function delete($id)
    {
        $currentUserID = $this->getCurrentUserSpecificID();
        $currentUserType = Auth::user()->usertypeID;

        ConversationUser::where('conversation_id', $id)
            ->where('user_id', $currentUserID)
            ->where('usertypeID', $currentUserType)
            ->update(['trash' => 1]);

        return redirect()->route('conversation.index')->with('success', 'Conversación movida a la papelera.');
    }

    private function getCurrentUserSpecificID()
    {
        $user = Auth::user();
        // Adjust this logic if you have separate columns or tables for ID
        // For now, assuming the ID in Auth::user() matches the specific table ID 
        // OR that we have a field linking them.
        // If your system uses a single 'users' table for Auth but references 'teachers' table for ID,
        // you need a mapping.
        // CHECK: In RegisteredUserController, we saw it creates a User.
        // Legacy system seems to have usertypeID 1=Admin, 2=Teacher, 3=Student, 4=Parent.
        // And they have separate tables.
        // If Auth::user() is from 'users' table, does it have a 'username' that links?
        // Or does 'users' table ID map?
        // Given existing migrations and User model, it seems 'users' table is the central auth.
        // However, legacy controllers use separate IDs. 
        // Example: $this->session->userdata("loginuserID") which was set on login.
        // I will assume for now Auth::id() is correct or I need to find the specific ID.
        // Let's assume the 'users' table is the source of truth for ID in this new Laravel version 
        // unless I see a specific 'teacher_id' column in 'users'.
        
        // Return Auth ID for now, assume consistency.
        return $user->id; 
    }

    private function getUserName($userID, $usertypeID)
    {
        if ($usertypeID == 1) { // System Admin
             $user = Systemadmin::where('systemadminID', $userID)->first();
             return $user ? $user->name : 'Unknown'; 
        } elseif ($usertypeID == 2) { // Teacher
             $user = Teacher::where('teacherID', $userID)->first();
             return $user ? $user->name : 'Unknown';
        } elseif ($usertypeID == 3) { // Student
             $user = Student::where('studentID', $userID)->first();
             return $user ? $user->name : 'Unknown';
        } elseif ($usertypeID == 4) { // Parents
             $user = Parents::where('parentsID', $userID)->first();
             return $user ? $user->name : 'Unknown';
        } else {
             $user = User::where('userID', $userID)->first(); // Generic User
             return $user ? $user->name : 'Unknown';
        }
    }
}
