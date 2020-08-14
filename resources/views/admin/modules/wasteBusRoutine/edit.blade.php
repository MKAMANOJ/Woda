@extends('admin.layouts.admin')

@section('title')
  Edit {{ $wasteBusRoutineType }}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> {{ $wasteBusRoutineType }}
          <small class="font-green sbold">Edit</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    @if(isset($wasteBusRoutine))
      {!! Form::model($wasteBusRoutine, ['method' => 'patch', 'route' => 'waste-bus-routine.update']) !!}
    @else 
      {!! Form::model(null, ['method' => 'patch', 'route' => 'waste-bus-routine.update']) !!}
    @endif
    <div class="row">

      <div class="col-md-12">
        <div class="form-group {{ $errors->has('sunday') ? 'has-error' :'' }}">
          {!! Form::label('sunday', 'Sunday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('sunday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('sunday'))
            <div class="ui pointing red basic label"> {{$errors->first('sunday')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group {{ $errors->has('monday') ? 'has-error' :'' }}">
          {!! Form::label('monday', 'Monday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('monday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('monday'))
            <div class="ui pointing red basic label"> {{$errors->first('monday')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group {{ $errors->has('tuesday') ? 'has-error' :'' }}">
          {!! Form::label('tuesday', 'Tuesday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('tuesday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('tuesday'))
            <div class="ui pointing red basic label"> {{$errors->first('tuesday')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group {{ $errors->has('wednesday') ? 'has-error' :'' }}">
          {!! Form::label('wednesday', 'Wednesday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('wednesday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('wednesday'))
            <div class="ui pointing red basic label"> {{$errors->first('wednesday')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group {{ $errors->has('thursday') ? 'has-error' :'' }}">
          {!! Form::label('thursday', 'Thursday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('thursday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('thursday'))
            <div class="ui pointing red basic label"> {{$errors->first('thursday')}}</div>
          @endif
        </div>
      </div>


      <div class="col-md-12">
        <div class="form-group {{ $errors->has('friday') ? 'has-error' :'' }}">
          {!! Form::label('friday', 'Friday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('friday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('friday'))
            <div class="ui pointing red basic label"> {{$errors->first('friday')}}</div>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group {{ $errors->has('saturday') ? 'has-error' :'' }}">
          {!! Form::label('saturday', 'Saturday', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('saturday', null, ['class' => 'form-control', 'rows' => 3]) !!}
          @if($errors->first('saturday'))
            <div class="ui pointing red basic label"> {{$errors->first('saturday')}}</div>
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
