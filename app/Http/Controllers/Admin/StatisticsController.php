<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use App\Statistic;
use Session;
use Validator;

class StatisticsController extends Controller
{
    public function index() {
      $data['statistics'] = Statistic::all();
      return view('admin.home.statistics.index', $data);
    }

    public function store(Request $request) {
      $count = Statistic::count();
      if ($count == 4) {
        Session::flash('warning', 'You cannot add more than 4 statistics!');
        return "success";
      }

      $rules = [
        'title' => 'required|max:20',
        'quantity' => 'required|integer',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $statistic = new Statistic;
      $statistic->icon = $request->icon;
      $statistic->title = $request->title;
      $statistic->quantity = $request->quantity;
      $statistic->save();

      Session::flash('success', 'New statistic added successfully!');
      return "success";
    }

    public function edit($id) {
      $data['statistic'] = Statistic::findOrFail($id);
      return view('admin.home.statistics.edit', $data);
    }

    public function update(Request $request) {
      $rules = [
        'title' => 'required|max:20',
        'quantity' => 'required|integer',
      ];

      $request->validate($rules);

      $statistic = Statistic::findOrFail($request->statisticid);
      $statistic->icon = $request->icon;
      $statistic->title = $request->title;
      $statistic->quantity = $request->quantity;
      $statistic->save();

      Session::flash('success', 'Statistic updated successfully!');
      return back();
    }

    public function delete(Request $request) {

      $statistic = Statistic::findOrFail($request->statisticid);
      $statistic->delete();

      Session::flash('success', 'Statistic deleted successfully!');
      return back();
    }
}
