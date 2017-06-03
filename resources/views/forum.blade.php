@extends('layouts.app')

@section('content')
        @foreach($posts as $d)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                    <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
                    <a href="{{ route('posts.show', ['id' => $d->id , 'slug'=>$d->slug]) }}" class="btn btn-default pull-right">view</a>
                </div>

                <div class="panel-body">
                    <h4 class="text-center">
                        <b>{{ $d->title }}</b>
                    </h4>
                    <p class="text-center">
                        {!! str_limit($d->body, 100) !!}
                    </p>
                </div>
                <div class="panel-footer">
                    <span>
                        {{ $d->replies->count() }} Replies
                    </span>
                    
                    @foreach ($d->tags as $tag)
                    <a href="{{ route('tag', ['slug' => $tag->slug ]) }}"><span class="badge">{{ $tag->title }}</span></a>
                    
                @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-center">
            {{ $posts->links() }}
        </div>
@endsection
