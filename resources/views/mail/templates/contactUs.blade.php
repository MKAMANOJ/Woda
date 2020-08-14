@extends('mail.templates.master')
@section('content')
  <table align="center" cellpadding="0" cellspacing="0" style=" font-family:Helvetica, sans-serif; margin:0 auto;"
         width="600px">
    <tbody>
    <tr>
      <td>
        <table bgcolor="#323d45" cellpadding="0" cellspacing="0" height="60px" width="100%">
          <tbody>
          <tr>
            <td><img src="{{ asset('images/logo.png') }}" style="margin-left:28px;"/></td>
            <td style="color:#fff; font-size:16px; font-weight:700; text-align:right; padding-right:21px;">Contact Us
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td bgcolor="#fff" style="padding:20px; ">
        <table bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" style="margin:0 auto; padding:10px;" width="100%">
          <tbody>
          <tr>
            <td style="text-align:right;">&nbsp;</td>
          </tr>
          <tr>
            <td style="padding-left:50px; padding-top:30px;">
              <h1 style="color:#323d45; font-size:20px; font-weight:700;">Thank you @name</h1>
            </td>
          </tr>
          <tr>
            <td>
              <p style="font-size:14px; color:#323d45; padding:0 40px 0 50px; line-height:25px;">We will get back to you as soon as possible.<br/>
              </p>
            </td>
          </tr>
          </tbody>
        </table>
      </td>
    </tr>
    </tbody>
  </table>
@endsection
