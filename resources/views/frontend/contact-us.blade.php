@extends('layouts.frontend')

@section('frontend-css')
  <style>
    .error {
      color: red;
      margin-top : 5px;
    }

    .form-group.required .control-label:after {
      content:"*";
      color:red;
  }
  </style>
@endsection

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h2>@lang('data.contact-us')</h2>
      <i class="fa fa-phone"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <form id="messageForm" action="{{ route('frontend.send-message') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }} clearfix ">
          <label class="control-label">Full Name (पुरा नाम)</label>
          <input name="name" placeholder="Enter your name" class="common-input form-control" minlength="2" type="text" value="{{ old('name') }}" required>
        </div>

        <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
          <label class="control-label">Email (इमेल)</label>
          <input name="email" placeholder="Enter your email address" class="common-input form-control" type="email" type="text" value="{{ old('email') }}" required>
        </div>

        <div class="form-group required {{ $errors->has('phone') ? ' has-error' : '' }} clearfix ">
          <label class="control-label">Contact Number (सम्पर्क नम्बर)</label>
          <input name="phone" placeholder="Enter your contact number" class="common-input form-control" minlength="5" maxlength="10" type="text" type="text" value="{{ old('phone') }}" required>
        </div>

        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }} clearfix ">
          <label class="control-label">Address (ठेगाना)</label>
          <input name="address" placeholder="Enter your address" class="common-input form-control" minlength="2" type="text" type="text" value="{{ old('address') }}">
        </div>

        <div class="form-group required {{ $errors->has('message') ? ' has-error' : '' }} clearfix ">
          <label class="control-label">Message (सन्देश)</label>
          <textarea class="common-textarea form-control" name="message" placeholder="Messege" minlength="2" rows="4" value="{{ old('message') }}" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>      
      </form> 
    </div>
  </div>
@endsection

@section('frontend-script')
  <script>
    $("#messageForm").validate();
  </script>
@endsection
