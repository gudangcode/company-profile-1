<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partner;
use Validator;
use Session;

class PartnerController extends Controller
{
    public function index() {
      $data['partners'] = Partner::all();
      return view('admin.home.partner.index', $data);
    }

    public function edit($id) {
      $data['partner'] = Partner::findOrFail($id);
      return view('admin.home.partner.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'partner']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('partner_image', $filename);
      $request->file('file')->move('assets/front/img/partners/', $filename);
      return response()->json(['status' => "session_put", "image" => "partner_image", 'filename' => $filename]);
    }

    public function store(Request $request) {
      $rules = [
        'partner_image' => 'required',
        'url' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $partner = new Partner;
      $partner->url = $request->url;
      $partner->image = $request->partner_image;
      $partner->save();

      Session::flash('success', 'Partner added successfully!');
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'partner']);
      }

      $partner = Partner::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/partners/', $filename);
        @unlink('assets/front/img/partners/'. $partner->image);
        $partner->image = $filename;
        $partner->save();
      }

      return response()->json(['status' => "success", "image" => "Partner", 'partner' => $partner]);
    }

    public function update(Request $request) {
      $rules = [
        'url' => 'required|max:255',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $partner = Partner::findOrFail($request->partner_id);
      $partner->url = $request->url;
      $partner->save();

      Session::flash('success', 'Partner updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $partner = Partner::findOrFail($request->partner_id);
      @unlink('assets/front/img/partners/'. $partner->image);
      $partner->delete();

      Session::flash('success', 'Partner deleted successfully!');
      return back();
    }
}
