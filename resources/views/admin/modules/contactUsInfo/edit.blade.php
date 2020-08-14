@extends('admin.layouts.admin')

@section('title')
  Edit Contact Us Info
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Contact Us Info
          <small class="font-green sbold">Edit</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    @if(isset($contactUsInfo))
      {!! Form::model($contactUsInfo, ['method' => 'patch', 'route' => 'contact-us-info.update']) !!}
    @else 
      {!! Form::model(null, ['method' => 'patch', 'route' => 'contact-us-info.update']) !!}
    @endif
    <div class="row">
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone1') ? 'has-error' :'' }}">
          {!! Form::label('phone1', 'Phone 1', ['class' => 'control-label']) !!}
          {!! Form::text('phone1', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'Phone 1']) !!}
          @if($errors->first('phone1'))
            <div class="ui pointing red basic label"> {{$errors->first('phone1')}}</div>
          @endif
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('nepali_phone1') ? 'has-error' :'' }}">
          {!! Form::label('nepali_phone1', 'फोन १', ['class' => 'control-label']) !!}
          {!! Form::text('nepali_phone1', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'फोन १']) !!}
          @if($errors->first('nepali_phone1'))
            <div class="ui pointing red basic label"> {{$errors->first('nepali_phone1')}}</div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone2') ? 'has-error' :'' }}">
          {!! Form::label('phone2', 'Phone 2', ['class' => 'control-label']) !!}
          {!! Form::text('phone2', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'Phone 2']) !!}
          @if($errors->first('phone2'))
            <div class="ui pointing red basic label"> {{$errors->first('phone2')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group {{ $errors->has('nepali_phone2') ? 'has-error' :'' }}">
          {!! Form::label('nepali_phone2', 'फोन २', ['class' => 'control-label']) !!}
          {!! Form::text('nepali_phone2', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'फोन २']) !!}
          @if($errors->first('nepali_phone2'))
            <div class="ui pointing red basic label"> {{$errors->first('nepali_phone2')}}</div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('fax') ? 'has-error' :'' }}">
          {!! Form::label('fax', 'FAX', ['class' => 'control-label']) !!}
          {!! Form::text('fax', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'FAX']) !!}
          @if($errors->first('fax'))
            <div class="ui pointing red basic label"> {{$errors->first('fax')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group {{ $errors->has('fax') ? 'has-error' :'' }}">
          {!! Form::label('nepali_fax', 'फ्याक्स', ['class' => 'control-label']) !!}
          {!! Form::text('nepali_fax', null, ['class' => 'form-control phoneNumber', 'placeholder'=>'फ्याक्स']) !!}
          @if($errors->first('nepali_fax'))
            <div class="ui pointing red basic label"> {{$errors->first('nepali_fax')}}</div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
          {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
          {!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'example@gmail.com']) !!}
          @if($errors->first('email'))
            <div class="ui pointing red basic label"> {{$errors->first('email')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group {{ $errors->has('facebook') ? 'has-error' :'' }}">
          {!! Form::label('facebook', 'Facebook Link', ['class' => 'control-label']) !!}
          {!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder'=>'https://facebook.com/example']) !!}
          @if($errors->first('facebook'))
            <div class="ui pointing red basic label"> {{$errors->first('facebook')}}</div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group {{ $errors->has('twitter') ? 'has-error' :'' }}">
          {!! Form::label('twitter', 'Twitter Link', ['class' => 'control-label']) !!}
          {!! Form::text('twitter', null, ['class' => 'form-control', 'placeholder'=>'https://twitter.com/example']) !!}
          @if($errors->first('twitter'))
            <div class="ui pointing red basic label"> {{$errors->first('twitter')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group {{ $errors->has('google_plus') ? 'has-error' :'' }}">
          {!! Form::label('google_plus', 'Google Plus Link', ['class' => 'control-label']) !!}
          {!! Form::text('google_plus', null, ['class' => 'form-control', 'placeholder'=>'https://google.com/example']) !!}
          @if($errors->first('google_plus'))
            <div class="ui pointing red basic label"> {{$errors->first('google_plus')}}</div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('map_embedded_link') ? 'has-error' :'' }}">
          {!! Form::label('map_embedded_link', 'Map Link (Put width= "350" and height = "350")', ['class' => 'control-label']) !!}
          {!! Form::textarea('map_embedded_link', null, ['rows' => 6, 'class' => 'form-control', 'placeholder'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1757.48785380547!2d83.98147705807004!3d28.23841699564376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399594679dafc1b5%3A0x80bbc0b7e126e80b!2sPokhara+Municipality+Ward+2+Office%2C+Pokhara+33700!5e0!3m2!1sen!2snp!4v1513576390294" width="350" height="350" frameborder="0" style="border:0" allowfullscreen=""></iframe>']) !!}
          @if($errors->first('map_embedded_link'))
            <div class="ui pointing red basic label"> {{$errors->first('map_embedded_link')}}</div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Update
          </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
@endsection

@section('script')
  @parent
  <script src="{{ asset('admin/js/categories/categories.js') }}"></script>
@endsection
