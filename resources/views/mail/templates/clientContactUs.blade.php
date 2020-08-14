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
            <td>Name</td>
            <td>@name</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>@email</td>
          </tr>
          <tr>
            <td>Contact Number</td>
            <td>@contact_number</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>@address</td>
          </tr>
          <tr>
            <td>Message</td>
            <td>@message</td>
          </tr>
          </tbody>
        </table>
      </td>
    </tr>
    </tbody>
  </table>
@endsection
