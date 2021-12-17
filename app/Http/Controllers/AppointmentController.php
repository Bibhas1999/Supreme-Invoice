<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Appointment;
use App\Model\Doctor;
use App\Model\Schedule;
use RealRashid\SweetAlert\Facades\Alert;
class AppointmentController extends Controller
{
    public function view(){
        
        $data['allData'] = Appointment::all();
        $data['schedule'] = Schedule::all();
        return view('backend.appointment.view-appointment',$data);
    }

   

    public function store(Request $request){

        
        $app = new Appointment();
        $app->app_no = "APSHC".time();
        $app->patient_name = $request->patient_name;
        $app->patient_email = $request->patient_email;
        $app->patient_mobile = $request->patient_mobile;
        $app->age = $request->patient_age;
        $app->gender = $request->patient_gender;
        $app->patient_address = $request->patient_address;
        $app->gurdian_name = $request->gurdian_name;
        $app->patient_ip = "";
        $app->schedule_id = $request->schedule_id;
        $app->date = $request->date; 
        $app->type = "offline";
        $app->save();
        if($app->save()){
            Alert::success('Success', 'Appointment Added Successfully');
            return redirect()->route('apps.view');
         }else{
            Alert::failed('Failed', 'Appointment Added Successfully');
            return redirect()->back();
         }
    }

    public function edit($id)
    {
        $editData =  Appointment::find($id);
        return view('backend.appointment.edit-appointment', compact('editData'));
    }

    public function update(Request $request , $id){

        
        $app = Appointment::find($id);
        $app->app_no = $request->app_no;
        $app->patient_name = $request->patient_name;
        $app->patient_email = $request->patient_email;
        $app->patient_mobile = $request->patient_mobile;
        $app->age = $request->patient_age;
        $app->gender = $request->patient_gender;
        $app->patient_address = $request->patient_address;
        $app->gurdian_name = $request->gurdian_name;
        $app->patient_ip = "";
        $app->schedule_id = $request->schedule_id;
        $app->date = $request->date; 
        $app->type = "offline";
        $app->save();
        if($app->save()){
            Alert::success('Success', 'Appointment Updated Successfully');
            return redirect()->route('apps.view');
         }else{
            Alert::failed('Failed', 'Appointment Updated Successfully');
            return redirect()->back();
         }
    }

    public function delete($id)
    {
  
      $app = Appointment::find($id);
      $app->delete();
  
      return redirect()->route('apps.view');
    }

    public function appBydoctor($id, $sche_id)
    {
        $data['doctor'] = Doctor::find($id);
        $data['schedule'] = Schedule::find($sche_id);
        return view('backend.appbydoctor',$data);
    }
}
