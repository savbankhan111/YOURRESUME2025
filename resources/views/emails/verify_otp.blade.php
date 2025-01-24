<body>
 <p><b>Hi {{$user->firstname}} {{$user->lastname}},</b><br><br>
 Thanks for register with ResumeLive.<br>
Here is your OTP code: {{$user->email_verified_code}}.
</p>
<p>Thanks for your support!<br/>
© <?php echo date("Y"); ?> <a href="{{url('/')}}">ResumeLive</a> All rights reserved.
</p>
</body>