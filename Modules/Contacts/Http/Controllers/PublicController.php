<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Notifications\NewContactRequest;
use TypiCMS\Modules\Contacts\Notifications\YourContactRequest;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Settings\Models\Setting;

class PublicController extends BasePublicController
{
    public function form(): View
    {
        return view('contacts::public.form');
    }

    public function sent()
    {
        if (session('success')) {
            return view('contacts::public.sent');
        }

        return redirect(url('/'));
    }

    public function store(FormRequest $request)
    {
        $contact = new Contact();
        $contact->locale = $request->locale;
        $contact->title = $request->title;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        // Notification::route('mail', Setting::value('webmaster_email'))
        //     ->notify(new NewContactRequest($contact));

        // Notification::route('mail', $request->email)
        //     ->notify(new YourContactRequest($contact));

            return redirect()->route(app()->getLocale()."::index-contacts")
            ->with('message',__('Successfully sent'));
    }
}
