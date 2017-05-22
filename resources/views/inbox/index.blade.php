@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">私信列表</div>
          <div class="panel-body">
            @foreach($messages as $messageGroup)
              <div class="media {{ $messageGroup->first()->shouldAddUnreadClass() ?  'unread' : '' }}">
                <div class="media-left">
                  <a href="#">
                    @if(user()->id == $messageGroup->last()->fromUser->id)
                      <img width="64" src="{{ $messageGroup->last()->toUser->avatar }}">
                    @else
                      <img width="64" src="{{ $messageGroup->last()->fromUser->avatar }}">
                    @endif
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">
                    @if(user()->id == $messageGroup->last()->fromUser->id)
                      <a href="#">{{ $messageGroup->last()->toUser->name }}</a>
                    @else
                      <a href="#">{{ $messageGroup->last()->fromUser->name }}</a>
                    @endif
                  </h4>
                  <p>
                    <a href="/inbox/{{ $messageGroup->first()->dialog_id }}">
                      {{ $messageGroup->first()->body }}
                    </a>
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
