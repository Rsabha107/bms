<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\MdsNewBookingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;
use App\Mail\TaskAssignmentMail;
use App\Models\User;

use Illuminate\Support\Facades\Notification;

use App\Notifications\AnnouncementCenter;
use Illuminate\Mail\Mailables\Attachment;

class SendMailController extends Controller
{
    //
    public function index()
    {
        $content = [
            'subject' => 'Traki: Event monitoring reminder',
            'body' => 'You have an event/task that needs your attention.  Ya walad!!!'
        ];

        Mail::to('rsabha@gmail.com')->cc('rsabha@gmail.com')->send(new SampleMail($content));

        return "Email has been sent.";
    }

    public function newBookingEmail(Request $request)
    {

        $details = [
            'email' => 'rsabha@gmail.com',
            'venue' => 'Venue Name',
            'filename' => 'mh9BwqhlAspS15zgfGgEVttrqFs6IURjIxDR0adg.pdf',
            // 'files' => [
            //     Attachment::fromStorage('/private/mds/pdf-exports/mh9BwqhlAspS15zgfGgEVttrqFs6IURjIxDR0adg.pdf')
            // ],
        ];

        SendEmailJob::dispatch($details);
        // Mail::to('rsabha@gmail.com')->cc('rsabha@gmail.com')->queue(new MdsNewBookingMail($details));

        return "MDS New Booking Email has been sent.";
    }

 
    public function sendTaskAssignmentEmail($details, $emails)
    {
        foreach($emails as $key1 => $item1){

            $content = [
                'name' => $item1->assigned_to_name .',',
                'start_date' =>  \Carbon\Carbon::parse($details->start_date)->format('d-M-Y'),
                'due_date' => \Carbon\Carbon::parse($details->due_date)->format('d-M-Y'),
                'subject' => 'Tracki: Task "'. $details->name .'" has been assigned to you',
                'body' => 'task "'.$details->name. '" has been assigned to you and ready for some action. chop chop start churning',
                'description' => $details->description,
            ];

            Mail::to($item1->email_address)->cc('rsabha@gmail.com')->send(new TaskAssignmentMail($content));
        }

        return "Email has been sent.";
    } // sendTaskAssignmentEmail

    public function sendTaskAssignmentNotifcation(){

        $user = User::findOrFail(9);

        $details = [
            'greeting' => 'Hi laravel developer',
            'body' => 'this is the email body',
            'actiontext' => 'Go to Tracki',
            'actionurl' => '/',
            'lastline' => 'this is the last line',
        ];
        // Notification::send($user, new AnnouncementCenter($details));

        dd('done');
    }
}
