<p><b> Hello {{ $name }},</b><br>
  Welcome To Find And Fill. Please follow the link to set your password and activate your account. <br>
  <a href="{{ route('client.showPasswordSetForm', $token) }}">Activate Account & Set Password</a>
  <br>
  Regards, <br>
  Find And Fill Team.
</p>
