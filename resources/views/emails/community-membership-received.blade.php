<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Community registration received</title>
</head>

<body>

    <div>
        <img src="{{ $message->embed(public_path('ai4-logo.png')) }}" alt="AI4ELECTIONS LOGO" width="180"
            style="height:auto;display:block;margin:0 auto;max-width:180px;" />
    </div>
    <br />
    <p>Hello {{ $membership->first_name }},</p>

    <p>Thank you for joining the #AI4Elections Community of Practice. Your registration has been received.</p>

    <p>We will contact you at this email address with relevant community activities, collaboration and mentorship
        opportunities.</p>


    <p style="margin:0 0 20px;">
        Should you have any questions or require additional information, please contact us at email:
        <a href="mailto:investinlagos@lagosmccti.org"
            style="color:#ff7700;text-decoration:none;">labs@risenetworks.org</a>
    </p>
    <p style="margin:0 0 20px;">
        or visit the Invest in Lagos website at
        <a href="https://ai4elections.risenetworks.org"
            style="color:#ff7700;text-decoration:none;">ai4elections.risenetworks.org</a>.
    </p>

    <p>The #AI4Elections team</p>
</body>

</html>
