<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
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
    	$records    =   Address::with('city');
    	if(is_numeric($id)){
    		$records    =   $records->where('id',   $id);
	    }

    	$records    =   $records->get();
    	return response()->json($records);
    }

    public function post(Request    $request){
    	$input  =   $request->only(['id', 'streetName', 'region', 'cityId', 'title',    'telephone',    'email']);
	    $rules  = [
		    'id'    =>  'required|unique:country|numeric|min:1',
		    'cityId'    =>  'required|exists:city,id|numeric|min:1',
		    'title'  =>  'required|min:3|max:255',
		    'telephone'  =>  'nullable|min:3|max:255',
		    'region'  =>  'nullable|min:3|max:255',
		    'streetName'  =>  'nullable|min:3|max:255',
	    ];

	    $validated  =   Validator::make($input,   $rules);
	    if($validated->fails()){
		    return response()->json(['status' => false,
			    'messages' => 'The given data was invalid.',
			    'errors' => $validated->errors()],
			    400);
	    }

	    try{
	    	$record =   Address::create($input);
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
	    $input  =   $request->only(['id', 'streetName', 'region', 'cityId', 'title',    'telephone',    'email']);
	    $rules  = [
		    'cityId'    =>  'nullable|exists:city,id|numeric|min:1',
		    'title'  =>  'nullable|min:3|max:255',
		    'telephone'  =>  'nullable|min:3|max:255',
		    'region'  =>  'nullable|min:3|max:255',
		    'streetName'  =>  'nullable|min:3|max:255',
	    ];

	    $validated  =   Validator::make($input,   $rules);
	    if($validated->fails()){
		    return response()->json(['status' => false,
			    'messages' => 'The given data was invalid.',
			    'errors' => $validated->errors()],
			    400);
	    }
	    $record =   Address::find($id);
	    if(!$record){
		    return response()->json(['status' => false,
			    'messages' => 'Cant add your record',
			    'errors' => ['Record is not found']],
			    404);
	    }
	    try{
	    	$record->update($input);

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
	    $record =   Address::find($id);
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
