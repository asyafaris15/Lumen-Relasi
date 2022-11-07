<?php

use Illuminate\Support\Str;
use Illuminate\Http\request;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', ['uses' => 'HomeController@index']);
$router->get('/hello', ['uses' => 'HomeController@hello']);

// Tiga Route
$router->group(['prefix' => 'users'], function () use ($router) {
    $router->post('/default', ['uses' => 'HomeController@defaultUser']);
    $router->post('/new', ['uses' => 'HomeController@createUser']);
    $router->get('/all', ['uses' => 'HomeController@getUsers']);
});

$router->get('/key', function (){
    return Str::random(32);
});

$router->get('/post/{postId}/comments/{commentId}', function ($postId, $commentId) {
		return 'Post ID = ' . $postId . ' Comments ID = ' . $commentId;
});

$router->post('/post', function () {
    return 'POST';
});

$router->put('/put', function () {
    return 'PUT';
});

$router->patch('/patch', function () {
    return 'PATCH';
});

$router->delete('/delete', function () {
    return 'DELETE';
});

$router->options('/options', function () {
    return 'OPTIONS';
});

//*Dynamic Route
$router->get('/user/{id}', function ($id) {
    return 'User Id = ' . $id;
});

$router->get('/post/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return 'Post ID = ' . $postId . ' Comments ID = ' . $commentId;
});

// $router->get('/users[/{userId}]', function ($userId = null) {
// 		return $userId === null ? 'Data semua users' : 'Data user dengan id ' . $userId;
// });

//Aliases Route
$router->get('/auth/login', [
    'as' => 'route.auth.login', function (){
        return "Anda berhasil login";
    }
]);

$router->get('/profile', function (Request $request) {
		if (false) {
				return redirect()->route('route.auth.login');
		}
});

// $router->group(['prefix' => 'users'], function () use ($router) {
//     $router->get('/', function () {
//             return "GET /users";
//     });
// });

$router->get('/admin/home/', ['middleware' => 'age', function () {
    return 'Dewasa';
}]);

$router->get('/fail', function () {
    return 'Dibawah umur';
});

$router->group(['prefix' => 'posts'], function () use ($router) {
    $router->post('/', ['uses' => 'PostController@createPost']);
    $router->get('/{id}', ['uses' => 'PostController@getPostById']);
});

$router->group(['prefix' => 'comments'], function () use ($router) {
    $router->post('/', ['uses' => 'CommentController@createComment']);
});

$router->group(['prefix' => 'posts'], function () use ($router) {
    $router->post('/', ['uses' => 'PostController@createPost']);
    $router->get('/{id}', ['uses' => 'PostController@getPostById']);
    $router->put('/{id}/tag/{tagId}', ['uses' => 'PostController@getPostById']); //
});

$router->group(['prefix' => 'tags'], function () use ($router) {
    $router->post('/', ['uses' => 'TagController@createTag']);
});