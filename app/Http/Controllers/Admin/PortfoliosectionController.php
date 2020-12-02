<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use Validator;
use Session;

class PortfoliosectionController extends Controller
{
    public function index() {
      return view('admin.home.portfolio-section');
    }

    public function update(Request $request) {
      $rules = [
        'portfolio_section_text' => 'required|max:80',
        'portfolio_section_title' => 'required|max:25'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $bs = BS::first();
      $bs->portfolio_section_text = $request->portfolio_section_text;
      $bs->portfolio_section_title = $request->portfolio_section_title;
      $bs->save();

      Session::flash('success', 'Texts updated successfully!');
      return "success";
    }
}
