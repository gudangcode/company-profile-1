<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use Validator;
use Session;

class CtaController extends Controller
{
    public function index() {
      return view('admin.home.cta');
    }

    public function upload(Request $request) {
      $img = $request->file('file');
      $allowedExts = array('jpg', 'png', 'jpeg');

      $rules = [
        'file' => [
          function($attribute, $value, $fail) use ($img, $allowedExts) {
            if (!empty($img)) {
              $ext = $img->getClientOriginalExtension();
              if(!in_array($ext, $allowedExts)) {
                  return $fail("Only png, jpg, jpeg image is allowed");
              }
            }
          },
        ],
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $validator->getMessageBag()->add('error', 'true');
        return response()->json(['errors' => $validator->errors(), 'id' => 'cta_bg']);
      }

      @unlink("assets/front/img/cta_bg.jpg");
      $request->file('file')->move('assets/front/img/', 'cta_bg.jpg');
      return response()->json(['status' => "success", 'image' => 'Background image']);
    }

    public function update(Request $request) {
      $rules = [
        'cta_section_text' => 'required|max:80',
        'cta_section_button_text' => 'required|max:15',
        'cta_section_button_url' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $bs->cta_section_text = $request->cta_section_text;
      $bs->cta_section_button_text = $request->cta_section_button_text;
      $bs->cta_section_button_url = $request->cta_section_button_url;
      $bs->save();

      Session::flash('success', 'Texts updated successfully!');
      return "success";
    }
}
