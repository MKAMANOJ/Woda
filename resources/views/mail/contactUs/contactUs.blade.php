@extends('mail.templates.master')

@section('mail-css')
  <style type="text/css">
    .header-td {
      width: 25%
    }
    tr {
      height: 40px;
    }
  </style>
@endsection

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
            <td class="header-td">Name:</td>
            <td>{{ $senderMessage['name'] }}</td>
          </tr>
          <tr>
            <td class="header-td">Email:</td>
            <td>{{ $senderMessage['email'] }}</td>
          </tr>
          <tr>
            <td class="header-td">Contact Number:</td>
            <td>{{ $senderMessage['phone'] }}</td>
          </tr>
          @isset($senderMessage['address'])
            <tr>
              <td class="header-td">Address:</td>
              <td>{{ $senderMessage['address'] }}</td>
            </tr>
          @endisset
          <tr>
            <td class="header-td">Message:</td>
            <td>{{ $senderMessage['message'] }}</td>
          </tr>
          <h5>
            Please review the mail and reply at {{ $senderMessage['email'] }}
          </h5>
          </tbody>
        </table>
      </td>
    </tr>
    </tbody>
  </table>
@endsection
