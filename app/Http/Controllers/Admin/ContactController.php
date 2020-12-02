<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting;
use Session;
use Validator;

class ContactController extends Controller
{
    public function index() {
      return view('admin.contact');
    }

    public function update(Request $request) {
      $request->validate([
        'contact_form_title' => 'required|max:255',
        'contact_form_subtitle' => 'required|max:255',
        'contact_address' => 'required|max:255',
        'contact_number' => 'required|max:255',
        'latitude' => 'required|max:255',
        'longitude' => 'required|max:255',
      ]);

      $bs = BasicSetting::first();
      $bs->contact_form_title = $request->contact_form_title;
      $bs->contact_form_subtitle = $request->contact_form_subtitle;
      $bs->contact_address = $request->contact_address;
      $bs->contact_number = $request->contact_number;
      $bs->latitude = $request->latitude;
      $bs->longitude = $request->longitude;
      $bs->save();

      Session::flash('success', 'Contact page updated successfully!');
      return back();
    }
}
