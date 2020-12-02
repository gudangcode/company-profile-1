<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\BasicSetting as BS;
use Validator;
use Session;

class MemberController extends Controller
{
    public function index() {
      $data['members'] = Member::all();
      return view('admin.home.member.index', $data);
    }

    public function create() {
      return view('admin.home.member.create');
    }

    public function edit($id) {
      $data['member'] = Member::findOrFail($id);
      return view('admin.home.member.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'member']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('member_image', $filename);
      $request->file('file')->move('assets/front/img/members/', $filename);
      return response()->json(['status' => "session_put", "image" => "member_image", 'filename' => $filename]);
    }

    public function teamUpload(Request $request) {
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'team_bg']);
      }

      @unlink("assets/front/img/team_bg.jpg");
      $request->file('file')->move('assets/front/img/', 'team_bg.jpg');
      return response()->json(['status' => "success", 'image' => 'Team section background image']);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'member']);
      }

      $member = Member::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/members/', $filename);
        @unlink('assets/front/img/members/'. $member->image);
        $member->image = $filename;
        $member->save();
      }

      return response()->json(['status' => "success", "image" => "Member image", 'member' => $member]);
    }

    public function store(Request $request) {
      $rules = [
        'member_image' => 'required',
        'name' => 'required|max:50',
        'rank' => 'required|max:50',
        'facebook' => 'nullable|max:50',
        'twitter' => 'nullable|max:50',
        'linkedin' => 'nullable|max:50',
        'instagram' => 'nullable|max:50',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $member = new Member;
      $member->image = $request->member_image;
      $member->name = $request->name;
      $member->rank = $request->rank;
      $member->facebook = $request->facebook;
      $member->twitter = $request->twitter;
      $member->linkedin = $request->linkedin;
      $member->instagram = $request->instagram;
      $member->save();

      Session::flash('success', 'Member added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $rules = [
        'name' => 'required|max:50',
        'rank' => 'required|max:50',
        'facebook' => 'nullable|max:50',
        'twitter' => 'nullable|max:50',
        'linkedin' => 'nullable|max:50',
        'instagram' => 'nullable|max:50',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $member = Member::findOrFail($request->member_id);
      $member->name = $request->name;
      $member->rank = $request->rank;
      $member->facebook = $request->facebook;
      $member->twitter = $request->twitter;
      $member->linkedin = $request->linkedin;
      $member->instagram = $request->instagram;
      $member->save();

      Session::flash('success', 'Member updated successfully!');
      return "success";
    }

    public function textupdate(Request $request) {
      $request->validate([
        'team_section_title' => 'required|max:25',
        'team_section_subtitle' => 'required|max:80',
      ]);

      $bs = BS::first();
      $bs->team_section_title = $request->team_section_title;
      $bs->team_section_subtitle = $request->team_section_subtitle;
      $bs->save();

      Session::flash('success', 'Text updated successfully!');
      return back();
    }

    public function delete(Request $request) {

      $member = Member::findOrFail($request->member_id);
      @unlink('assets/front/img/members/'. $member->image);
      $member->delete();

      Session::flash('success', 'Member deleted successfully!');
      return back();
    }
}
