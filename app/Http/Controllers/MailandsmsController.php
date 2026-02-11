<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mailandsms;
use App\Models\Mailandsmstemplate;
use App\Models\User;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Teacher;
use App\Models\Systemadmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailandsmsController extends Controller
{
    public function index()
    {
        $messages = Mailandsms::orderBy('create_date', 'desc')->paginate(20);
        return view('mailandsms.index', compact('messages'));
    }

    public function add()
    {
        $usertypes = DB::table('usertype')->get();
        return view('mailandsms.add', compact('usertypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:email,sms',
            'usertypeID' => 'required',
            'message' => 'required'
        ]);

        $users = collect(); // Use collection for easier merging

        // 1. Fetch Users
        if ($request->has('userID') && $request->userID != 'all') {
            // Specific User
             $id = $request->userID;
             $type = $request->usertypeID;
             
             $user = $this->getUserByIdAndType($id, $type);
             if ($user) $users->push($user);

        } elseif ($request->usertypeID == 'all') {
             // ALL Users from ALL tables
             $users = $users->merge(Systemadmin::all())
                            ->merge(Teacher::all())
                            ->merge(Student::all())
                            ->merge(Parents::all())
                            ->merge(User::all());
        } else {
             // ALL Users of Specific Type
             $userTypeID = $request->usertypeID;
             if ($userTypeID == 1) $users = Systemadmin::all();
             elseif ($userTypeID == 2) $users = Teacher::all();
             elseif ($userTypeID == 3) $users = Student::all();
             elseif ($userTypeID == 4) $users = Parents::all();
             else $users = User::where('usertypeID', $userTypeID)->get();
        }

        // 2. Process Sending
        $count = 0;
        foreach ($users as $user) {
            // Determine Email/Phone properties based on model
            $email = $user->email;
            $phone = $user->phone ?? $user->mobile ?? $user->us_phone ?? null; // Adjust based on columns
            
            $sent = false;

            if ($request->type == 'email') {
                if ($email) {
                    // Send Email using Laravel Mail
                    // Note: Ensure Mail is configured in .env. 
                    // Wrapping in try-catch to avoid breaking loop
                    try {
                        // For now using raw for simplicity, can use Mailable class later
                         Mail::raw($request->message, function ($message) use ($email) {
                            $message->to($email)
                                    ->subject('Notificación Escolar'); // Customize subject if needed
                         });
                         $sent = true;
                    } catch (\Exception $e) {
                        // Log error?
                    }
                }
            } elseif ($request->type == 'sms') {
                if ($phone) {
                    $sent = $this->sendSMS($phone, $request->message);
                }
            }
            
            if ($sent) $count++;

            // Log to Database
            // We log the attempt even if it failed? Or only success? Legacy logged all?
            // Migration has no 'status' column, just 'message' and 'create_date'.
            // So it's a history of "Attempted/Sent" messages.
            
            Mailandsms::create([
                'usertypeID' => $request->usertypeID, // Group attempted
                'user_id' => $user->systemadminID ?? $user->teacherID ?? $user->studentID ?? $user->parentsID ?? $user->userID,
                'type' => $request->type,
                'message' => $request->message,
                'year' => date('Y'),
                'create_date' => now()
            ]);
        }

        return redirect()->route('mailandsms.index')->with('success', "Proceso completado. Mensaje enviado a {$count} destinatarios.");
    }

    private function getUserByIdAndType($id, $type)
    {
         if ($type == 1) return Systemadmin::find($id);
         if ($type == 2) return Teacher::find($id);
         if ($type == 3) return Student::find($id);
         if ($type == 4) return Parents::find($id);
         return User::find($id);
    }

    private function sendSMS($to, $message)
    {
        // Placeholder for SMS Gateway integration (Twilio, Clickatell, etc.)
        // Return true to simulate success
        return true; 
    }

    public function view($id)
    {
        $message = Mailandsms::findOrFail($id);
        return view('mailandsms.view', compact('message'));
    }
}
