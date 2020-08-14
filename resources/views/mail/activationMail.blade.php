<p><b> Hello {{ $name }},</b><br><br>
  Welcome To Find And Fill. Please follow the link to activate your account. <br>
  <a href="{{ route('client.activateUser', ['token' =>$token, 'email' => $email]) }}">Activate Account </a>
  <br><br>
  Regards, <br>
  Find And Fill Team.
</p>
