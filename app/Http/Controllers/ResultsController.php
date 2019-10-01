<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Results;
use App\Model\Phases;
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

    $sum = 0;
    $count = 0;
    $responses = [];
    $averages = [];
    $average100 = [];
    $weightedAverage = [];
    $return = [];
    $hasResponse = false;

    $result1 = Results::orderBy('category_id','ASC')->where(['user_id' => $user->id, 'phase_id' => 1])->get();
    $result2 = Results::orderBy('category_id','ASC')->where(['user_id' => $user->id, 'phase_id' => 2])->get();
    $result3 = Results::orderBy('category_id','ASC')->where(['user_id' => $user->id, 'phase_id' => 3])->get();
    $result4 = Results::orderBy('category_id','ASC')->where(['user_id' => $user->id, 'phase_id' => 4])->get();
    $result5 = Results::orderBy('category_id','ASC')->where(['user_id' => $user->id, 'phase_id' => 5])->get();
    $phase1 = Categories::orderBy('id', 'ASC')->where('phase_id',1)->get();
    $phase2 = Categories::orderBy('id', 'ASC')->where('phase_id',2)->get();
    $phase3 = Categories::orderBy('id', 'ASC')->where('phase_id',3)->get();
    $phase4 = Categories::orderBy('id', 'ASC')->where('phase_id',4)->get();
    $phase5 = Categories::orderBy('id', 'ASC')->where('phase_id',5)->get();

    if (count($result1) != 0) {

      foreach ($phase1 as $index => $phase) {

        foreach ($result1 as $key => $result) {

          if($result->category_id == $phase->id){

            $hasResponse = true;

            $resp = str_split($result->response);

            foreach ($resp as $key => $res) {
              $sum += $res;
              $count++;
            }


          }

          if($hasResponse){
            $average = $sum/$count;
            array_push($responses,$sum);
            array_push($averages,$average);
            array_push($average100,(($average/5) *100 )); // divide by 5 since total score obtainable is 5
            array_push($weightedAverage,($average/5) * $phase->weight);
            $sum = 0;
            $count = 0;

            $tempObject = new \stdClass();
            $tempObject->phase_id = Phases::find($phase->phase_id)->id;
            $tempObject->category = $phase->name;
            $tempObject->weight = $phase->weight;
            $tempObject->score = end($responses);
            $tempObject->average = end($averages);
            $tempObject->average100 = end($average100);
            $tempObject->weightedAverage = end($weightedAverage);
            json_encode($tempObject);
            array_push($return,$tempObject);
          }

          $hasResponse = false;

        }

      }

    }

    if (count($result2) != 0) {

      foreach ($phase2 as $index => $phase) {

        foreach ($result2 as $key => $result) {

          if($result->category_id == $phase->id){

            $hasResponse = true;

            $resp = str_split($result->response);

            foreach ($resp as $key => $res) {
              $sum += $res;
              $count++;
            }


          }

          if($hasResponse){
            $average = $sum/$count;
            array_push($responses,$sum);
            array_push($averages,$average);
            array_push($average100,(($average/5) *100 )); // divide by 5 since total score obtainable is 5
            array_push($weightedAverage,($average/5) * $phase->weight);
            $sum = 0;
            $count = 0;

            $tempObject = new \stdClass();
            $tempObject->phase_id = Phases::find($phase->phase_id)->id;
            $tempObject->category = $phase->name;
            $tempObject->weight = $phase->weight;
            $tempObject->score = end($responses);
            $tempObject->average = end($averages);
            $tempObject->average100 = end($average100);
            $tempObject->weightedAverage = end($weightedAverage);
            json_encode($tempObject);
            array_push($return,$tempObject);
          }

          $hasResponse = false;

        }

      }

    }

    if (count($result3) != 0) {

      foreach ($phase3 as $index => $phase) {

        foreach ($result3 as $key => $result) {

          if($result->category_id == $phase->id){

            $hasResponse = true;

            $resp = str_split($result->response);

            foreach ($resp as $key => $res) {
              $sum += $res;
              $count++;
            }


          }

          if($hasResponse){
            $average = $sum/$count;
            array_push($responses,$sum);
            array_push($averages,$average);
            array_push($average100,(($average/5) *100 )); // divide by 5 since total score obtainable is 5
            array_push($weightedAverage,($average/5) * $phase->weight);
            $sum = 0;
            $count = 0;

            $tempObject = new \stdClass();
            $tempObject->phase_id = Phases::find($phase->phase_id)->id;
            $tempObject->category = $phase->name;
            $tempObject->weight = $phase->weight;
            $tempObject->score = end($responses);
            $tempObject->average = end($averages);
            $tempObject->average100 = end($average100);
            $tempObject->weightedAverage = end($weightedAverage);
            json_encode($tempObject);
            array_push($return,$tempObject);
          }

          $hasResponse = false;

        }

      }

    }

    if (count($result4) != 0) {

      foreach ($phase4 as $index => $phase) {

        foreach ($result4 as $key => $result) {

          if($result->category_id == $phase->id){

            $hasResponse = true;

            $resp = str_split($result->response);

            foreach ($resp as $key => $res) {
              $sum += $res;
              $count++;
            }


          }

          if($hasResponse){
            $average = $sum/$count;
            array_push($responses,$sum);
            array_push($averages,$average);
            array_push($average100,(($average/5) *100 )); // divide by 5 since total score obtainable is 5
            array_push($weightedAverage,($average/5) * $phase->weight);
            $sum = 0;
            $count = 0;

            $tempObject = new \stdClass();
            $tempObject->phase_id = Phases::find($phase->phase_id)->id;
            $tempObject->category = $phase->name;
            $tempObject->weight = $phase->weight;
            $tempObject->score = end($responses);
            $tempObject->average = end($averages);
            $tempObject->average100 = end($average100);
            $tempObject->weightedAverage = end($weightedAverage);
            json_encode($tempObject);
            array_push($return,$tempObject);
          }

          $hasResponse = false;

        }

      }

    }

    if (count($result5) != 0) {

      foreach ($phase5 as $index => $phase) {

        foreach ($result5 as $key => $result) {

          if($result->category_id == $phase->id){

            $hasResponse = true;

            $resp = str_split($result->response);

            foreach ($resp as $key => $res) {
              $sum += $res;
              $count++;
            }


          }

          if($hasResponse){
            $average = $sum/$count;
            array_push($responses,$sum);
            array_push($averages,$average);
            array_push($average100,(($average/5) *100 )); // divide by 5 since total score obtainable is 5
            array_push($weightedAverage,($average/5) * $phase->weight);
            $sum = 0;
            $count = 0;

            $tempObject = new \stdClass();
            $tempObject->phase_id = Phases::find($phase->phase_id)->id;
            $tempObject->category = $phase->name;
            $tempObject->weight = $phase->weight;
            $tempObject->score = end($responses);
            $tempObject->average = end($averages);
            $tempObject->average100 = end($average100);
            $tempObject->weightedAverage = end($weightedAverage);
            json_encode($tempObject);
            array_push($return,$tempObject);
          }

          $hasResponse = false;

        }

      }

    }

    $phases = [];
    $Phase1 = [];
    $Phase2 = [];
    $Phase3 = [];
    $Phase4 = [];
    $Phase5 = [];

    foreach ($return as $key => $object) {

      $index = $object->phase_id;

      if($index == 1){
        array_push($Phase1,$object);
      }
        else if($index == 2){
        array_push($Phase2,$object);
      }
      else if($index == 3){
        array_push($Phase3,$object);
      }
      else if($index == 4){
        array_push($Phase4,$object);
      }
      else if($index == 5){
        array_push($Phase5,$object);
      }

    }


    if(!empty($Phase1)){
      $tempObject = new \stdClass();
      $tempObject->Identify = $Phase1;
      json_encode($tempObject);
      array_push($phases,$tempObject);
    }
    if(!empty($Phase2)){
      $tempObject = new \stdClass();
      $tempObject->Protect = $Phase2;
      json_encode($tempObject);
      array_push($phases,$tempObject);
    }
    if(!empty($Phase3)){
      $tempObject = new \stdClass();
      $tempObject->Detect = $Phase3;
      json_encode($tempObject);
      array_push($phases,$tempObject);
    }
    if(!empty($Phase4)){
      $tempObject = new \stdClass();
      $tempObject->Respond = $Phase4;
      json_encode($tempObject);
      array_push($phases,$tempObject);
    }
    if(!empty($Phase5)){
      $tempObject = new \stdClass();
      $tempObject->Recover = $Phase5;
      json_encode($tempObject);
      array_push($phases,$tempObject);
    }

    return response()->json(['data' => $phases]);

  }


  public function createResults(Request $request,Categories $category){

    $this->validate($request,[
      'response.*' => 'required|integer'
    ]);

    $responses = explode(',',$request->response);

    foreach ($responses as $response) {
      Results::create([
        'phase_id' => $request->phase_id,
        'category_id' => $category->id,
        'user_id' => User::getId(),
        'response' => $request->response
      ]);
    }

    return response()->json(['status' => 'created'],200);

  }

  public function deleteResults(User $user){

    Results::where('user_id',$user->id)->delete();
    return response()->json(['status' => 'deleted'],200);

  }

}
