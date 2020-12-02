<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Budget;
use Validator;
use Session;

class BudgetController extends Controller
{
    public function index() {
      $data['budgets'] = Budget::all();
      return view('admin.quote.budget', $data);
    }

    public function store(Request $request) {
      $rules = [
        'limits' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $budget = new Budget;
      $budget->limits = $request->limits;
      $budget->save();

      Session::flash('success', 'Budget added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'limits' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $budget = Budget::findOrFail($request->budget_id);
      $budget->limits = $request->limits;
      $budget->save();

      Session::flash('success', 'Budget updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $budget = Budget::findOrFail($request->budget_id);
      $budget->delete();

      Session::flash('success', 'Budget deleted successfully!');
      return back();
    }
}
