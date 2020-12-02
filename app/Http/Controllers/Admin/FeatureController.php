<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feature;
use Validator;
use Session;

class FeatureController extends Controller
{
    public function index() {
      $data['features'] = Feature::all();
      return view('admin.home.feature.index', $data);
    }

    public function edit($id) {
      $data['feature'] = Feature::findOrFail($id);
      return view('admin.home.feature.edit', $data);
    }

    public function store(Request $request) {
      $count = Feature::count();
      if ($count == 4) {
        Session::flash('warning', 'You cannot add more than 4 features!');
        return "success";
      }

      $rules = [
        'icon' => 'required',
        'title' => 'required|max:50'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $feature = new Feature;
      $feature->icon = $request->icon;
      $feature->title = $request->title;
      $feature->save();

      Session::flash('success', 'Feature added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'icon' => 'required',
        'title' => 'required|max:50'
      ];

      $request->validate($rules);

      $feature = Feature::findOrFail($request->feature_id);
      $feature->icon = $request->icon;
      $feature->title = $request->title;
      $feature->save();

      Session::flash('success', 'Feature updated successfully!');
      return back();
    }

    public function delete(Request $request) {

      $feature = Feature::findOrFail($request->feature_id);
      $feature->delete();

      Session::flash('success', 'Feature deleted successfully!');
      return back();
    }
}
