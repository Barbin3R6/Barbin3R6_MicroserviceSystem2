<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request){

        $this->request = $request;

    }
 
    public function getUsers(){

        //$users = User::all();
        //return response()->json($users, 200);

        $users = DB::connection('mysql')
        ->select("Select * from userinfo");

        //return response()->json($users, 200);
        return $this->successResponse($users);
    }
    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     *     
     * */
    public function index(){
        $users = User::all();

        return $this->successResponse($users);
    }

    public function add(Request $request){
        $rules = [
            'fname' => 'required|max:255;',
            'lname' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'status' => 'required|in:1,0',
        ];

        $this->validate($request,$rules);
        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }
    //don't forget to add timestamp for updated_at and created_at incase it gets error

    /**
     * Obtains and show one author
     * @return Illuminate\Http\Response
     */
    public function show($id){
        
        $user = User::findOrFail($id);
        return $this->successResponse($user);
        
        /*$user = User::where('userid', $id)->first();

        if($user){
            return $this->successResponse($user);
        }
        {
            return $this->errorResponse('User ID does not exists', Response::HTTP_NOT_FOUND);
        }
        */
    }

    public function update(Request $request, $id){
        $rules = [
            'fname' => 'max:255;',
            'lname' => 'max:255',
            'username' => 'max:255',
            'password' => 'max:255',
            'status' => 'in:1,0',
        ];
    
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
        
        $user->fill($request->all());

        //if no changes happen

        if ($user->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);

        /*
        $user = User::where('userid', $id)->first();
    
    
        if($user){
            $user->fill($request->all());
            
            //if no change happen
            if($user->isClean()){
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
    
        $user->save();
    
        return $this->successResponse($user);
        }
        */
    
    }

    /**
    * Remove an Existing user
    * @return Illuminate\Http\Response
    */

    public function delete($id){

	$user = User::findOrFail($id);
	$user->delete();

    return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
    
    /*
    $user = User::where('userid', $id)->first();
	
	if($user){
		$user->delete();
		return $this->successResponse($user);
	}

	{
		return $this->errorResponse('User ID does not exists', Response::HTTP_NOT_FOUND);
	}
    */
}   

}