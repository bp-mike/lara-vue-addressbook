<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Contact;

Route::group(['middleware' => 'api'],function(){
    // get all
    Route::get('contacts', function(){
        return Contact::latest()->get();
    });
    Route::get('contacts/{id}', function( $id){
        return Contact::findOrFail($id);
    });
    Route::post('contacts/store', function(Request $request){
        return Contact::create(['name'=>$request->input('name'), 'email'=>$request->input('email'), 'phone'=>$request->input('phone')]);
    });
    Route::patch('contacts/{id}', function(Request $request, $id){
        return Contact::findOrFail($id)->update(['name'=>$request->input('name'), 'email'=>$request->input('email'), 'phone'=>$request->input('phone')]);
    });
    Route::delete('contacts/{id}', function( $id){
        return Contact::destroy($id);
    });
});

// Route::resource('posts', PostController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
