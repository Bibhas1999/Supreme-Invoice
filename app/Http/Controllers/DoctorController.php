<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Dept;
use App\Model\Doctor;
use Illuminate\Support\Facades\Validator;
use Session;
class DoctorController extends Controller
{
    public function view()
    {
        $allData = Doctor::all();
        if(Session::has('msg')){
            Alert::success('Success', 'Doctor Added Successfully');
        }
       
        return view('backend.doctor.view-doctor',compact('allData'));
        
    }

    
    public function store(Request $request)
    {
        $data = new Doctor();
        $data->name = "Dr."." ".$request->name;
        $data->spec= $request->spec;
        $data->degree= $request->degree;
        $data->created_by = Auth::user()->name;
        $data->save();
        if ($data->save()) {
            return redirect()->route('doctors.view')->with('msg','Doctor Added Successfully');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }  
    }

    public function edit($id)
    {

        $editData = Doctor::find($id);
        return view('backend.doctor.edit-doctor', compact('editData'));
    }


    public function update(Request $request, $id)
    {

        $data = Doctor::find($id);
        $data->name = $request->name;
        $data->spec= $request->spec;
        $data->degree= $request->degree;
        $data->updated_by = Auth::user()->name;
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'Doctor Updated Successfully');
            return redirect()->route('doctors.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function delete($id)
    {

        $docs = Doctor::find($id);
        $docs->delete();
        return redirect()->route('doctors.view');
    }
}
