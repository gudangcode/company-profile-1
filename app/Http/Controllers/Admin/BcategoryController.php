<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bcategory;
use Validator;
use Session;

class BcategoryController extends Controller
{
    public function index() {
      $data['bcategorys'] = Bcategory::paginate(10);
      return view('admin.blog.bcategory.index', $data);
    }

    public function edit($id) {
      $data['bcategory'] = Bcategory::findOrFail($id);
      return view('admin.blog.bcategory.edit', $data);
    }

    public function store(Request $request) {
      $rules = [
        'name' => 'required|max:255',
        'status' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bcategory = new Bcategory;
      $bcategory->name = $request->name;
      $bcategory->status = $request->status;
      $bcategory->save();

      Session::flash('success', 'Blog category added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'name' => 'required|max:255',
        'status' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bcategory = Bcategory::findOrFail($request->bcategory_id);
      $bcategory->name = $request->name;
      $bcategory->status = $request->status;
      $bcategory->save();

      Session::flash('success', 'Blog category updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $bcategory = Bcategory::findOrFail($request->bcategory_id);
      if ($bcategory->blogs()->count() > 0) {
        Session::flash('warning', 'First, delete all the blogs under this category!');
        return back();
      }
      $bcategory->delete();

      Session::flash('success', 'Blog category deleted successfully!');
      return back();
    }
}
