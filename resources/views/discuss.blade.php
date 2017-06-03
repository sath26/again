xtends('layouts.app')

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading text-center">Create a new discussion</div>

                <div class="panel-body">
                    <form action="{{ route('posts.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                              <label for="tag"> Pick a Tag</label>
                              <select class="form-control select2-multi" name="tag_id[]" id="channel_id"  multiple="multiple">
                                    @foreach($tags as $tag)
                                          <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                    @endforeach
                              </select>
                        </div>
                        <div class="form-group">
                              <label for="content">Ask a question</label>
                              <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                              <button class="btn btn-success pull-right" type="submit">Create discussion</button>
                        </div>
                    </form>
                </div>
            </div>

@endsection

