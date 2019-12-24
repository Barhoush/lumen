<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
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
    	$records    =   City::with('addresses');
    	if(is_numeric($id)){
    		$records    =   $records->where('id',   $id);
	    }

    	$records    =   $records->get();
    	return response()->json($records);
    }

    public function post(Request    $request){
    	$input  =   $request->only(['id', 'name', 'countryId']);
	    $rules  = [
		    'id'    =>  'required|unique:country|numeric|min:1',
		    'countryId'    =>  'required|exists:country,id|numeric|min:1',
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
	    	$record =   City::create($input);
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
    	$input  =   $request->only(['name', 'countryId']);

	    $rules  = [
		    'name'  =>  'nullable|min:3|max:255',
		    'countryId'    =>  'nullable|exists:country,id|numeric|min:1',
	    ];

	    $validated  =   Validator::make($input,   $rules);
	    if($validated->fails()){
		    return response()->json(['status' => false,
			    'messages' => 'The given data was invalid.',
			    'errors' => $validated->errors()],
			    400);
	    }
	    $record =   City::find($id);
	    if(!$record){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => ['Record is not found']],
			    404);
	    }
	    try{
	    	$record->name   =   $input['name'];
	    	$record->countryId   =   $input['countryId'];
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
	    $record =   City::find($id);
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
