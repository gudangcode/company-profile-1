<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use App\Point;
use Session;
use Validator;

class ApproachController extends Controller
{
    public function index() {
      $data['points'] = Point::orderBy('id', 'DESC')->get();
      return view('admin.home.approach.index', $data);
    }

    public function store(Request $request) {
      $rules = [
        'title' => 'required|max:20',
        'short_text' => 'required|max:160',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $point = new Point;
      $point->icon = $request->icon;
      $point->title = $request->title;
      $point->short_text = $request->short_text;
      $point->save();

      Session::flash('success', 'New point added successfully!');
      return "success";
    }

    public function pointedit($id) {
      $data['point'] = Point::findOrFail($id);
      return view('admin.home.approach.edit', $data);
    }

    public function update(Request $request) {
      $request->validate([
        'approach_section_title' => 'required|max:25',
        'approach_section_subtitle' => 'required|max:80',
        'approach_section_button_text' => 'required|max:15',
        'approach_section_button_url' => 'required|max:255',
      ]);

      $bs = BS::first();
      $bs->approach_title = $request->approach_section_title;
      $bs->approach_subtitle = $request->approach_section_subtitle;
      $bs->approach_button_text = $request->approach_section_button_text;
      $bs->approach_button_url = $request->approach_section_button_url;
      $bs->save();

      Session::flash('success', 'Text updated successfully!');
      return back();
    }

    public function pointupdate(Request $request) {
      $rules = [
        'title' => 'required|max:20',
        'short_text' => 'required|max:160',
      ];

      $request->validate($rules);

      $point = Point::findOrFail($request->pointid);
      $point->icon = $request->icon;
      $point->title = $request->title;
      $point->short_text = $request->short_text;
      $point->save();

      Session::flash('success', 'Point updated successfully!');
      return back();
    }

    public function pointdelete(Request $request) {

      $point = Point::findOrFail($request->pointid);
      $point->delete();

      Session::flash('success', 'Point deleted successfully!');
      return back();
    }
}
