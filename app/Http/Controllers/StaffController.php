<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StaffsFormRequest;
use Illuminate\Http\Request;

use App\Staff;
use App\Project;

use Sentinel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Form;
use View;

class StaffController extends Controller
{
    
    protected $staff;
      public function __construct(Staff $staff)
      {
          $this->staff = $staff;
      }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //    
        $staffs = $this->staff->orderBy('last_name', 'ASC')->paginate(10);
        //dd($staffs);
          
        return view('manage.staff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
	public function create()
	{
	    //
	    $page_id = 'staff';
	    // Show the page
	    return view('manage.forms.create', compact('page_id'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StaffsFormRequest $request)
    {
        //       
        $staff = new Staff;
		$staff -> last_name = $request->last_name;
		$staff -> first_name = $request->first_name;      
        $staff -> save();   
               
        return \Redirect::route('manage.staff.index', array($staff->id))
            ->with('success', 'Your staff has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
		$result = Staff::findOrFail($id);
		$page_id = 'staff';        
		// Show the page        
		return view('manage.forms.edit',compact('result','page_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StaffsFormRequest $request, $id)
    {
        //
        $staff = Staff::findOrFail($id);
	    $staff -> last_name = $request->last_name;
	    $staff -> first_name = $request->first_name;
	    $staff -> save();
	    
	    return \Redirect::route('manage.staff.index', array($staff->id))
	        ->with('success', 'Your staff has been updated!');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return \Redirect::route('manage.staff.index')->with('warning', 'The staff has been deleted!');
    }
}
