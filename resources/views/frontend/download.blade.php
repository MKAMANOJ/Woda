@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h2>@lang('data.downloads')</h2>
      <i class="fa fa-list"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <table class="table table-bordered table-striped custom-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Filename (Download)</th>
            <th>Necessary Documents</th>
          </tr>
        </thead>
        <tbody>
          @forelse($downloads as $download)
            <tr>
              <td>1</td>
              <td width="20%">
                <a href="storage/{{ $download->file_name }}">{{ $download->title }}</a>
              </td>
              <td>{{ $download->description }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3">No File Added</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
