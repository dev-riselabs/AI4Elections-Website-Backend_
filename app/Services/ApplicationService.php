<?php

namespace App\Services;

use App\Mail\ApplicationReceived;
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

        return $application;
    }
}
