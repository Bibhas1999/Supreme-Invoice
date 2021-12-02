<?php

namespace App\Http\Controllers;

use App\Model\Dept;
use App\Model\InvoiceDetails;
use App\Model\Test;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function view()
    {

        $data['allData'] = User::all();
        $data['depts'] = Dept::all();
        return view('backend.user.view-user', $data);
    }

    public function edit($id)
    {

        $data['editData'] = User::find($id);
        $data['depts'] = Dept::all();
        return view('backend.user.edit-user', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'password2' => 'required',
            'usertype' => 'required',
        ]);
        $data = new User();
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->dept = $request->dept;
        $data->password = bcrypt($request->password);
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'User Added Successfully');
            return redirect()->route('users.view');
        } else {
            Alert::error('Failed', 'Opps..Something went wrong!');
        }
    }

    public function update(Request $request, $id)
    {

        $data = User::find($id);
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->dept = $request->dept;
        $data->save();
        if ($data->save()) {
            Alert::success('Success', 'User Updated Successfully');
            return redirect()->route('users.view');
        } else {
            Alert::error('Failed', 'Opps..Something went wrong!');
        }
    }

    public function switchUser($id)
    {

        $user = User::find($id);
        return view('backend.loginbypass', compact('user'));

    }
    public function switchUserLogin(Request $request, $id)
    {

        $user = User::find($id);
        $password = $request->password;
        if (Hash::check($password, $user->password)) {
            Auth::login($user);
            Alert::success('Success', 'Logged in as ' . Auth::user()->name);
            return redirect()->route('home');
        } else {

            return redirect()->back()->with('msg', 'Password is incorrect...try again!');
        }
    }

    public function getEmail()
    {
        $user = User::all()->first();
        return view('auth.passwords.email', compact('user'));
    }

    public function setNewPass(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user != null) {
            return view('auth.passwords.reset', compact('user'));
        } else {
            return redirect()->back()->with('msg', 'User Not Found..!');
        }
    }

    public function setNewPassword(Request $request, $id)
    {
        $user = User::find($id);
        $old_pass = $user->password;
        $new_pass = $request->new_pass;
        $c_pass = $request->c_pass;
        if (Hash::check($new_pass, $old_pass)) {
            Alert::Error('Failed', 'Seems like you can recall your password now.');
            return redirect()->route('login');

        }
        if ($user != null) {
            if ($c_pass == $new_pass) {
                $user->password = Hash::make($new_pass);
                $user->save();
                Alert::Success('Success', 'Password Reset Successful.');
                return redirect()->route('login');
            } else {

                return redirect()->route('login');
                Alert::Error('Failed', 'Password not matched');
            }
        } else {
            Alert::Error('Failed', 'No user found');
        }
    }

    public function RedirectToDept($id)
    {
        $dept_id = Dept::find($id);
        return view('backend.loginbydept', compact('dept_id'));
    }

    public function RedirectToDeptbyPass($id, Request $request)
    {
        $dept_id = Dept::find($id);
        $password = $request->password;
        $user_id = Auth::user()->id;
        $all_tests = Test::where('dept_id', $dept_id->id)->first();

        if (Auth::user()->usertype == "Admin" || Auth::user()->usertype == "Manager" || Auth::user()->usertype == "Receptionist") {
            if (Hash::check($password, Auth::user()->password)) {
                return redirect()->route('dept_single.view', $dept_id);

            } else {
                return redirect()->back()->with('msg', 'Your password  is incorrect..Please check and try again');

            }
        }

        if (Auth::user()->dept == $dept_id->id) {
            if (Hash::check($password, Auth::user()->password)) {
                return redirect()->route('dept_single.view', $dept_id);

            }
        } else {
            return redirect()->back()->with('msg', 'Your password or Department is incorrect..Please check and try again');
        }

    }

    public function RedirectToRecp()
    {
        return view('backend.receptlogin');
    }
    public function RedirectToRecpview(Request $request)
    {
        $user_id = Auth::user()->id;
        $password = $request->password;
        if (Auth::user()->usertype == "Admin" || Auth::user()->usertype == "Manager" || Auth::user()->usertype == "Receptionist") {

            if (Hash::check($password, Auth::user()->password)) {

                return redirect()->route('invoice.add');
            } else {
                return redirect()->back()->with('msg', 'Your password is incorrect..Please check and try again');

            }
        }else {
            return redirect()->back()->with('msg', 'Your password or Department is incorrect..Please check and try again');

        }

    }

    public function RedirectToOPD()
    {
        return view('backend.opdlogin');
    }

    public function opdView()
    {
        return view('backend.opd-view');
    }
    public function RedirectToOPDview(Request $request)
    {
        $user_id = Auth::user()->id;
        $password = $request->password;
        if (Auth::user()->usertype == "Admin" || Auth::user()->usertype == "Manager" || Auth::user()->usertype == "Receptionist") {
            if (Hash::check($password, Auth::user()->password)) {

                return redirect()->route('opd.view');
            } else {
                return redirect()->back()->with('msg', 'Your password is incorrect..Please check and try again');

            }
        }else {
            return redirect()->back()->with('msg', 'Your password or Department is incorrect..Please check and try again');

        }

    }

    public function ReportUpload(Request $request, $id)
    {
        $report_id = InvoiceDetails::find($id);

        $request->validate([
            'report_file' => 'required|mimes:pdf,xlx,csv,docx|max:4096',
        ]);
        $fileName = $request->report_file->getClientOriginalName();
        $report_id->report_file = $request->report_file->move('uploads', $fileName);
        $report_id->report_file = $fileName;
        $report_id->save();
        Alert::Success('Success', 'File Uploaded Successfully');
        return back()->with('success', 'You have successfully upload file.');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.view');
    }
}
