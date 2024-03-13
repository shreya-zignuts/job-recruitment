<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Email</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="background-color: #f4f4f4; padding: 20px; height: 100%;">
        <table style="background-color: #ffffff; border-radius: 50px; overflow: hidden; width: 100%; height: 100%;">
            <tbody>
                <tr>
                    <td style="padding: 20px;">
                        <h2 style="color: #333333;">Job Application Mail</h2>
                        <p style="color: #666666;">Hello, {{ $employerName }} </p>
                        <p style="color: #666666;">Regarding Your Job Listings..</p>
                        <p style="color: #333333; margin-bottom: 20px;">{{ $mailMessage }}</p>
                        <h4 class="mt-4" style="margin-top: 16px;">Check Resume Attached</h4>
                        <hr class="mt-4" style="margin-top: 16px; border: 0; border-top: 1px solid #ccc;">
                        <div>
                            <p>Sincerely,<br></p>
                            <p>{{ $userName }}</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
