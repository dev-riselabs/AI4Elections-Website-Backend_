<?php

namespace App\Services;

use App\Mail\ApplicationReceived;
use App\Mail\ApplicationSubmittedNotification;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

class ApplicationService
{
    public function submit(array $validatedData): Application
    {
        $application = Application::create([
            ...$validatedData,
            'status' => 'submitted',
        ]);

        Mail::to($application->email)->queue(new ApplicationReceived($application));
        Mail::to(config('mail.from.address'))->queue(new ApplicationSubmittedNotification($application));

        return $application;
    }
}
