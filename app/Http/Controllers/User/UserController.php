<?php

namespace App\Http\Controllers\User;
use app\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportMail;
use Session;
use Config;
use Auth;
use App\User;
use App\Profile;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:User']);
    }
    public function index()
    {
        return view('user.home');
    }

    public function bookinghistory()
    {
        return view('user.bookinghistory');
    }

    public function contactsupport()
    {
        return view('user.contactsupport');
    }

    public function message(MessageRequest $request)
    {
        $details=array(
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        );
        Mail::to(Config::get('mail.from.address'))->send(new SupportMail($details));
        Session::flash('sent','Your message sent successfully ! Our team will contact you soon via email ');
        return redirect()->back();
    }

    public function profile()
    {
        $user=Auth::user();
        $profile=$user->profile;
        return view('user.profile',compact('user','profile'));
    }

    public function updateprofile(ProfileRequest $request)
    {
        $file=$request->file('image')->getClientOriginalName();
        $filename=sprintf('%s%s'.$file,random_int(1,10000),random_int(1,10000));
        $profile=$request->file('image');
        $destination_path=public_path('/profile');
        $profile->move($destination_path,$filename);

        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
        $user->password=Hash::make($request->password);
        $user->update();
        $profile=Profile::where('user_id',$user->id)->first();
        $profile->phone=$request->phone;
        $profile->country=$request->country;
        $profile->zip_code=$request->zip_code;
        $profile->profile_pic=$filename;
        $profile->update();
        if($profile)
        {
            Session::flash('updated','Profile Updated Successfuly');
            return redirect()->back();
        }
    }
}
