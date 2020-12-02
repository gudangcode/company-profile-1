<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting as BS;
use App\Slider;
use App\Scategory;
use App\Portfolio;
use App\Feature;
use App\Point;
use App\Statistic;
use App\Testimonial;
use App\Gallery;
use App\Faq;
use App\Page;
use App\Member;
use App\Blog;
use App\Partner;
use App\Service;
use App\Archive;
use App\Bcategory;
use App\Subscriber;
use App\Budget;
use App\Quote;
use App\Language;
use Session;
use Validator;
use Config;

class FrontendController extends Controller
{
    public function __construct() {
      $bs = BS::first();

      Config::set('captcha.sitekey', $bs->google_recaptcha_site_key);
      Config::set('captcha.secret', $bs->google_recaptcha_secret_key);
    }

    public function index() {

      $data['sliders'] = Slider::all();
      $data['scats'] = Scategory::where('status', 1)->get();
      $data['portfolios'] = Portfolio::orderBy('id', 'DESC')->limit(10)->get();
      $data['features'] = Feature::all();
      $data['points'] = Point::all();
      $data['statistics'] = Statistic::all();
      $data['testimonials'] = Testimonial::all();
      $data['faqs'] = Faq::all();
      $data['members'] = Member::all();
      $data['blogs'] = Blog::orderBy('id', 'DESC')->limit(6)->get();
      $data['partners'] = Partner::all();
      return view('front.index', $data);
    }

    public function services(Request $request) {
      $category = $request->category;
      $term = $request->term;

      $data['scats'] = Scategory::where('status', 1)->get();
      if (!empty($category)) {
        $data['category'] = Scategory::findOrFail($category);
      }

      $data['services'] = Service::when($category, function ($query, $category) {
                                    return $query->where('scategory_id', $category);
                                })->when($term, function ($query, $term) {
                                    return $query->where('title', 'like', '%'.$term.'%');
                                })->orderBy('id', 'DESC')->paginate(6);

      return view('front.services', $data);
    }

    public function portfolios(Request $request) {
      $category = $request->category;
      $term = $request->term;

      $data['scats'] = Scategory::where('status', 1)->get();
      if (!empty($category)) {
        $data['category'] = Scategory::findOrFail($category);
      }

      $data['portfolios'] = Portfolio::when($category, function ($query, $category) {
                                    $serviceIdArr = [];
                                    $serviceids = Service::select('id')->where('scategory_id', $category)->get();
                                    foreach ($serviceids as $key => $serviceid) {
                                      $serviceIdArr[] = $serviceid->id;
                                    }
                                    return $query->whereIn('service_id', $serviceIdArr);
                                })->orderBy('id', 'DESC')->paginate(9);

      return view('front.portfolios', $data);
    }

    public function portfoliodetails($slug) {
      $data['portfolio'] = Portfolio::where('slug', $slug)->firstOrFail();
      return view('front.portfolio-details', $data);
    }

    public function servicedetails($slug) {
      $data['service'] = Service::where('slug', $slug)->firstOrFail();
      $data['scats'] = Scategory::all();
      return view('front.service-details', $data);
    }

    public function blogs(Request $request) {
      $category = $request->category;
      $term = $request->term;
      $tag = $request->tag;
      $month = $request->month;
      $year = $request->year;
      $data['archives'] = Archive::orderBy('id', 'DESC')->get();
      $data['bcats'] = Bcategory::where('status', 1)->orderBy('id', 'DESC')->get();
      if (!empty($month) && !empty($year)) {
        $archive = true;
      } else {
        $archive = false;
      }

      $data['blogs'] = Blog::when($category, function ($query, $category) {
                                return $query->where('bcategory_id', $category);
                            })
                            ->when($term, function ($query, $term) {
                                return $query->where('title', 'like', '%'.$term.'%');
                            })
                            ->when($tag, function ($query, $tag) {
                                return $query->where('tags', 'like', '%'.$tag.'%');
                            })
                            ->when($archive, function ($query) use ($month, $year) {
                                return $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
                            })->orderBy('id', 'DESC')->paginate(6);
      return view('front.blogs', $data);
    }

    public function blogdetails($slug) {
      $data['blog'] = Blog::where('slug', $slug)->firstOrFail();
      $data['archives'] = Archive::orderBy('id', 'DESC')->get();
      $data['bcats'] = Bcategory::where('status', 1)->orderBy('id', 'DESC')->get();
      return view('front.blog-details', $data);
    }

    public function contact() {
      if (session()->has('lang')) {
        $data['langg'] = Language::where('code', session('lang'))->first();
        return view('front.contact', $data);
      }
      return view('front.contact');
    }

    public function sendmail(Request $request) {
      $bs = BS::first();

      $messages = [
        'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
      ];

      $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required'
      ];

      if ($bs->is_recaptcha == 1) {
        $rules['g-recaptcha-response'] = 'required|captcha';
      }

      $request->validate($rules, $messages);

      $bs =  BS::firstOrFail();
      $from = $request->email;
      $to = $bs->contact_mail;
      $subject = $request->subject;
      $message = $request->message;

      $headers = "From: $request->name <$from> \r\n";
      $headers .= "Reply-To: $request->name <$from> \r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      @mail($to, $subject, $message, $headers);

      Session::flash('success', 'Email sent successfully!');
      return back();

    }

    public function subscribe(Request $request) {
      $rules = [
        'email' => 'required|email|unique:subscribers'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
      }

      $subsc = new Subscriber;
      $subsc->email = $request->email;
      $subsc->save();

      return "success";
    }

    public function quote() {
      $data['services'] = Service::all();
      $data['budgets'] = Budget::all();
      return view('front.quote', $data);
    }

    public function sendquote(Request $request) {
      $bs = BS::first();
      $nda = $request->file('nda');
      $allowedExts = array('doc', 'docx', 'pdf', 'rtf', 'txt');

      $messages = [
        'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
      ];

      $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|max:30',
        'country' => 'required|max:100',
        'budget' => 'required',
        'skype_whatsapp' => 'required|max:255',
        'services' => 'required',
        'description' => 'required',
        'nda' => [
          'required',
          function($attribute, $value, $fail) use ($nda, $allowedExts) {
              $ext = $nda->getClientOriginalExtension();
              if(!in_array($ext, $allowedExts)) {
                  return $fail("Only doc, docx, pdf, rtf, txt files are allowed");
              }
          }
        ],
        'checknda' => 'required',
      ];

      if ($bs->is_recaptcha == 1) {
        $rules['g-recaptcha-response'] = 'required|captcha';
      }

      $request->validate($rules, $messages);

      $in = $request->all();
      $in['services'] = json_encode($request->services);
      $filename = uniqid() . '.' . $nda->getClientOriginalExtension();
      $nda->move('assets/front/ndas/', $filename);
      $in['nda'] = $filename;
      $quote = Quote::create($in);

      Session::flash('success', 'Quote request sent successfully');
      return back();
    }

    public function team() {
      $data['members'] = Member::all();
      return view('front.team', $data);
    }

    public function gallery() {
      $data['galleries'] = Gallery::orderBy('id', 'DESC')->paginate(12);
      return view('front.gallery', $data);
    }

    public function faq() {
      $data['faqs'] = Faq::orderBy('id', 'DESC')->get();
      return view('front.faq', $data);
    }

    public function dynamicPage($slug) {
      $data['page'] = Page::where('slug', $slug)->firstOrFail();
      return view('front.dynamic', $data);
    }

    public function changeLanguage($lang)
    {
        session()->put('lang', $lang);
        app()->setLocale($lang);
        return redirect()->back();
    }
}
