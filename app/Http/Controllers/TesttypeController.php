<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Model\Testtype;
class TesttypeController extends Controller
{
    public function view()
    {
        $allData =Testtype::all();

        return view('backend.test.view-testtype', compact('allData'));
    }


    
    public function store(Request $request)
    {

        $testtype = new Testtype();
        $testtype->typename = $request->typename;
        $testtype->created_by = Auth::user()->name;
        $testtype->save();
        if ($testtype->save()) {
            Alert::success('Success', 'Test type Added Successfully');
            return redirect()->route('testtypes.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function edit($id)
    {
        $editData = Testtype::find($id);
        return view('backend.test.edit-testtype', compact('editData'));
    }


    public function update(Request $request, $id)
    {

        $data = Testtype::find($id);
        $data->typename = $request->typename;
        $data->updated_by = Auth::user()->name;
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'Testtype Updated Successfully');
            return redirect()->route('testtypes.view');
        } else {
            Alert::error('Failed', 'Oppps..something went wrong!');
        }
    }

    public function delete($id)
    {

        $category = Testtype::find($id);
        $category->delete();
        return redirect()->route('testtypes.view');
    }
}
