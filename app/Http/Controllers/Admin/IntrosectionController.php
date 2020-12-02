<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use Validator;
use Session;

class IntrosectionController extends Controller
{
    public function index() {
      return view('admin.home.intro-section');
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'intro_bg']);
      }

      @unlink("assets/front/img/intro_bg.jpg");
      $request->file('file')->move('assets/front/img/', 'intro_bg.jpg');
      return response()->json(['status' => "success", 'image' => 'Intro section image']);
    }

    public function update(Request $request) {
      $rules = [
        'intro_section_title' => 'required|max:25',
        'intro_section_text' => 'required|max:80',
        'intro_section_button_text' => 'required|max:15',
        'intro_section_button_url' => 'required|max:255',
        'intro_section_video_link' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $bs->intro_section_title = $request->intro_section_title;
      $bs->intro_section_text = $request->intro_section_text;
      $bs->intro_section_button_text = $request->intro_section_button_text;
      $bs->intro_section_button_url = $request->intro_section_button_url;
      $videoLink = $request->intro_section_video_link;
      if (strpos($videoLink, "&") != false) {
        $videoLink = substr($videoLink, 0, strpos($videoLink, "&"));
      }
      $bs->intro_section_video_link = $videoLink;
      $bs->save();

      Session::flash('success', 'Informations updated successfully!');
      return "success";
    }
}
