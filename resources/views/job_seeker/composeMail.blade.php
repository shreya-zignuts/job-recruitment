<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .email-content {
            width: 90%;
            max-width: 600px;
            border: 2px solid #ccc;
            border-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>
<br>
<body class="mt-3 mb-3">
    <div class="container">
        <div class="card email-content">
            <div class="card-body">
                <h5 class="card-title">Dear {{ $employerName }},</h5><br>
                <p class="card-text">{{ $mailMessage }}</p>
                <p class="card-text text-center font-weight-bold">Checked Resume Attached</p><hr>
                <div>
                <p class="card-text">Warm regards, <br> {{ $userName }}</p>
                </div>
            </div>
        </div>
    </div>
    <br>
</body><br>

</html>

