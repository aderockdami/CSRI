<?php

namespace App\Http\Controllers;

use App\Model\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\category;

class CategoriesController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('jwt');
      $this->middleware('isAdmin', ['except' => ['seeCategory']]);
  }

  public function seeCategory(){
    return category::collection(Categories::get());
  }

  public function createCategory(Request $request){

    $this->validate($request,[
      'name' => 'required|string',
      'weight' => 'required|integer'
    ]);

    Categories::create($request->all());

    return response()->json(['status' => 'created'],200);

  }

  public function deleteCategory(Categories $category){

    $category->delete();
    return response()->json(['status' => 'deleted'],200);

  }

}
