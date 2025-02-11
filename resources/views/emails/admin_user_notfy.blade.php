<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message from ResumeLive</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #35ADE1;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .logo {
            width: 100%;
            max-width: 150px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        @media screen and (max-width: 480px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://qvnfje.stripocdn.email/content/guids/CABINET_0484671f6360573eaeec76764c99fe35eebc47bac2db14f7f91ec3c2f077dba6/images/group_1.png" alt="ResumeLive Logo" class="logo">
        <h2>Hi {{$name}},</h2>
        <p>{!!$mess!!}</p>
        <div class="footer">
            <p>Thanks for your support!<br>
            &copy; <?php echo date("Y"); ?> <a href="{{url('/')}}">ResumeLive</a> All rights reserved.</p>
        </div>
    </div>
</body>
</html>
