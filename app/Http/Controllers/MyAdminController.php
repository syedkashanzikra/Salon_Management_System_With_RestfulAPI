<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class MyAdminController extends Controller
{
    public function UpdateProfile(Request $req){
        $id = Auth::user()->id;
        $data = User::find($id);
    
        $data->first_name = $req->edit_first_name;
        $data->last_name = $req->edit_last_name;
        $data->email = $req->edit_email;
        $data->mobile = $req->edit_mobile;
    
        if ($req->file('profile_image')) {
            $file = $req->file('profile_image');
    
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->profile_picture = $filename;
        }
    
        $data->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');

    }
}
