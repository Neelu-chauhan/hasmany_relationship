<?php

namespace App\Http\Controllers;

use App\Models\resultModel;
use App\Models\studentModel;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    ////////////////////////////// ONE TO ONE(HASONE) RELATIONSHIP START///////////////////////////////////////
    public function index1()
    {
        // $student_data =studentModel::get();
        // $student_data = studentModel::with('getresult')->get(); // Eager load the 'result' relationship
        // dd($student_data[0]->getresult->marks);
        // dd($student_data->toArray());
        // dd($student_data[1]->getresult->toArray());
        // dd(@$student_data[0]->getresult);

        // when you want to fetch some data from result table and some data from student table we use withwherehas

        $getdaata = studentModel::withWhereHas('getresult', function ($var) { 
                                    $var->where('marks', 99);
                                })->get()->toArray();
        dd($getdaata);

        // wherehas not show the table data but perform the operation
        return view('relationship', compact('student_data'));
    }
    /////////////////////////// ONE TO ONE(HASONE) RELATIONSHIP END////////////////////////////////////////////

    ////////////////////////////////BELONGS TO(INVERSE RELATIONSHIP) START///////////////////////////////////////
    // forign key wale tbl se data get
    public function index()
    {
        // $results = resultModel::get();
        // dd($results[0]->getstudent->toArray());
        // $getstudentdata = resultModel::with('getstudent')->get()->toArray();
        $getstudentdata = resultModel::withWhereHas('getstudent',function($var){//withwherehas use when we want to check any condition on forign key wala tbl
                                      $var->where('name',"Neelu");
                                        })
                                    ->get()->toArray();
        dd($getstudentdata);
    }
    ////////////////////////////////BELONGS TO(INVERSE RELATIONSHIP) END///////////////////////////////////////





    public function store_branch(Request $request)
    {
        // dd($request);

    $this->validate(
        $request,
        [
            'country_id_fk'  => 'required', 
            'region2'        => 'required',
            'city2'          => 'required',
            'suburb'         => 'required',
            'post_code'      => 'required',
            'place_name'      => 'required',
            'latitude'        => 'required',
            'longitude'       => 'required',
        ],
        [
            'country_id_fk.required'  => 'Country field is required.',
            'region2.required'        => 'Region name field is required.',
            'city2.required'          => 'City field is required.',
            'post_code.required'      => 'Post code is required.',
            'suburb.required'         => 'Suburb Name field is required.',
            'place_name.required'     => 'place Name field is required.',
            'latitude.required'       => 'latitude field is required.',
            'longitude.required'       => 'longitude field is required.',
           // 'email.email'             => 'Please enter a valid email address.',
        ]
    );


    DB::beginTransaction();

    try {
       
        $place_id = $request->place_id;
        $place = GooglePlaceModel::where('place_id', $place_id)->first();
        
        if (!isset($place) || empty($place)) {

            $agency_place = new GooglePlaceModel();
            $agency_place->place_name = $request->place_name;
            $agency_place->title      = $request->title;
            $agency_place->latitude   = $request->latitude;
            $agency_place->longitude  = $request->longitude;
            $agency_place->place_id   = $place_id;
            $agency_place->post_code  = $request->post_code;
            $agency_place->reference  = $request->reference;
            $agency_place->formatted_address  = $request->formatted_address;

            $agency_place->save();
            $agency_place_id = $agency_place->id;

        } else {

            $agency_place_id = $place->id;
        }
      
        if(isset($agency_place_id) && !empty($agency_place_id)) {

           
            $agency_branch = new AgencyBranch2Model();
            $agency_branch->country_id_fk2            = $request->country_id_fk;
            $agency_branch->region_id_fk2             = $request->region2;
            $agency_branch->city_id_fk2               = $request->city2;
            $agency_branch->suburb_id_fk2             = $request->suburb;
            $agency_branch->agency_id_fk              = $request->agency_id_fk;
            $agency_branch->email                     = $request->email;
            $agency_branch->status                    = $request->status;
            $agency_branch->google_place_id_fk        = $agency_place_id;
            // Get office ID by user details
            $user_details_data = UserDetailsModel::where('user_id_fk', Auth::id())->first();

            if ( isset($user_details_data) && !empty($user_details_data->office_id_fk)) {
                $agency_branch->office_id_fk = $user_details_data->office_id_fk;
            } else{
                $agency_branch->office_id_fk = 0;
            }
            if ($agency_branch->save()) {

                DB::commit();
                session()->flash('success', 'Agency branch saved successfully.');
                return response()->json(['success' => true, 'message' => 'Agency Branch has been added successfully.']);
            //    return redirect('/agency/branch/list/' . $request->agency_id_fk)->with('success', 'Agency Branch has been added successfully.');
            }
        }

    } catch (Exception $e) {

        DB::rollBack();
        Log::error('Failed to save data: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Failed to save data. Please try again']);

        // return redirect()->back()->with('error', 'Failed to save data. Please try again.');
    }
}
}
