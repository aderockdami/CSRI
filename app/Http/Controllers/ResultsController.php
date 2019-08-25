<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Results;
use App\Model\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\result;

class ResultsController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('jwt');
      $this->middleware('isResultOwner', ['except' => ['createResults']]);
  }

  public function seeResults(User $user){
    return question::collection(Questions::where('category_id',$category->id)->get());
  }

  public function createResults(Request $request,Categories $category){

    $this->validate($request,[
      'response.*' => 'required|integer'
    ]);

    $responses = explode(',',$request->response);

    foreach ($responses as $response) {
      Results::create([
        'category_id' => $category->id,
        'user_id' => User::getId(),
        'response' => $response
      ]);
    }

    return response()->json(['status' => 'created'],200);

  }

  public function deleteResults(User $user){

    Results::where('user_id',$user->id)->delete();
    return response()->json(['status' => 'deleted'],200);

  }

}
