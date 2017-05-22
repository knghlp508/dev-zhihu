@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">对话列表</div>
          <div class="panel-body">
            <form action="/inbox/{{ $dialogId }}/store" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <textarea name="body" class="form-control"></textarea>
              </div>
              <div class="form-group pull-right">
                <button class="btn btn-success">发送私信</button>
              </div>
            </form>
            <div class="messages-list">
              @foreach($messages as $message)
                <div class="media">
                  @if(user()->id == $message->from_user_id)
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a href="#">{{ $message->fromUser->name }}</a>
                      </h4>
                      <p>
                        {{ $message->body }}
                        <span class="pull-right">{{ $message->created_at->format('Y-m-d') }}</span>
                      </p>
                    </div>
                    <div class="media-right">
                      <a href="#">
                        <img width="64" src="{{ $message->fromUser->avatar }}">
                      </a>
                    </div>
                  @else
                    <div class="media-left">
                      <a href="#">
                        <img width="64" src="{{ $message->fromUser->avatar }}">
                      </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a href="#">{{ $message->fromUser->name }}</a>
                      </h4>
                      <p>
                        {{ $message->body }}
                        <span class="pull-right">{{ $message->created_at->format('Y-m-d') }}</span>
                      </p>
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
