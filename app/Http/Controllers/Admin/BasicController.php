<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting;
use Session;
use Validator;
use Config;

class BasicController extends Controller
{
    public function favicon() {
      return view('admin.basic.favicon');
    }

    public function updatefav(Request $request) {
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'favicon']);
      }

      @unlink("assets/front/images/favicon.jpg");
      $request->file('file')->move('assets/front/img/', 'favicon.jpg');
      return response()->json(['status' => "success", 'image' => 'favicon']);
    }

    public function logo() {
      return view('admin.basic.logo');
    }

    public function updatelogo(Request $request) {
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'logo']);
      }

      @unlink("assets/front/img/logo.png");
      $request->file('file')->move('assets/front/img/', 'logo.png');
      return response()->json(['status' => "success", 'image' => 'logo']);
    }


    public function homeversion() {
      return view('admin.basic.homeversion');
    }

    public function updatehomeversion(Request $request) {
      $bs = BasicSetting::first();
      $bs->home_version = $request->home_version;
      $bs->save();

      Session::flash('success', "$request->home_version version activated successfully!");
      return back();
    }


    public function basicinfo() {
      return view('admin.basic.basicinfo');
    }

    public function updatebasicinfo(Request $request) {
      $request->validate([
        'contact_mail' => 'required',
        'website_title' => 'required',
        'base_color' => 'required',
      ]);

      $bs = BasicSetting::first();
      $bs->contact_mail = $request->contact_mail;
      $bs->website_title = $request->website_title;
      $bs->base_color = $request->base_color;
      $bs->save();

      Session::flash('success', 'Basic informations updated successfully!');
      return back();
    }

    public function seo() {
      return view('admin.basic.seo');
    }

    public function updateseo(Request $request) {
      $bs = BasicSetting::first();
      $bs->meta_keywords = $request->meta_keywords;
      $bs->meta_description = $request->meta_description;
      $bs->save();

      Session::flash('success', 'SEO informations updated successfully!');
      return back();
    }

    public function support() {
      return view('admin.basic.support');
    }

    public function updatesupport(Request $request) {
      $request->validate([
        'support_email' => 'required|email|max:100',
        'support_phone' => 'required|max:30',
      ]);

      $bs = BasicSetting::first();
      $bs->support_email = $request->support_email;
      $bs->support_phone = $request->support_phone;
      $bs->save();

      Session::flash('success', 'Support Informations updated successfully!');
      return back();
    }

    public function breadcrumb() {
      return view('admin.basic.breadcrumb');
    }

    public function updatebreadcrumb(Request $request) {
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
        return response()->json(['errors' => $validator->errors(), 'id' => 'breadcrumb']);
      }

      @unlink("assets/front/img/breadcrumb.jpg");
      $request->file('file')->move('assets/front/img/', 'breadcrumb.jpg');
      return response()->json(['status' => "success", 'image' => 'breadcrumb']);
    }

    public function heading() {
      return view('admin.basic.headings');
    }

    public function updateheading(Request $request) {
      $request->validate([
        'service_title' => 'required|max:30',
        'service_subtitle' => 'required|max:40',
        'service_details_title' => 'required|max:30',
        'portfolio_title' => 'required|max:30',
        'portfolio_subtitle' => 'required|max:40',
        'portfolio_details_title' => 'required|max:40',
        'blog_details_title' => 'required|max:30',
        'contact_title' => 'required|max:30',
        'contact_subtitle' => 'required|max:40',
        'gallery_title' => 'required|max:30',
        'gallery_subtitle' => 'required|max:40',
        'team_title' => 'required|max:30',
        'team_subtitle' => 'required|max:40',
        'faq_title' => 'required|max:30',
        'faq_subtitle' => 'required|max:40',
        'blog_title' => 'required|max:30',
        'blog_subtitle' => 'required|max:40',
        'quote_title' => 'required|max:30',
        'quote_subtitle' => 'required|max:40',
        'error_title' => 'required|max:30',
        'error_subtitle' => 'required|max:40',
      ]);

      $bs = BasicSetting::first();
      $bs->service_title = $request->service_title;
      $bs->service_subtitle = $request->service_subtitle;
      $bs->service_details_title = $request->service_details_title;
      $bs->portfolio_title = $request->portfolio_title;
      $bs->portfolio_subtitle = $request->portfolio_subtitle;
      $bs->portfolio_details_title = $request->portfolio_details_title;
      $bs->blog_details_title = $request->blog_details_title;
      $bs->contact_title = $request->contact_title;
      $bs->contact_subtitle = $request->contact_subtitle;
      $bs->gallery_title = $request->gallery_title;
      $bs->gallery_subtitle = $request->gallery_subtitle;
      $bs->team_title = $request->team_title;
      $bs->team_subtitle = $request->team_subtitle;
      $bs->faq_title = $request->faq_title;
      $bs->faq_subtitle = $request->faq_subtitle;
      $bs->blog_title = $request->blog_title;
      $bs->blog_subtitle = $request->blog_subtitle;
      $bs->quote_title = $request->quote_title;
      $bs->quote_subtitle = $request->quote_subtitle;
      $bs->error_title = $request->error_title;
      $bs->error_subtitle = $request->error_subtitle;
      $bs->save();

      Session::flash('success', 'Page title & subtitles updated successfully!');
      return back();
    }

    public function script() {
      return view('admin.basic.scripts');
    }

    public function updatescript(Request $request) {

      $bs = BasicSetting::first();
      $bs->tawk_to_api_key = $request->tawk_to_api_key;
      $bs->is_tawkto = $request->is_tawkto;
      $bs->is_disqus = $request->is_disqus;
      $bs->disqus_username = $request->disqus_username;
      if ($request->is_disqus == 1) {
        $arr = ['DISQUS_ENABLED'=>'true', 'DISQUS_USERNAME'=>$request->disqus_username];
        setEnvironmentValue($arr);
      } else {
        $arr = ['DISQUS_ENABLED'=>'false', 'DISQUS_USERNAME'=>$request->disqus_username];
        setEnvironmentValue($arr);
      }
      $bs->google_analytics_id = $request->google_analytics_id;
      $bs->is_analytics = $request->is_analytics;
      $bs->is_recaptcha = $request->is_recaptcha;
      $bs->google_recaptcha_site_key = $request->google_recaptcha_site_key;
      $bs->google_recaptcha_secret_key = $request->google_recaptcha_secret_key;
      $bs->save();

      Session::flash('success', 'Scripts updated successfully!');
      return back();
    }
}
