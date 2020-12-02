<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use Validator;
use Session;

class HerosectionController extends Controller
{
    public function static() {
      return view('admin.home.hero.static');
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'hero_bg']);
      }

      @unlink("assets/front/img/hero_bg.jpg");
      $request->file('file')->move('assets/front/img/', 'hero_bg.jpg');
      return response()->json(['status' => "success", 'image' => 'Hero section image']);
    }

    public function update(Request $request) {
      $rules = [
        'hero_section_title' => 'required|max:40',
        'hero_section_text' => 'required|max:80',
        'hero_section_button_text' => 'required|max:15',
        'hero_section_button_url' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $bs->hero_section_title = $request->hero_section_title;
      $bs->hero_section_text = $request->hero_section_text;
      $bs->hero_section_button_text = $request->hero_section_button_text;
      $bs->hero_section_button_url = $request->hero_section_button_url;
      $bs->save();

      Session::flash('success', 'Informations updated successfully!');
      return "success";
    }

    public function video() {
      return view('admin.home.hero.video');
    }

    public function videoupdate(Request $request) {
      $rules = [
        'video_link' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $videoLink = $request->video_link;
      if (strpos($videoLink, "&") != false) {
        $videoLink = substr($videoLink, 0, strpos($videoLink, "&"));
      }
      $bs->hero_section_video_link = $videoLink;
      $bs->save();

      Session::flash('success', 'Informations updated successfully!');
      return "success";
    }
}
