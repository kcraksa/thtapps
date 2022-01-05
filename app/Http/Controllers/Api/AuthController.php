<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

/**
 * 
 */
class AuthController extends BaseController
{
	
	function signin(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$authUser = Auth::user();

			$success['token'] = $authUser->createToken('yuKP!kN1c')->plainTextToken;
			$success['name'] = $authUser->name;

			return $this->sendResponse($success, 'User signed in.');
		} else {
			return $this->sendError('Unauthorized!', ['error' => 'Unauthorized']);
		}
	}

	public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User created successfully.');
    }
}

?>