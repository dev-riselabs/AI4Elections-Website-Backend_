<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application received</title>
</head>

<body>
    <div>
        <img src="{{ $message->embed(public_path('ai4-logo.png')) }}" alt="AI4ELECTIONS LOGO" width="180"
            style="height:auto;display:block;margin:0 auto;max-width:180px;" />
    </div>


    <p>Hello {{ $application->first_name }},</p>

    <p>Thank you for applying to the #AI4Elections programme. We have received your application.</p>

    <p>Your application reference is <strong>{{ $application->id }}</strong>.</p>

    <p>We will contact you at this email address with updates about your application.</p>

    <p style="margin:0 0 20px;">
        Should you have any questions or require additional information, please contact us at email:
        <a href="mailto:investinlagos@lagosmccti.org"
            style="color:#ff7700;text-decoration:none;">labs@risenetworks.org</a>
    </p>
    <p style="margin:0 0 20px;">
        or visit the Invest in Lagos website at
        <a href="https://ai4elections.risenetworks.org" style="color:#ff7700;text-decoration:none;">ai4elections.risenetworks.org</a>.
    </p>


    <p>The #AI4Elections team</p>
</body>

</html>
