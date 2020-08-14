@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h2>@lang('data.staff')</h2>
      <i class="fa fa-users"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <div class="row">
        @forelse($staffs as $staff)
          <div class="col-md-6 col-sm-6 col-xs-12 single-staff">
            <div class="col-lg-5 col-md-6 col-xs-6">
              <img src="storage/{{ $staff->image }}">                 
            </div>
            <div class="col-lg-7 col-md-6 col-xs-6 staff-detail">
              <li><span class="staff-name-np">{{ $staff->nepali_name }}</span></li>
              <li><span class="staff-name-en">{{ $staff->name }}</span></li>
              <li><i class="staff-post">{{ $staff->designation }} </i></li>
              <li><i class="fa fa-phone"></i> <span class="staff-contact">{{ $staff->personal_phone }}</span></li>
            </div>
          </div>
        @empty
          <span>No Staff Added</span>
        @endforelse
      </div>
    </div>
  </div>
@endsection
