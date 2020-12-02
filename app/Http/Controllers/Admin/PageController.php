<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\BasicSetting as BS;
use Session;
use Validator;
use XSSCleaner;

class PageController extends Controller
{
    public function index() {
      $data['pages'] = Page::latest()->get();
      return view('admin.page.index', $data);
    }

    public function create() {
      return view('admin.page.create');
    }

    public function store(Request $request) {
      $slug = str_slug($request->name, '-');

      $rules = [
        'name' => 'required|max:25',
        'title' => 'required|max:30',
        'subtitle' => 'required|max:38',
        'body' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $page = new Page;
      $page->name = $request->name;
      $page->title = $request->title;
      $page->subtitle = $request->subtitle;
      $page->slug = $slug;
      $page->body = XSSCleaner::clean($request->body);
      $page->save();

      Session::flash('success', 'Page created successfully!');
      return "success";
    }

    public function edit($pageID) {
      $data['page'] = Page::findOrFail($pageID);
      return view('admin.page.edit', $data);
    }

    public function update(Request $request) {
      $slug = str_slug($request->name, '-');

      $rules = [
        'name' => 'required|max:25',
        'title' => 'required|max:30',
        'subtitle' => 'required|max:38',
        'body' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $pageID = $request->pageid;

      $page = Page::findOrFail($pageID);
      $page->name = $request->name;
      $page->title = $request->title;
      $page->subtitle = $request->subtitle;
      $page->slug = $slug;
      $page->body = XSSCleaner::clean($request->body);
      $page->save();

      Session::flash('success', 'Page updated successfully!');
      return "success";
    }

    public function delete(Request $request) {
      $pageID = $request->pageid;
      $page = Page::findOrFail($pageID);
      $page->delete();
      Session::flash('success', 'Page deleted successfully!');
      return redirect()->back();
    }

    public function parentlink() {
      return view('admin.page.parent-link');
    }

    public function updateParentLink(Request $request) {

      $request->validate([
        'parent_link_name' => 'required',
      ]);

      $bs = BS::first();
      $bs->parent_link_name = $request->parent_link_name;
      $bs->save();

      Session::flash('success', 'Parent link name updated successfully!');
      return back();
    }
}
