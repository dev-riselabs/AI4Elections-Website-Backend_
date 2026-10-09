<?php

namespace App\Mail;

use App\Models\CommunityMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommunityMembershipReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public CommunityMembership $membership) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to the #AI4Elections Community of Practice',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.community-membership-received',
        );
    }
}