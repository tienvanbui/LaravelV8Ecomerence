<?php

namespace App\Http\Controllers\User;

use App\Events\SendEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class UserContactController extends Controller
{
     //display Contact Page Information
    public function contact_view(){
       
        $user_contact_view  = Contact::first();
        return view('user.contact.contact_view')->with('contact',$user_contact_view);
    }
    // This function used to send questions from user  to admin
    public function sendMailContact(Request $request){
        $to_email = $request->email;
        $message = $request->msg;
        $user =  auth()->user();
        // Event Send Email To Admin To make question
        SendEmail::dispatch($to_email,$message,$user);
        return redirect()->route('contact-view')->with('message','Your message is sent sucessfully!');
    }
}
