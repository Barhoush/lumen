<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function get($id =   'ALL'){
    	$records    =   Country::with('cities');
    	if(is_numeric($id)){
    		$records    =   $records->where('id',   $id);
	    }

    	$records    =   $records->get();
    	return response()->json($records);
    }

    public function post(Request    $request){
    	$input  =   $request->only(['id', 'name']);
	    $rules  = [
	    	'id'    =>  'required|unique:country|numeric|min:1',
		    'name'  =>  'required|min:3|max:255',
	    ];

	    $validated  =   Validator::make($input,   $rules);
	    if($validated->fails()){
		    return response()->json(['status' => false,
			    'messages' => 'The given data was invalid.',
			    'errors' => $validated->errors()],
			    400);
	    }

	    try{
	    	$record =   Country::create($input);
	    }catch (\Exception  $exception){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => [$exception->getMessage()]],
			    500);
	    }


	    return response()->json([
	    	'status'    =>  true,
		    'message'   =>  'Record has been added',
		    'record'    =>  $input
	    ]);
    }

    public function put($id,    Request    $request){
    	$input  =   $request->only(['id', 'name']);

	    $rules  = [
		    'name'  =>  'nullable|min:3|max:255',
	    ];

	    $validated  =   Validator::make($input,   $rules);
	    if($validated->fails()){
		    return response()->json(['status' => false,
			    'messages' => 'The given data was invalid.',
			    'errors' => $validated->errors()],
			    400);
	    }
	    $record =   Country::find($id);
	    if(!$record){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => ['Record is not found']],
			    404);
	    }
	    try{
	    	$record->name   =   $input['name'];
	    	$record->update();
	    }catch (\Exception  $exception){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => [$exception->getMessage()]],
			    500);
	    }


	    return response()->json([
	    	'status'    =>  true,
		    'message'   =>  'Record has been updated successfully',
		    'record'    =>  $record
	    ]);
    }

    public function destroy($id){
	    $record =   Country::find($id);
	    if(!$record){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => ['Record is not found']],
			    404);
	    }
	    try{
		    $record->delete();
	    }catch (\Exception  $exception){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => [$exception->getMessage()]],
			    500);
	    }

	    return response()->json([
		    'status'    =>  true,
		    'message'   =>  'Record has been deleted successfully',
		    'record'    =>  $record
	    ]);
    }


    //
}
