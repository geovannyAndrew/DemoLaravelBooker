<?php

namespace App\Http\Controllers;

use App\Grill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Response;
use Storage;

class GrillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $renter = Auth::user();
        $grills = $renter->grills;
        return view('renter.grills')->with('grills',$grills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('renter.create_grill');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $renter = Auth::user();
        $request->validate([
            'model' => 'required',
            'image' => 'required|image',
            'zipcode' => 'required|integer'
        ]);

        $grill = new Grill();
        $grill->model = $request->model;
        $grill->description = $request->description;
        $grill->zipcode = $request->zipcode;
        $filename = basename($request->image->store('grills'));
        $grill->image = $filename;
        $grill->user_id = $renter->id;
        $grill->save();
        return redirect()->route('grills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showImage($name){
        $path = storage_path('app/grills/' . $name);
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
	    $type = File::mimeType($path);
	    $response = Response::make($file, 200);
	    $response->header("Content-Type", $type);

	    return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
