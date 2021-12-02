<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Dept;
use App\Model\Doctor;
use App\Model\Schedule;
use Illuminate\Support\Facades\Validator;
use Session;

class ScheduleController extends Controller
{
    public function view()
    {    
        $data['docs'] = Doctor::all();
        $data['allData'] = Schedule::all();
        if(Session::has('msg')){
            Alert::success('Success', 'Schedule Added Successfully');
        }
        return view('backend.schedule.view-schedule',$data);
        
    }

    
    public function store(Request $request)
    {
        $data = new Schedule();
        $data->doctor_id = $request->doctor_id;
        $data->day= $request->day;
        $data->start_time= $request->start_time;
        $data->end_time= $request->end_time;
        $data->save();
        if ($data->save()) {
            return redirect()->route('schedules.view')->with('msg','Schedule Added Successfully');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }  
    }

    public function edit($id)
    {   
        $data['editData'] = Schedule::find($id);
        $data['docs'] = Doctor::all();
        return view('backend.schedule.edit-schedule',$data);
    }


    public function update(Request $request, $id)
    {

        $data = Schedule::find($id);
        $data->doctor_id = $request->doctor_id;
        $data->day= $request->day;
        $data->start_time= $request->start_time;
        $data->end_time= $request->end_time;
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'Schedule Updated Successfully');
            return redirect()->route('schedules.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function delete($id)
    {

        $data = Schedule::find($id);
        $data->delete();
        return redirect()->route('schedules.view');
    }
}
