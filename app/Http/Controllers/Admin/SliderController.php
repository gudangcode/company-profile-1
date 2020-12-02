<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Validator;
use Session;

class SliderController extends Controller
{
    public function index() {
      $data['sliders'] = Slider::all();
      return view('admin.home.hero.slider.index', $data);
    }

    public function edit($id) {
      $data['slider'] = Slider::findOrFail($id);
      return view('admin.home.hero.slider.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'slider']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('slider_image', $filename);
      $request->file('file')->move('assets/front/img/sliders/', $filename);
      return response()->json(['status' => "session_put", "image" => "slider_image", 'filename' => $filename]);
    }

    public function store(Request $request) {
      $rules = [
        'slider_image' => 'required',
        'title' => 'required|max:40',
        'text' => 'required|max:80',
        'button_text' => 'required|max:15',
        'button_url' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $slider = new Slider;
      $slider->title = $request->title;
      $slider->text = $request->text;
      $slider->button_text = $request->button_text;
      $slider->button_url = $request->button_url;
      $slider->image = $request->slider_image;
      $slider->save();

      Session::flash('success', 'Slider added successfully!');
      return "success";
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'slider']);
      }

      $slider = Slider::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/sliders/', $filename);
        @unlink('assets/front/img/sliders/'. $slider->image);
        $slider->image = $filename;
        $slider->save();
      }

      return response()->json(['status' => "success", "image" => "Slider", 'slider' => $slider]);
    }

    public function update(Request $request) {
      $rules = [
        'title' => 'required|max:40',
        'text' => 'required|max:80',
        'button_text' => 'required|max:15',
        'button_url' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $slider = Slider::findOrFail($request->slider_id);
      $slider->title = $request->title;
      $slider->text = $request->text;
      $slider->button_text = $request->button_text;
      $slider->button_url = $request->button_url;
      $slider->save();

      Session::flash('success', 'Slider updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $slider = Slider::findOrFail($request->slider_id);
      @unlink('assets/front/img/sliders/'. $slider->image);
      $slider->delete();

      Session::flash('success', 'Slider deleted successfully!');
      return back();
    }
}
