<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Mail\MailNotification;
use App\Models\User;
use App\Models\EventModel;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function Dashboard()
    {
        $events = EventModel::where('status', '0')->get();
        return view('Admin.Pages.dashboard', compact('events'));
    }
    public function AccountRequestPage()
    {
        $users = User::where('status', '0')->whereNull('deleted_at')->get();
        return view('Admin.Pages.account-request', compact('users'));
    }

    public function AccountAprrove($id)
    {
        $check_user = User::find($id);

        $check_user->update([
            'status' => '1',
        ]);
        Mail::to($check_user->email)->send(new MailNotification(
            'Account Approved',
            'Admin.Pages.Emails.account-approve-email',
            ['name' => $check_user->first_name]
        ));
        return redirect()->to('account-request-page');
    }

    public function AccountDecline($id)
    {
        $check_user = User::find($id);

        Mail::to($check_user->email)->send(new MailNotification(
            'Account Declined',
            'Admin.Pages.Emails.account-decline-email',
            ['name' => $check_user->first_name]
        ));
        $check_user->delete();
        return redirect()->to('account-declined');
    }

    public function EventScheduleValiation(Request $request)
    {
        $request->validate([
            'event_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $isSaved = $request->input('action') === 'save' ? 1 : 0;

        $imagePaths = [];

        $event_title = $request->event_title;

        if ($request->hasFile('event_images')) {
            foreach ($request->file('event_images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads/$event_title"), $filename);
                $imagePaths[] = "uploads/$event_title/$filename";
            }
        }

        EventModel::create([
            'event_title' => $event_title,
            'event_venue' => $request->event_venue,
            'event_audience' => $request->event_audience,
            'event_date' => Carbon::parse($request->event_date)->format('F j, Y'),
            'event_time_start' => $request->event_time_start,
            'event_time_end' => $request->event_time_end,
            'event_organizer' => $request->event_organizer,
            'event_visitor' => $request->event_visitor,
            'event_description' => $request->event_description,
            'event_privacy' => $request->privacy,
            'event_images' => json_encode($imagePaths),
            'status' => $isSaved,
        ]);
        return redirect()->to('event-schedule');
    }

    public function EventListPage()
    {
        $events = EventModel::where('status', '0')->get();

        return view('Admin.Pages.Events.event-list-page', compact('events'));
    }

    public function EventScheduleViewPage($id)
    {
        $event = EventModel::where('event_id', $id)->first();
        $events = EventModel::where('event_id', '!=', $event->event_id)->where('status', '0')->where('event_privacy', '0')->get();
        $images = json_decode($event->event_images);
        return view(view: 'Admin.Pages.Events.event-view', data: compact('event', 'images', 'events'));
    }

    public function EventScheduleEditPage($id)
    {
        $event = EventModel::where('event_id', $id)->first();
        $images = json_decode($event->event_images);
        return view(view: 'Admin.Pages.Events.event-schedule-edit', data: compact('event', 'images'));
    }

    public function EventScheduleEditValidation(Request $request, $id)
    {
        $request->validate([
            'event_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $isSaved = $request->input('action') === 'save' ? 1 : 0;

        $imagePaths = [];

        $event_title = $request->event_title;

        if ($request->hasFile('event_images')) {
            foreach ($request->file('event_images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("uploads/$event_title"), $filename);
                $imagePaths[] = "uploads/$event_title/$filename";
            }
        }

        $data = [
            'event_title' => $event_title,
            'event_venue' => $request->event_venue,
            'event_audience' => $request->event_audience,
            'event_date' => Carbon::parse($request->event_date)->format('F j, Y'),
            'event_time_start' => $request->event_time_start,
            'event_time_end' => $request->event_time_end,
            'event_organizer' => $request->event_organizer,
            'event_visitor' => $request->event_visitor,
            'event_description' => $request->event_description,
            'event_privacy' => $request->privacy,
            'status' => $isSaved,
        ];

        if (!empty($imagePaths)) {
            $data['event_images'] = json_encode($imagePaths);
        }
        EventModel::where('event_id', $id)->update($data);

        return redirect()->to('event-list-page');
    }


    public function EventSavedListPage()
    {
        $events = EventModel::where('status', '1')->get();

        return view('Admin.Pages.Events.event-saved-list-page', compact('events'));
    }

    public function EventSavedScheduleViewPage($id)
    {
        $event = EventModel::where('event_id', $id)->first();
        $events = EventModel::where('event_id', '!=', $event->event_id)->where('status', '0')->where('event_privacy', '0')->get();
        $images = json_decode($event->event_images);
        return view(view: 'Admin.Pages.Events.event-saved-view', data: compact('event', 'images', 'events'));
    }

    public function EventScheduleDelete($id)
    {
        EventModel::where('event_id', $id)->delete();
        return redirect('event-list-page');
    }

    public function EventSavedScheduleDelete($id)
    {
        EventModel::where('event_id', $id)->delete();
        return redirect('event-saved-list-page');
    }

    public function PublishEvent($id)
    {
        EventModel::where('event_id', $id)->update([
            'status' => '0',
        ]);
        return redirect('event-list-page');
    }

    public function EventPhotos()
    {
        $events = EventModel::where('status', '0')
            ->where('event_privacy', '0')
            ->get();

        return view('admin.pages.events.event-photos', compact('events'));
    }

}
