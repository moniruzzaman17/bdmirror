<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Complaint Auto Publish Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .message {
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            color: black;
        }

        .btn:hover {
            background-color: #0062cc;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Your Complaint Auto Publish Reminder</h1>
        <div class="message">
            <p>Sir,</p>
            <p>Your Complaint ID <b>{{ $complaint->id }} ~ {{ $title }}</b> will be publish soon. To prevent publish just login into your system</p>
            <p>Thank you</p>
            <p>From: BD Mirror</p>
        </div>
        <div class="btn-container">

        </div>
    </div>
</body>
</html>
