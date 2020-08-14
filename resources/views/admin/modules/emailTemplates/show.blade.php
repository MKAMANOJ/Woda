@extends('admin.layouts.admin')

@section('title')
  Show Email Templates
@endsection

@section('breadcrumbs')
  {!! $breadcrumbs !!}
@endsection

@section('content')
  <div class="portlet light bordered"> {{--portlet div starts--}}
    <div class="portlet-title">  {{--title div starts--}}
      <div class="caption">  {{--caption div starts--}}
        <span class="caption-subject font-green-haze bold" style="font-size: 24px;">
            <i class="fa fa-television font-green"></i>Email Template
        </span>
        <span class="caption-helper">
          Details
        </span>
      </div> {{--caption div ends--}}
    </div> {{--title div ends--}}

    <div class="portlet-body form">
      <!-- BEGIN FORM-->
      <form class="form-horizontal" role="form">
        <div class="form-body">
          <h3 class="title sbold">Email Template Info - {{ $emailTemplate->title }}</h3>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label col-md-3">Title:</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{ $emailTemplate->title }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label col-md-3">Slug:</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{ $emailTemplate->slug }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="-ms-word-break: break-all;word-break: break-all;">
              <div class="form-group">
                <label class="control-label col-md-3">Content:</label>
                <div class="col-md-9">
                  <p class="form-control-static">{!! $emailTemplate->content !!}</p>
                </div>
              </div>
            </div>
          </div>
          <!--/row-->
          <div class="row">
            @if(userHasRole('admin'))
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group pull-right">
                      <a href="{{ route('email-template.index') }}" type="button" class="btn btn-info"><i
                            class="fa fa-backward"
                            aria-hidden="true"></i>
                        Back</a>
                      <a href="{{ route('email-template.edit', ['id' => $emailTemplate->id]) }}" type="button"
                         class="btn btn-primary green">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                      </a>

                    </div>
                  </div>

                </div>
              </div>
            @endif
          </div>
        </div>
      </form>
      <!-- END FORM-->
    </div>
  </div> {{--portlet div ends--}}
@endsection
