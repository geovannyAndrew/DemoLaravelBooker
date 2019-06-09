<?php

namespace App\Http\Controllers;

use App\Grill;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Response;
use Storage;
use Carbon\Carbon;

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

    public function indexNear(Request $request){
        $location = $request->location;
        $latitude = null;
        $longitude = null;
        if(isset($location)){
            $locationSplit = explode(',',$location);
            $latitude = $locationSplit[0];
            $longitude = $locationSplit[1];
        }
        else{
            $g = geoip($ip = $request->ip());
            $latitude = $g->lat;
            $longitude = $g->lon;
        }
        $user = Auth::user();
        $coordinates = ['latitude' => $latitude, 'longitude' => $longitude];
        $grills = Grill::isWithinDistance($coordinates,10)->get();
        return view('user.grills_near')->with('grills',$grills);
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
            'zipcode' => 'required|integer',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $grill = new Grill();
        $grill->model = $request->model;
        $grill->description = $request->description;
        $grill->zipcode = $request->zipcode;
        $grill->latitude = $request->latitude;
        $grill->longitude = $request->longitude;
        $filename = basename($request->image->store('grills'));
        $grill->image = $filename;
        $grill->user_id = $renter->id;
        $grill->save();
        return redirect()->route('renter.grills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $grill = Grill::find($id);
        if(!isset($grill)) abort(404);
        return view('show_grill')->with('grill',$grill)->with('user',$user);
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


    public function book(Request $request, $id){
        $user = Auth::user();
        $grill = Grill::find($id);
        if(!isset($grill)) abort(404);
        $request->validate([
            'date' => 'required|date',
            'hours' => 'required|integer'
        ]);
        
        $date = $request->date;
        $bookingsAlready = $grill->bookings()->whereDate('reserved_for',$date)->count();
        if($bookingsAlready > 0){
            return redirect()->route('grills.show',$id)->with('error','We are sorry, this grill is already booked for this date');
        }
        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->grill_id = $grill->id;
        $booking->reserved_for = $date;
        $booking->hours = $request->hours;
        $booking->save();
        return redirect()->route('user.bookings')->with('success','Grill successfully booked');
        
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
