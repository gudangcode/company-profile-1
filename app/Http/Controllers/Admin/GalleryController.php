<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Gallery;
use Validator;
use Session;

class GalleryController extends Controller
{
    public function index() {
      $data['galleries'] = Gallery::orderBy('id', 'DESC')->paginate(10);
      return view('admin.gallery.index', $data);
    }

    public function edit($id) {
      $data['gallery'] = Gallery::findOrFail($id);
      return view('admin.gallery.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'gallery']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('gallery_image', $filename);
      $request->file('file')->move('assets/front/img/gallery/', $filename);
      return response()->json(['status' => "session_put", "image" => "gallery", 'filename' => $filename]);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'gallery']);
      }

      $gallery = Gallery::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/gallery/', $filename);
        @unlink('assets/front/img/gallery/'. $gallery->image);
        $gallery->image = $filename;
        $gallery->save();
      }

      return response()->json(['status' => "success", "image" => "Gallery image", 'gallery' => $gallery]);
    }

    public function store(Request $request) {
      $messages = [
        'gallery.required' => 'Image is required',
      ];

      $rules = [
        'gallery' => 'required',
        'title' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $gallery = new Gallery;
      $gallery->image = $request->gallery;
      $gallery->title = $request->title;
      $gallery->save();

      Session::flash('success', 'Image added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $gallery = Gallery::findOrFail($request->gallery_id);

      $rules = [
        'title' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $gallery = Gallery::findOrFail($request->gallery_id);
      $gallery->title = $request->title;
      $gallery->save();

      Session::flash('success', 'Gallery updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $gallery = Gallery::findOrFail($request->gallery_id);
      @unlink('assets/front/img/gallery/'. $gallery->main_image);
      $gallery->delete();

      Session::flash('success', 'Image deleted successfully!');
      return back();
    }
}
