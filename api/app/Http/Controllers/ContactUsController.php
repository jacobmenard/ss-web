<?php

namespace App\Http\Controllers;

use App\Mail\EmailPusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    //
    public function sendEmail(Request $request) {
        // $data['name'] = $request->name;
        $data['type'] = 'contactus-business';
        $data['subject'] = 'Excited about your venue for our speed dating events!';
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['comment'] = $request->comment;
        $data['businessInstagram'] = $request->businessInstagram;
        $data['businessLocation'] = $request->businessLocation;
        $data['businessName'] = $request->businessName;
        $data['website'] = $request->website;
        
        Mail::to($request->email)->send(new EmailPusher($data));


        $data['type'] = 'contactus-admin';
        $data['subject'] = 'Contact us inquiry';
        // Mail::to('Sipsandsparksevents@gmail.com')->send(new EmailPusher($data));
        Mail::to('jemenard082713@gmail.com')->send(new EmailPusher($data));
    }
}
