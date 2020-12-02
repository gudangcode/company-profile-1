<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use Validator;
use Session;

class ServicesectionController extends Controller
{
    public function index() {
      return view('admin.home.service-section');
    }

    public function update(Request $request) {
      $rules = [
        'service_section_subtitle' => 'required|max:80',
        'service_section_title' => 'required|max:25'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $bs->service_section_subtitle = $request->service_section_subtitle;
      $bs->service_section_title = $request->service_section_title;
      $bs->save();

      Session::flash('success', 'Texts updated successfully!');
      return "success";
    }
}
