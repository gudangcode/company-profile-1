<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Language;
use Auth;
use Validator;
use Session;


class LanguageController extends Controller
{
    public function index($lang = false)
    {
          $data['languages'] = Language::all();
          return view('admin.language.index', $data);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'code' => [
                'required',
                'max:255'
            ],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          $errmsgs = $validator->getMessageBag()->add('error', 'true');
          return response()->json($validator->errors());
        }

        $data = file_get_contents(resource_path('lang/') . 'default.json');
        $json_file = trim(strtolower($request->code)) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, $data);

        $in['name'] = $request->name;
        $in['code'] = $request->code;
        if (Language::where('is_default', 1)->count() > 0) {
          $in['is_default'] = 0;
        } else {
          $in['is_default'] = 1;
        }
        Language::create($in);

        Session::flash('success', 'Language added successfully!');
        return "success";
    }

    public function edit($id)
    {
        $data['language'] = Language::findOrFail($id);

        return view('admin.language.edit', $data);
    }


    public function update(Request $request) {

      $rules = [
          'name' => 'required|max:255',
          'code' => [
              'required',
              'max:255'
          ]
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $language = Language::findOrFail($request->language_id);

      $language->name = $request->name;
      $language->code = $request->code;
      $language->save();

      Session::flash('success', 'Language updated successfully!');
      return "success";
    }

    public function editKeyword($id)
    {
      $la = Language::findOrFail($id);
      $page_title = "Update " . $la->name . " Keywords";
      $json = file_get_contents(resource_path('lang/') . $la->code . '.json');
      $list_lang = Language::all();

      if (empty($json)) {
          return back()->with('alert', 'File Not Found.');
      }

        return view('admin.language.edit-keyword', compact('page_title', 'json', 'la', 'list_lang'));
    }



    public function updateKeyword(Request $request, $id)
    {
        $lang = Language::findOrFail($id);
        $content = json_encode($request->keys);
        if ($content === 'null') {
            return back()->with('alert', 'At Least One Field Should Be Fill-up');
        }
        file_put_contents(resource_path('lang/') . $lang->code . '.json', $content);
        return back()->with('success', 'Updated Successfully');
    }


    public function delete($id)
    {
        $la = Language::findOrFail($id);
        if ($la->is_default == 1) {
          return back()->with('warning', 'Default language cannot be deleted!');
        }
        @unlink('assets/front/img/languages/' . $la->icon);
        @unlink(resource_path('lang/') . $la->code . '.json');
        if (session()->get('lang') == $la->code) {
          session()->forget('lang');
        }
        $la->delete();
        return back()->with('success', 'Delete Successfully');
    }


    public function default(Request $request, $id) {
      Language::where('is_default', 1)->update(['is_default' => 0]);
      $lang = Language::find($id);
      $lang->is_default = 1;
      $lang->save();
      return back()->with('success', $lang->name . ' laguage is set as defualt.');
    }

}
