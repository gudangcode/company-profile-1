<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use Validator;
use Session;
use XSSCleaner;

class FooterController extends Controller
{
    public function index() {
      return view('admin.footer.logo-text');
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'footer_logo']);
      }

      @unlink("assets/front/img/footer_logo.jpg");
      $request->file('file')->move('assets/front/img/', 'footer_logo.jpg');
      return response()->json(['status' => "success", 'image' => 'Footer logo']);
    }

    public function update(Request $request) {
      $rules = [
        'footer_text' => 'required|max:255',
        'newsletter_text' => 'required|max:255',
        'copyright_text' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $bs->footer_text = $request->footer_text;
      $bs->newsletter_text = $request->newsletter_text;
      $bs->copyright_text = XSSCleaner::clean($request->copyright_text);
      $bs->save();

      Session::flash('success', 'Footer text updated successfully!');
      return "success";
    }
}
