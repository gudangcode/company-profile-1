<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;
use App\BasicSetting as BS;
use Validator;
use Session;

class TestimonialController extends Controller
{
    public function index() {
      $data['testimonials'] = Testimonial::all();
      return view('admin.home.testimonial.index', $data);
    }

    public function edit($id) {
      $data['testimonial'] = Testimonial::findOrFail($id);
      return view('admin.home.testimonial.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'testimonial']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('testimonial_image', $filename);
      $request->file('file')->move('assets/front/img/testimonials/', $filename);
      return response()->json(['status' => "session_put", "image" => "testimonial_image", 'filename' => $filename]);
    }

    public function uploadUpdate(Request $request, $id) {
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'testimonial']);
      }

      $testimonial = Testimonial::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/testimonials/', $filename);
        @unlink('assets/front/img/testimonials/'. $testimonial->image);
        $testimonial->image = $filename;
        $testimonial->save();
      }

      return response()->json(['status' => "success", "image" => "Testimonial", 'testimonial' => $testimonial]);
    }

    public function store(Request $request) {
      $rules = [
        'testimonial_image' => 'required',
        'comment' => 'required',
        'name' => 'required|max:50',
        'rank' => 'required|max:50',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $testimonial = new Testimonial;
      $testimonial->comment = $request->comment;
      $testimonial->name = $request->name;
      $testimonial->rank = $request->rank;
      $testimonial->image = $request->testimonial_image;
      $testimonial->save();

      Session::flash('success', 'Testimonial added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'comment' => 'required',
        'name' => 'required|max:50',
        'rank' => 'required|max:50',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $testimonial = Testimonial::findOrFail($request->testimonial_id);
      $testimonial->comment = $request->comment;
      $testimonial->name = $request->name;
      $testimonial->rank = $request->rank;
      $testimonial->save();

      Session::flash('success', 'Testimonial updated successfully!');
      return "success";
    }

    public function textupdate(Request $request) {
      $request->validate([
        'testimonial_section_title' => 'required|max:25',
        'testimonial_section_subtitle' => 'required|max:80',
      ]);

      $bs = BS::first();
      $bs->testimonial_title = $request->testimonial_section_title;
      $bs->testimonial_subtitle = $request->testimonial_section_subtitle;
      $bs->save();

      Session::flash('success', 'Text updated successfully!');
      return back();
    }

    public function delete(Request $request) {

      $testimonial = Testimonial::findOrFail($request->testimonial_id);
      @unlink('assets/front/img/testimonials/'. $testimonial->image);
      $testimonial->delete();

      Session::flash('success', 'Testimonial deleted successfully!');
      return back();
    }
}
