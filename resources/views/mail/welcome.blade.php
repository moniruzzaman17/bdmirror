<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emergency Help Request</title>
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
        <h1>Emergency Help Request</h1>
        <div class="message">
            <p>Dear Best Wisher,</p>
            <p>My name is {{ Auth::guard('citizen')->user()->name }} and I need emergency help at my current location cause I am in great danger. My address is:</p>
            <p>{{ $address }}</p>
            <p>Please find my location on the map:</p>
            <p><a href="{{ $url }}"> Click here to see my current location</a></p>
            <p>Thank you for your prompt attention to this matter.</p>
        </div>
        <div class="btn-container">
            <a href="{{ Auth::guard('citizen')->user()->mobile }}" class="btn text-primary">Call Me</a>
        </div>
    </div>
</body>
</html>
