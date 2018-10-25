  <?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// list articles
Route::get('articles','ArticallControler@index');

// list Singlel articles
Route::get('article/{id}','ArticallControler@show');

// create new  articles
Route::post('article','ArticallControler@store');

// update  articles
Route::put('article','ArticallControler@store');

//  delete  articles
Route::delete('article/{id}','ArticallControler@destroy');


