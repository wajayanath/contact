<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('{id}-from-{name}','allController@show');

Route::resource('all', 'allController');

Route::group(['middleware' =>['web']], function () {

	Route::get('contacts/{id}-from-{name}','ContactsController@show');
	Route::resource('contacts', 'ContactsController'); // get
	
//	Route::post('contacts/{id}/{name}/photos','ContactsController@addPhoto'); // add
	// Route::post('photo/{name}','PhotoController@deletePhoto'); //delete
	//Route::resource('photo', 'PhotoController');
// Route::get('resizeImage', 'ImageController@resizeImage');
// Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

	Route::post('contacts/{id}/{name}/photos', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']); //add
	Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']); // delete
	//Route::get('example-2', ['as' => 'upload-2', 'uses' => 'ImageController@getServerImagesPage']);
	Route::get('server-images/{id}', function (App\Contact $id) {
		$images = App\Photo::where('contact_id', 'like', $id['id'] )->get();
		$imageAnswer = [];
        foreach ($images as $image) {
            $imageAnswer[] = [
                'server' => $image->path,
                'size' => File::size(public_path('images/full_size/' . $image->path))
            ];
        }
        return response()->json([
            'images' => $imageAnswer
        ]);
	});

	Route::get('user/activation/{token}', 'Auth\AuthController@userActivation');

});
Route::auth();

// Route::get('/home', 'HomeController@index');
