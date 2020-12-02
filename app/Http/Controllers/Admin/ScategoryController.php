<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Scategory;
use Validator;
use Session;

class ScategoryController extends Controller
{
    public function index() {
      $data['scategorys'] = Scategory::paginate(10);
      return view('admin.service.scategory.index', $data);
    }

    public function edit($id) {
      $data['scategory'] = Scategory::findOrFail($id);
      return view('admin.service.scategory.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'service_category_icon']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('service_category_icon_image', $filename);
      $request->file('file')->move('assets/front/img/service_category_icons/', $filename);
      return response()->json(['status' => "session_put", "image" => "service_category_icon", 'filename' => $filename]);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'scategory']);
      }

      $scategory = Scategory::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/service_category_icons/', $filename);
        @unlink('assets/front/img/service_category_icons/'. $scategory->image);
        $scategory->image = $filename;
        $scategory->save();
      }

      return response()->json(['status' => "success", "image" => "Category icon", 'scategory' => $scategory]);
    }

    public function store(Request $request) {
      $rules = [
        'service_category_icon' => 'required',
        'name' => 'required|max:255',
        'short_text' => 'required|max:120',
        'status' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $scategory = new Scategory;
      $scategory->name = $request->name;
      $scategory->image = $request->service_category_icon;
      $scategory->status = $request->status;
      $scategory->short_text = $request->short_text;
      $scategory->save();

      Session::flash('success', 'Category added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'name' => 'required|max:255',
        'status' => 'required',
        'short_text' => 'required|max:120'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $scategory = Scategory::findOrFail($request->scategory_id);
      $scategory->name = $request->name;
      $scategory->status = $request->status;
      $scategory->short_text = $request->short_text;
      $scategory->save();

      Session::flash('success', 'Category updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $scategory = Scategory::findOrFail($request->scategory_id);
      if ($scategory->services()->count() > 0) {
        Session::flash('warning', 'First, delete all the services under this category!');
        return back();
      }
      @unlink('assets/front/img/service_category_icons/'. $scategory->image);
      $scategory->delete();

      Session::flash('success', 'Scategory deleted successfully!');
      return back();
    }
}
