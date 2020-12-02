<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Service;
use App\Scategory;
use Validator;
use Session;
use XSSCleaner;

class ServiceController extends Controller
{
    public function index() {
      $data['services'] = Service::orderBy('id', 'DESC')->paginate(10);
      $data['scats'] = Scategory::where('status', 1)->get();
      return view('admin.service.service.index', $data);
    }

    public function edit($id) {
      $data['service'] = Service::findOrFail($id);
      $data['scats'] = Scategory::where('status', 1)->get();
      return view('admin.service.service.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'service']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('service_image', $filename);
      $request->file('file')->move('assets/front/img/services/', $filename);
      return response()->json(['status' => "session_put", "image" => "service_image", 'filename' => $filename]);
    }

    public function store(Request $request) {
      $slug = Str::slug($request->title, '-');
      $services = Service::select('slug')->get();

      $rules = [
        'service_image' => 'required',
        'title' => [
          'required',
          'max:255',
          function($attribute, $value, $fail) use ($slug, $services) {
            foreach($services as $service) {
              if ($service->slug == $slug) {
                return $fail('Title already taken!');
              }
            }
          }
        ],
        'category' => 'required',
        'content' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $service = new Service;
      $service->title = $request->title;
      $service->main_image = $request->service_image;
      $service->slug = $slug;
      $service->scategory_id = $request->category;
      $service->content = XSSCleaner::clean($request->content);
      $service->save();

      Session::flash('success', 'Service added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $slug = Str::slug($request->title, '-');
      $services = Service::select('slug')->get();
      $service = Service::findOrFail($request->service_id);

      $rules = [
        'title' => [
          'required',
          'max:255',
          function($attribute, $value, $fail) use ($slug, $services, $service) {
            foreach($services as $serv) {
              if ($service->slug != $slug) {
                if ($serv->slug == $slug) {
                  return $fail('Title already taken!');
                }
              }
            }
          }
        ],
        'category' => 'required',
        'content' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $service->title = $request->title;
      $service->slug = $slug;
      $service->scategory_id = $request->category;
      $service->content = XSSCleaner::clean($request->content);
      $service->save();

      Session::flash('success', 'Service updated successfully!');
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'service_image']);
      }

      $service = Service::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/services/', $filename);
        @unlink('assets/front/img/services/'. $service->main_image);
        $service->main_image = $filename;
        $service->save();
      }

      return response()->json(['status' => "success", "image" => "Service image", 'service' => $service]);
    }

    public function delete(Request $request) {
      $service = Service::findOrFail($request->service_id);
      @unlink('assets/front/img/services/'. $service->main_image);
      $service->delete();

      Session::flash('success', 'Service deleted successfully!');
      return back();
    }
}
