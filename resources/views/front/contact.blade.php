@extends('front.layout')

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area contact">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{$bs->contact_title}}</span>
                 <h1>{{$bs->contact_subtitle}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li>{{__('Contact Us')}}</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="breadcrumb-area-overlay"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--    contact form and map start   -->
  <div class="contact-form-section">
     <div class="container">
        <div class="row">
           <div class="col-lg-6">
              <span class="section-title">{{$bs->contact_form_title}}</span>
              <h2 class="section-summary">{{$bs->contact_form_subtitle}}</h2>
              <form action="{{route('front.sendmail')}}" class="contact-form" method="POST">
                 @csrf
                 <div class="row">
                    <div class="col-md-6">
                       <div class="form-element">
                          <input name="name" type="text" placeholder="{{__('Name')}}" required>
                       </div>
                       @if ($errors->has('name'))
                         <p class="text-danger mb-0">{{$errors->first('name')}}</p>
                       @endif
                    </div>
                    <div class="col-md-6">
                       <div class="form-element">
                          <input name="email" type="email" placeholder="{{__('Email')}}" required>
                       </div>
                       @if ($errors->has('email'))
                         <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                       @endif
                    </div>
                    <div class="col-md-12">
                       <div class="form-element">
                          <input name="subject" type="text" placeholder="{{__('Subject')}}" required>
                       </div>
                       @if ($errors->has('subject'))
                         <p class="text-danger mb-0">{{$errors->first('subject')}}</p>
                       @endif
                    </div>
                    <div class="col-md-12">
                       <div class="form-element">
                          <textarea name="message" id="comment" cols="30" rows="10" placeholder="{{__('Comment')}}" required></textarea>
                       </div>
                       @if ($errors->has('message'))
                         <p class="text-danger mb-0">{{$errors->first('message')}}</p>
                       @endif
                    </div>
                    @if ($bs->is_recaptcha == 1)
                      <div class="col-md-12">
                        <div class="form-element reduced-mb">
                          {!! NoCaptcha::renderJs() !!}
                          {!! NoCaptcha::display() !!}
                        </div>
                        @if ($errors->has('g-recaptcha-response'))
                          <p class="text-danger mb-4">{{$errors->first('g-recaptcha-response')}}</p>
                        @endif
                      </div>
                    @endif

                    <div class="col-md-12">
                       <div class="form-element no-margin">
                          <input type="submit" value="{{__('Submit')}}">
                       </div>
                    </div>
                 </div>
              </form>
           </div>
           <div class="col-lg-6">
              <div class="map-wrapper">
                 <div id="map"></div>
                 <div class="contact-infos">
                    <div class="single-contact-info">
                       <div class="icon-wrapper">
                          <i class="fa fa-home"></i>
                       </div>
                       <p>{{$bs->contact_address}}</p>
                    </div>
                    <div class="single-contact-info">
                       <div class="icon-wrapper">
                          <i class="fa fa-phone"></i>
                       </div>
                       <p>{{$bs->contact_number}}</p>
                    </div>
                    <div class="single-contact-info">
                       <div class="icon-wrapper">
                          <i class="fa fa-envelope"></i>
                       </div>
                       <p>{{$bs->contact_mail}}</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--    contact form and map end   -->
@endsection
