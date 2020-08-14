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
            <td style="color:#fff; font-size:16px; font-weight:700; text-align:right; padding-right:21px;">Demo title
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
              <h1 style="color:#323d45; font-size:20px; font-weight:700;">Demo greetings @name</h1>
            </td>
          </tr>
          <tr>
            <td>
              <p style="font-size:14px; color:#323d45; padding:0 40px 0 50px; line-height:25px;">Demo description<br/>
                Demo description</p>
            </td>
          </tr>
          <tr>
            <td style="padding:10px 0 60px 50px;"><a href="@action" style="font-size:16px; color:#f85352;">Demo link</a></td>
          </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td bgcolor="f7f7f7" height="60px;" style="border-top:1px solid #dcdcdc; padding-left:20px;">
        <p style="font-size:12px; color:#757576;">Demo footer</p>
      </td>
    </tr>
    </tbody>
  </table>
@endsection
