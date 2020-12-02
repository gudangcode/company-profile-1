<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Bcategory;
use App\Blog;
use Validator;
use Session;
use XSSCleaner;

class BlogController extends Controller
{
    public function index() {
      $data['blogs'] = Blog::orderBy('id', 'DESC')->paginate(10);
      $data['bcats'] = Bcategory::where('status', 1)->get();
      return view('admin.blog.blog.index', $data);
    }

    public function edit($id) {
      $data['blog'] = Blog::findOrFail($id);
      $data['bcats'] = Bcategory::where('status', 1)->get();
      return view('admin.blog.blog.edit', $data);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'blog']);
      }

      $filename = time() . '.' . $img->getClientOriginalExtension();
      $request->session()->put('blog_image', $filename);
      $request->file('file')->move('assets/front/img/blogs/', $filename);
      return response()->json(['status' => "session_put", "image" => "blog", 'filename' => $filename]);
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'blog']);
      }

      $blog = Blog::findOrFail($id);
      if ($request->hasFile('file')) {
        $filename = time() . '.' . $img->getClientOriginalExtension();
        $request->file('file')->move('assets/front/img/blogs/', $filename);
        @unlink('assets/front/img/blogs/'. $blog->main_image);
        $blog->main_image = $filename;
        $blog->save();
      }

      return response()->json(['status' => "success", "image" => "Blog image", 'blog' => $blog]);
    }

    public function store(Request $request) {
      $slug = Str::slug($request->title, '-');
      $blogs = Blog::select('slug')->get();

      $rules = [
        'blog' => 'required',
        'title' => [
          'required',
          'max:255',
          function($attribute, $value, $fail) use ($slug, $blogs) {
            foreach($blogs as $blog) {
              if ($blog->slug == $slug) {
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

      $blog = new Blog;
      $blog->main_image = $request->blog;
      $blog->title = $request->title;
      $blog->slug = $slug;
      $blog->bcategory_id = $request->category;
      $blog->content = XSSCleaner::clean($request->content);
      $blog->meta_keywords = $request->meta_keywords;
      $blog->meta_description = $request->meta_description;
      $blog->save();

      Session::flash('success', 'Blog added successfully!');
      return "success";
    }

    public function update(Request $request) {
      $slug = Str::slug($request->title, '-');
      $blogs = Blog::select('slug')->get();
      $blog = Blog::findOrFail($request->blog_id);

      $rules = [
        'title' => [
          'required',
          'max:255',
          function($attribute, $value, $fail) use ($slug, $blogs, $blog) {
            foreach($blogs as $blg) {
              if ($blog->slug != $slug) {
                if ($blg->slug == $slug) {
                  return $fail('Title already taken!');
                }
              }
            }
          }
        ],
        'category' => 'required',
        'content' => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errmsgs = $validator->getMessageBag()->add('error', 'true');
        return response()->json($validator->errors());
      }

      $blog = Blog::findOrFail($request->blog_id);
      $blog->title = $request->title;
      $blog->slug = $slug;
      $blog->bcategory_id = $request->category;
      $blog->content = XSSCleaner::clean($request->content);
      $blog->meta_keywords = $request->meta_keywords;
      $blog->meta_description = $request->meta_description;
      $blog->save();

      Session::flash('success', 'Blog updated successfully!');
      return "success";
    }

    public function delete(Request $request) {

      $blog = Blog::findOrFail($request->blog_id);
      @unlink('assets/front/img/blogs/'. $blog->main_image);
      $blog->delete();

      Session::flash('success', 'Blog deleted successfully!');
      return back();
    }
}
