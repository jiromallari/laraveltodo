Hello User! {{$mail_data['name']}}
<br><br>
Welcome to my Website!
<br>
Please click the link below to verify your email and activate your account!
<br><br>
<a href="http://localhost/BillTracker/public/verify?code={{$mail_data['verification_code']}}">Click Here!</a>
<br><br>
Thank you!
<br>
Bill Tracker
