@extends('front.layout')

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area cases">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{$bs->portfolio_title}}</span>
                 <h1>{{$bs->portfolio_subtitle}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li>{{__('Portfolios')}}</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="breadcrumb-area-overlay"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--    case lists start   -->
  <div class="case-lists section-padding">
     <div class="container">
        <div class="row">
           <div class="col-xl-12">
              <div class="case-types">
                   <ul class="text-center">
                     <li class="@if(empty(request()->input('category'))) active @endif"><a href="{{route('front.portfolios')}}">{{__('All')}}</a></li>
                     @foreach ($scats as $key => $scat)
                       <li class="@if(request()->input('category') == $scat->id) active @endif"><a href="{{route('front.portfolios', ['category'=>$scat->id])}}">{{$scat->name}}</a></li>
                     @endforeach
                   </ul>
               </div>
           </div>
        </div>
        <div class="cases">
           <div class="row">
             @if (count($portfolios) == 0)
               <div class="col-lg-12 py-5 bg-light text-center mb-4">
                 <h3>{{__('NO PORTFOLIO FOUND')}}</h3>
               </div>
             @else
               @foreach ($portfolios as $key => $portfolio)
                 <div class="col-lg-4">
                   <div class="single-case" style="background-image: url('{{asset('assets/front/img/portfolios/featured/'.$portfolio->featured_image)}}')">
                      <div class="outer-container">
                         <div class="inner-container">
                            <h4>{{strlen($portfolio->title) > 36 ? substr($portfolio->title, 0, 36) . '...' : $portfolio->title}}</h4>
                            @if (!empty($portfolio->service))
                            <p>{{$portfolio->service->title}}</p>
                            @endif
                            <a href="{{route('front.portfoliodetails', $portfolio->slug)}}" class="readmore-btn"><span>{{__('Read More')}}</span></a>
                         </div>
                      </div>
                   </div>
                 </div>
               @endforeach
             @endif
           </div>
        </div>
        @if ($portfolios->total() > 6)
          <div class="row">
             <div class="col-md-12">
                <nav class="pagination-nav {{$portfolios->total() > 6 ? 'mb-4' : ''}}">
                  {{$portfolios->appends(['category' => request()->input('category')])->links()}}
                </nav>
             </div>
          </div>
        @endif
     </div>
  </div>
  <!--    case lists end   -->
@endsection
