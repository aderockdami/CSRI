<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
//use App\Http\Resources\AuthResource;
use Illuminate\Validation\Rule;
use Hash;
use App\User;
class authcontroller extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login','signup']]);
    }
    public function signup(Request $request)
    {
      $this->validate($request,[
      'organization_name'=>'required|string|max:191|unique:users',
      'sector'=>'required|string|max:20',
      'date_of_assesment'=>'required|date',
      'internal_external'=>'required|string',
      'password'=>'required|string|min:8',
      ]);

      $request->merge(['password'=>Hash::make($request['password'])]);
      User::create($request->all());
      //return $this->login($request);
      return response()->json(['status'=>'created'],200);
    }
    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            $this->guard()->user()->update(['last_login'=>now()]);
            $token = $this->guard()->claims(['usertype'=>$this->guard()->user()->user_type])->attempt($credentials);
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(new AuthResource($this->guard()->user()));
    }
    public function update(Request $request)
    {
      $user = $this->guard()->user();
      if($request->image != $user->image){
        $this->validate($request,[
        'first_name'=>'required|string|max:191',
        'last_name'=>'required|string|max:191',
        'email'=>['required','string','email','max:191',Rule::unique('users')->ignore($this->guard()->user())],
        'username'=>['required','string','max:191',Rule::unique('users')->ignore($this->guard()->user())],
        'image' =>['base64mimes:jpeg,png,jpg,gif,svg|sometimes']
        ]);
      }
      elseif ($request->image == $user->image) {
        $this->validate($request,[
        'first_name'=>'required|string|max:191',
        'last_name'=>'required|string|max:191',
        'email'=>['required','string','email','max:191',Rule::unique('users')->ignore($this->guard()->user())],
        'username'=>['required','string','max:191',Rule::unique('users')->ignore($this->guard()->user())],
        public_path('user_images/').$request->image =>['mimes:jpeg,png,jpg,gif,svg|sometimes']
        ]);
      }
      if($request->image != $user->image){
        $new_image = time().'.'.explode('/',explode(':',substr($request->image,0,strpos($request->image,';')))[1])[1];
        \Image::make($request->image)->save(public_path('user_images/').$new_image);
        $request->merge(['image'=>$new_image]);
          if(file_exists(public_path('user_images/'.$user->image))){
            @unlink(public_path('user_images/'.$user->image));
          }
      }
      $user->update($request->all());
      $user->update(['updated_at'=>time()]);
      return response()->json(['username' => $request->username]);
    }
    public function updateAndroid(Request $request)
    {
      $user = $this->guard()->user();
      if($request->image != $user->image){
        $this->validate($request,[
        'first_name'=>'required|string|max:191',
        'last_name'=>'required|string|max:191',
        'email'=>['required','string','email','max:191',Rule::unique('users')->ignore($this->guard()->user())],
        'username'=>['required','string','max:191',Rule::unique('users')->ignore($this->guard()->user())]
        ]);
      }
      elseif ($request->image == $user->image) {
        $this->validate($request,[
        'first_name'=>'required|string|max:191',
        'last_name'=>'required|string|max:191',
        'email'=>['required','string','email','max:191',Rule::unique('users')->ignore($this->guard()->user())],
        'username'=>['required','string','max:191',Rule::unique('users')->ignore($this->guard()->user())]
        ]);
      }
      if($request->image){
        $new_image = time().".png";
        \Image::make(base64_decode($request->image))->save(public_path('user_images/').$new_image);
        $request->merge(['image'=>$new_image]);
          if(file_exists(public_path('user_images/'.$user->image))){
            @unlink(public_path('user_images/'.$user->image));
          }
      }
      $user->update($request->all());
      $user->update(['updated_at'=>time()]);
      return response()->json(['username' => $request->username]);
    }
    public function updatePassword(Request $request)
    {
      $user = $this->guard()->user();
      $this->validate($request,[
      'password'=>'required|string|min:8'
      ]);
      $password = Hash::make($request['password']);
      $request->merge(['password'=>$password]);
      $user->update($request->all());
      $user->update(['updated_at'=>time()]);
      return response()->json(['status' => 200]);
    }
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => auth()->user()->username,
            'email' => auth()->user()->email
        ]);
    }
    public function payload()
    {
      return auth()->payload();
    }
    public function refresh()
    {
      return $this->respondWithToken(auth()->refresh());
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
