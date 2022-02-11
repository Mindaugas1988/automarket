<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailContact;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function mail(EmailContact $request){
        $mail_sender = $request->input('advert_email');
        $own_mail = $request->input('email');
        $title = $request->input('title');
        $text = $request->input('text');

        Mail::send('emails.send', ['title' => $title, 'content' => $text,'sender' =>$own_mail], function ($message) use($own_mail,$title,$mail_sender)
        {

            $message->from($own_mail,$title);

            $message->to($mail_sender)->subject('Uzsakymas');

            $message->sender($own_mail,$title);

            $message->replyTo($own_mail,$title = null);

            $message->cc($own_mail,$title = null);
            $message->bcc($own_mail,$title = null);

        });

        return response()->json([
            'status'=> true
        ]);
    }
}
