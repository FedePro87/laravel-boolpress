<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showMailForm()
    {
      return view('mail/mail-form');
    }

    public function sendMail(Request $request){
      $title=$request->title;
      $description=$request->description;
      $user=$request->user();
      $username=$user->name;
      $mail=$user->email;

      Mail::to('federicoprovenziani@gmail.com')->queue(new MailSender($title,$description,$username,$mail));
      return redirect(route('home'))->with('success','Mail inviata!');
    }
}
