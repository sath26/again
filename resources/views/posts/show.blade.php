@extends('layouts.app')


@section('title')
    {!! $d->title !!} | Sichya
@stop
@section('tags')
    
@stop
@section('content')

<div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{ $d->user->name }}, <b>( {{ $d->user->points }} )</b></span>
                @if($d->is_being_watched_by_auth_user())
                    <a href="{{ route('post.unwatch', ['id' => $d->id ]) }}" class="btn btn-default btn-xs pull-right">unwatch</a>
                @else
                    <a href="{{ route('post.watch', ['id' => $d->id ]) }}" class="btn btn-default btn-xs pull-right">watch</a>
                @endif
            </div>

            <div class="panel-body">
                <h4 class="text-center">
                    <b>{{ $d->title }}</b>
                </h4>
                <hr>
                <p class="text-center">
                    {!! $d->body !!}
                </p>

                <hr>  

                @if($best_answer)
                    <div class="text-center" style="padding: 40px;">
                        <h3 class="text-center">BEST ANSWER</h3>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <img src="{{ $best_answer->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                                <span>{{ $best_answer->user->name }} <b>( {{ $best_answer->user->points }} )</b></span>
                            </div>

                            <div class="panel-body">
                                {{ $best_answer->content }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="panel-footer">
                    <span>
                        {{ $d->replies->count() }} Replies
                    </span>
                    <div class="tags pull-right">
                        @foreach ($d->tags as $tag)
                            <span class="label label-default">{{ $tag->title }}</span>
                        @endforeach
                    </div>
            </div>
            </div>
       

        @foreach($d->replies as $r)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                    <span>{{ $r->user->name }} <b>( {{ $r->user->points }} )</b></span>
                    @if(!$best_answer)
                        @if(Auth::id() == $d->user->id)
                            <a href="{{ route('post.best.answer', ['id' => $r->id ]) }}" class="btn btn-xs btn-info pull-right">Mark as best answer</a>
                        @endif
                    @endif
                </div>

                <div class="panel-body">
                    <p class="text-center">
                        {{ $r->content }}
                    </p>
                </div>
                <div class="panel-footer">
                    @if($r->is_liked_by_auth_user())
                        <a href="{{ route('reply.unlike', ['id' => $r->id ]) }}" class="btn btn-danger btn-xs">Unlike <span class="badge">{{ $r->likes->count() }}</span></a>
                    @else
                        <a href="{{ route('reply.like', ['id' => $r->id ]) }}" class="btn btn-success btn-xs">Like <span class="badge">{{ $r->likes->count() }}</span></a>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="panel panel-default">
            <div class="panel-body">
                @if(Auth::check())
                    <form action="{{ route('post.reply', ['id' => $d->id ]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="reply">Leave a reply...</label>
                            <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn pull-right">Leave a reply</button>
                        </div>
                    </form>
                @else

                    <div class="text-center">
                        <h2>Sign in to leave a reply</h2>
                    </div>
                @endif
            </div>
        </div>

@endsection
