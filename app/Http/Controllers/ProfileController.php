<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class ProfileController extends Controller
{
    public function view()
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user.view-profile', compact('user'));
    }


    public function edit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.user.edit-profile', compact('editData'));
    }


    public function update(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
       
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/' . $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['image'] = $filename;
        }

        $data->save();
        Alert::success('Success', 'Profile Updated Successfully');
        return redirect()->route('profiles.view');
    }

    public function passwordView()
    {

        return view('backend.user.edit-password');
    }

    public function passwordUpdate(Request $request)
    {

        if (Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password])) {
            
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            if ($user->save()) {
                Alert::success('Success', 'Password Changed Successfully');
                return redirect()->route('profiles.view');
            }
        } else {
            Alert::error('Ooopss', 'your current password is incorrect');
        }

        return view('backend.user.edit-password');
    }

    
}
