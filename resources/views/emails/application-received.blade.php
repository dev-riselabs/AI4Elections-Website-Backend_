<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application received</title>
</head>
<body>
    <p>Hello {{ $application->first_name }},</p>

    <p>Thank you for applying to the #AI4Elections programme. We have received your application.</p>

    <p>Your application reference is <strong>{{ $application->id }}</strong>.</p>

    <p>We will contact you at this email address with updates about your application.</p>

    <p>The #AI4Elections team</p>
</body>
</html>