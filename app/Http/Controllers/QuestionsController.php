<?php

namespace App\Http\Controllers;

use App\Model\Questions;
use App\Model\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\question;

class QuestionsController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('jwt');
      $this->middleware('isAdmin', ['except' => ['seeQuestions']]);
  }

  public function seeQuestions(Categories $category){
    return question::collection(Questions::where('category_id',$category->id)->get());
  }

  public function createQuestion(Request $request,Categories $category){

    $this->validate($request,[
      'question' => 'required|string'
    ]);

    Questions::create([
      'category_id' => $category->id,
      'question' => $request->question
    ]);

    return response()->json(['status' => 'created'],200);

  }

  public function deleteQuestion(Questions $question){

    $question->delete();
    return response()->json(['status' => 'deleted'],200);

  }
}
