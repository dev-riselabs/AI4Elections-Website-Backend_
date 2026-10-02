<?php

namespace App\Services;

use App\Mail\ApplicationReceived;
use App\Models\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class ApplicationService
{
    public function submit(array $validatedData): Application
    {
        $contactDetails = Arr::only($validatedData, [
            'first_name',
            'last_name',
            'email',
            'phone',
        ]);

        $application = Application::create([
            ...$contactDetails,
            'status' => 'submitted',
            'responses' => Arr::except($validatedData, array_keys($contactDetails)),
        ]);

        Mail::to($application->email)->queue(new ApplicationReceived($application));

        return $application;
    }
}
