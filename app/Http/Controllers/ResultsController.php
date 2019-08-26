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
  }

  public function seeResults(User $user){
    $results = Results::where('user_id',$user->id)->get();
    $categories = Categories::all();
    $category = 1;
    $responses = [];
    $averages = [];
    $average100 = [];
    $weightedAverage = [];
    $count = 0;
    $lastCount = 0;
    $sum = 0;
    $return = [];
    foreach ($results as $result) {
      if($result->category_id == $category){
        $sum += $result->response;
      }
      else{
        array_push($responses,$sum);
        array_push($averages,$sum/$count);
        $sum = 0;
        $lastCount = $count;
        $count = 0;
        $sum += $result->response;
      }
        $count++;
    }

    $index = count( $responses ) - 1;
    $value = $responses[$index];
    $responses[$index] = $value + $sum;

    $index = count( $averages ) - 1;
    $value = $averages[$index];
    $averages[$index] = $value + $sum;
    $lastCount = $lastCount + 1;
    $var = $value * ($lastCount);
    $value = $var / $lastCount;
    $averages[$index] = $value;

    foreach ($averages as $index => $average) {
      array_push($average100,($average/5)*100);
      $weight = $categories[$index]->weight;
      array_push($weightedAverage,(($average/5)*100) * ($weight / 100));
    }

    foreach ($responses as $index => $response) {
      $tempObject = new \stdClass();
      $tempObject->category = $categories[$index]->name;
      $tempObject->weight = $categories[$index]->weight;
      $tempObject->score = $response;
      $tempObject->average = $averages[$index];
      $tempObject->average100 = $average100[$index];
      $tempObject->weightedAverage = $weightedAverage[$index];
      json_encode($tempObject);
      array_push($return,$tempObject);
    }

    return response()->json(['data' => $return]);

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
