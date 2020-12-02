<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faq;
use Validator;
use Session;

class FaqController extends Controller
{
    public function index() {
      $data['faqs'] = Faq::orderBy('id', 'DESC')->get();
      return view('admin.home.faq.index', $data);
    }

    public function edit($id) {
      $data['faq'] = Faq::findOrFail($id);
      return view('admin.home.faq.edit', $data);
    }

    public function store(Request $request) {
      $rules = [
        'question' => 'required|max:255',
        'answer' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $faq = new Faq;
      $faq->question = $request->question;
      $faq->answer = $request->answer;
      $faq->save();

      Session::flash('success', 'Faq added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'question' => 'required|max:255',
        'answer' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $faq = Faq::findOrFail($request->faq_id);
      $faq->question = $request->question;
      $faq->answer = $request->answer;
      $faq->save();

      Session::flash('success', 'Faq updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $faq = Faq::findOrFail($request->faq_id);
      $faq->delete();

      Session::flash('success', 'Faq deleted successfully!');
      return back();
    }
}
