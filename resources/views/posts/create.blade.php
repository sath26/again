@extends('layouts.app')

@section('title', '| Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vyffdmn803j2svy1e1aje1bn7zwuberz21xehbrl6s2vf1hn'></script>
	<script>
		tinymce.init({ 
			selector:'textarea',
			plugins: [
		    'advlist autolink lists link image charmap print preview anchor',
		    'searchreplace visualblocks code fullscreen',
		    'insertdatetime media table contextmenu paste code'
  			],
			menubar: false,

		 });
	</script>
@endsection

@section('content')

	<div class="panel panel-default">
			<div class="panel-heading text-center">Create a Discussion</div>
			
		<div class="panel-body">
			{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '')) !!}
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				


				{{ Form::label('tags', 'Tags:') }}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $tag)
						<option value='{{ $tag->id }}'>{{ $tag->title }}</option>
					@endforeach

				</select>



				{{ Form::label('body', "Ask Question:") }}
				{{ Form::textarea('body', null, array('class' => 'form-control')) }}

				{{ Form::submit('Post', array('class' => 'btn btn-success pull-right', 'style' => 'margin-top: 20px;')) }}
			{!! Form::close() !!}
		</div>
</div>
@endsection


@section('scripts')

	{!! Html::script('js/jquery.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection
