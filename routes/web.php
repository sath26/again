	<?php
Route::get('/', function () {
	return view('welcome');
});

Route::get('/discuss', function () {
	return view('discuss');
});

Auth::routes();
Route::resource('/notes','NoteController');
Route::get('/home', [
	'uses' => 'ForumsController@index',
	'as' => 'forum'
	]);

Route::get('{provider}/auth', [
	'uses' => 'SocialsController@auth',
	'as' => 'social.auth'
	]);

Route::get('/{provider}/redirect', [
	'uses' => 'SocialsController@auth_callback',
	'as' => 'social.callback'
	]);

Route::get('post/{id}/{slug}', [
	'uses' => 'PostController@show',
	'as' => 'posts.show'
	]);

Route::get('tag/{slug}', [
	'uses' => 'ForumsController@tag',
	'as' => 'tag'
	]);
Route::get('test', function()
{
	dd(Config::get('mail'));
});
Route::group(['middleware' => 'auth'], function(){

	Route::resource('tags', 'TagController');

	Route::get('post/create/new', [
		'uses' => 'PostController@create',
		'as' => 'posts.create'
		]);

	Route::post('posts/store', [
		'uses' => 'PostController@store',
		'as' => 'posts.store'
		]);

	Route::post('posts/edit/{id}', [
		'uses' => 'PostController@edit',
		'as' => 'posts.edit'
		]);
	Route::post('posts/update/{id}', [
		'uses' => 'PostController@update',
		'as' => 'posts.update'
		]);
	Route::post('posts/{id}', [
		'uses' => 'PostController@destroy',
		'as' => 'posts.destroy'
		]);
	Route::post('/post/reply/{id}', [
		'uses' => 'PostController@reply',
		'as' => 'post.reply' 
		]);

	Route::get('/reply/like/{id}', [
		'uses' => 'RepliesController@like',
		'as' => 'reply.like'
		]);

	Route::get('/reply/unlike/{id}', [
		'uses' => 'RepliesController@unlike',
		'as' => 'reply.unlike'
		]);

	Route::get('/post/watch/{id}', [
		'uses' => 'WatchersController@watch',
		'as' => 'post.watch'
		]);

	Route::get('/post/unwatch/{id}', [
		'uses' => 'WatchersController@unwatch',
		'as' => 'post.unwatch'
		]);

	Route::get('/post/best/reply/{id}', [
		'uses' => 'RepliesController@best_answer',
		'as' => 'post.best.answer'
		]);
	Route::get('/test', function(){
		$user = App\User::find(1);
		$notifications=$user->unreadNotifications;
		foreach ($notifications as $notification) {
			dd($notification->data,$notification->data['post']['title']);
		}
	});
});

