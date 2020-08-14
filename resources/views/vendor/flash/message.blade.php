@foreach ((array) session('flash_notification') as $message)
  @if ($message['overlay'])
    @include('flash::modal', [
        'modalClass' => 'flash-modal',
        'title'      => $message['title'],
        'body'       => $message['message']
    ])
  @else
    <div class="alert alert-dismissable
                    alert-{{ $message['level'] }} ">
      <button type="button"
              class="close"
              data-dismiss="alert"
              aria-hidden="true"
      >&times;
      </button>
      {!! $message['message'] !!}
    </div>
  @endif
@endforeach

{{ session()->forget('flash_notification') }}
