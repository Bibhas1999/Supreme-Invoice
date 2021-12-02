<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Dept;

class DeptController extends Controller
{
    public function view()
    {
        $allData = Dept::all();

        return view('backend.dept.view-dept', compact('allData'));
    }


    
    public function store(Request $request)
    {

        $dept = new Dept();
        $dept->name = $request->name;
        $dept->created_by = Auth::user()->name;
        $dept->save();
        if ($dept->save()) {
            Alert::success('Success', 'Department Added Successfully');
            return redirect()->route('depts.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function edit($id)
    {

        $editData = Dept::find($id);
        return view('backend.dept.edit-dept', compact('editData'));
    }


    public function update(Request $request, $id)
    {

        $data = Dept::find($id);
        $data->name = $request->name;
        $data->updated_by = Auth::user()->name;
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'Department Updated Successfully');
            return redirect()->route('depts.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function delete($id)
    {

        $category = Dept::find($id);
        $category->delete();
        return redirect()->route('depts.view');
    }

    public function DeptView($id)
    {
        $dept_id = Dept::find($id);
        return view('backend.dept.dept_single',compact('dept_id'));
    }
}
