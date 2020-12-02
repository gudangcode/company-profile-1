<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quote;
use Validator;
use Session;

class QuoteController extends Controller
{
    public function index() {
      $data['quotes'] = Quote::orderBy('id', 'DESC')->paginate(10);
      return view('admin.quote.quote', $data);
    }
}
