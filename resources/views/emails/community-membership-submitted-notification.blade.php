<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New community membership submitted</title>
</head>

<body>
    <h1>New #AI4Elections community membership submitted</h1>

    <table>
        @foreach ($membership->toArray() as $field => $value)
            <tr>
                <th style="text-align:left;padding:4px 12px 4px 0;">{{ str($field)->replace('_', ' ')->title() }}</th>
                <td style="padding:4px 0;">
                    @if (is_array($value))
                        {{ json_encode($value) }}
                    @elseif (is_bool($value))
                        {{ $value ? 'Yes' : 'No' }}
                    @else
                        {{ $value ?? 'N/A' }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
