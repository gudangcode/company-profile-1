@extends('front.layout')

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area case-details">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{$bs->portfolio_details_title}}</span>
                 <h1>{{$portfolio->title}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li>{{__('Portfolio Details')}}</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="breadcrumb-area-overlay"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--    case details section start   -->
  <div class="case-details-section">
     <div class="container">
        <div class="row">
           <div class="col-lg-7 col-xl-7">
             <div class="project-ss-carousel owl-carousel owl-theme common-carousel">
                 @foreach ($portfolio->portfolio_images as $key => $pi)
                   <a href="#" class="single-ss" data-id="{{$pi->id}}">
                      <img src="{{asset('assets/front/img/portfolios/sliders/'.$pi->image)}}" alt="">
                   </a>
                 @endforeach
              </div>
              @foreach ($portfolio->portfolio_images as $key => $pi)
                <a id="singleMagnificSs{{$pi->id}}" class="single-magnific-ss d-none" href="{{asset('assets/front/img/portfolios/sliders/'.$pi->image)}}"></a>
              @endforeach
              <div class="case-details">
                 {!! $portfolio->content !!}
              </div>
           </div>
           <!--    appoint section start   -->
           <div class="col-lg-5 offset-xl-1 col-xl-4">
             <div class="right-side">
                <div class="row">
                   <div class="col-xl-12 col-lg-12 col-md-12">
                      <div class="project-infos">
                          <h3>{{$portfolio->title}}</h3>
                          <div class="row mb-4">
                              <div class="col-5 pr-0"><strong>{{__('Client Name')}}</strong></div>
                              <div class="col-7"><span>:</span> {{$portfolio->client_name}}</div>
                          </div>
                          <div class="row mb-4">
                              <div class="col-5 pr-0"><strong>{{__('Service')}}</strong></div>
                              <div class="col-7"><span>:</span> {{$portfolio->service->title}}</div>
                          </div>
                          <div class="row mb-4">
                              <div class="col-5 pr-0"><strong>{{__('Start Date')}}</strong></div>
                              <div class="col-7"><span>:</span> {{date('jS M, Y', strtotime($portfolio->start_date))}}</div>
                          </div>
                          <div class="row mb-4">
                              <div class="col-5 pr-0"><strong>{{__('End Date')}}</strong></div>
                              <div class="col-7"><span>:</span> {{date('jS M, Y', strtotime($portfolio->submission_date))}}</div>
                          </div>
                          <div class="row mb-0">
                              <div class="col-5 pr-0"><strong>{{__('Status')}}</strong></div>
                              <div class="col-7"><span>:</span> {{$portfolio->status}}</div>
                          </div>
                      </div>
                      <div class="subscribe-section">
                         <span>{{__('SUBSCRIBE')}}</span>
                         <h3>{{__('SUBSCRIBE FOR NEWSLETTER')}}</h3>
                         <form id="subscribeForm" class="subscribe-form" action="{{route('front.subscribe')}}" method="POST">
                            @csrf
                            <div class="form-element"><input name="email" type="email" placeholder="{{__('Email')}}"></div>
                            <p id="erremail" class="text-danger mb-3"></p>
                            <div class="form-element"><input type="submit" value="{{__('Subscribe')}}"></div>
                         </form>
                      </div>
                   </div>
                </div>
             </div>
           </div>
           <!--    appoint section end   -->
        </div>
     </div>
  </div>
  <!--    case details section end   -->

@endsection
