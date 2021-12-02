<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Dept;
use App\Model\Doctor;
use App\Model\Test;
use App\Model\Testtype;
use PDF;
class TestController extends Controller
{
    public function view()
    {
      
        $data['allData'] = Test::all();
        $data['depts']= Dept::all();
        $data['types']= Testtype::all();
        return view('backend.test.view-test',$data);
    }
    
    public function add(){
        $data['depts']= Dept::all();
        $data['types']= Testtype::all();
        return view('backend.test.add-test',$data);
    }

    public function store(Request $request)
    {

        $test = new Test();
        $test->name = $request->name;
        $test->type_id = $request->type_id;
        $test->dept_id = $request->dept_id;
        $test->price = $request->price;
        $test->created_by = Auth::user()->name;
        $test->save();
        if ($test->save()) {
            Alert::success('Success', 'Test Added Successfully');
            return redirect()->route('tests.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function edit($id)
    {

        $data['editData'] = Test::find($id);
        $data['depts']= Dept::all();
        $data['types']= Testtype::all();
        return view('backend.test.edit-test', $data);
    }


    public function update(Request $request, $id)
    {

        $data = Test::find($id);
        $data->name = $request->name;
        $data->type_id= $request->type_id;
        $data->dept_id= $request->dept_id;
        $data->price= $request->price;
        $data->updated_by = Auth::user()->name;
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'Test Updated Successfully');
            return redirect()->route('tests.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function delete($id)
    {

        $test = Test::find($id);
        $test->delete();
        return redirect()->route('tests.view');
    }

    public function printTestListPdf()
    {
  
      $allData = Test::orderBy('dept_id', 'desc')->orderBy('type_id', 'desc')->get();
      $pdf = PDF::loadView('backend.pdf.all-test-pdf', $allData);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('all-test.pdf');
    }
  
}
