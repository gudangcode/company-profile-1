@extends('front.layout')

@section('content')
  <!--   hero area start   -->
  @if ($bs->home_version == 'static')
    @includeif('front.partials.static')
  @elseif ($bs->home_version == 'slider')
    @includeif('front.partials.slider')
  @elseif ($bs->home_version == 'video')
    @includeif('front.partials.video')
  @elseif ($bs->home_version == 'particles')
    @includeif('front.partials.particles')
  @elseif ($bs->home_version == 'water')
    @includeif('front.partials.water')
  @elseif ($bs->home_version == 'parallax')
    @includeif('front.partials.parallax')
  @endif
  <!--   hero area end    -->


  <!--    introduction area start   -->
  <div class="intro-section">
     <div class="container">
        <div class="hero-features">
           <div class="row">
              @foreach ($features as $key => $feature)
                <div class="col-md-3 col-sm-6 single-hero-feature">
                   <div class="outer-container">
                      <div class="inner-container">
                         <div class="icon-wrapper">
                            <i class="{{$feature->icon}}"></i>
                         </div>
                         <h3>{{$feature->title}}</h3>
                      </div>
                   </div>
                </div>
              @endforeach
           </div>
        </div>
        <div class="row">
           <div class="col-lg-6 pr-0">
              <div class="intro-txt">
                 <span class="section-title">{{$bs->intro_section_title}}</span>
                 <h2 class="section-summary">{{$bs->intro_section_text}} </h2>
                 <a href="{{$bs->intro_section_button_url}}" class="intro-btn" target="_blank"><span>{{$bs->intro_section_button_text}}</span></a>
              </div>
           </div>
           <div class="col-lg-6 pl-lg-0 px-md-3 px-0">
              <div class="intro-bg">
                <a id="play-video" class="video-play-button" href="{{$bs->intro_section_video_link}}">
                  <span></span>
                </a>
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--    introduction area end   -->


  <!--   service section start   -->
  <div class="service-categories">
    <div class="container">
       <div class="row text-center">
          <div class="col-lg-6 offset-lg-3">
             <span class="section-title">{{$bs->service_section_title}}</span>
             <h2 class="section-summary">{{$bs->service_section_subtitle}}</h2>
          </div>
       </div>
    </div>
    <div class="container">
      <div class="row">
        @foreach ($scats as $key => $scat)
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="single-category">
              <div class="img-wrapper">
                <img src="{{asset('assets/front/img/service_category_icons/'.$scat->image)}}" alt="">
              </div>
              <div class="text">
                <h4>{{$scat->name}}</h4>
                <p>{{$scat->short_text}}</p>
                <a href="{{route('front.services', ['category'=>$scat->id])}}" class="readmore">{{__('Read More')}}</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <!--   service section end   -->


  <!--   how we do section start   -->
  <div class="approach-section">
     <div class="container">
        <div class="row">
           <div class="col-lg-6">
              <div class="approach-summary">
                 <span class="section-title">{{$bs->approach_title}}</span>
                 <h2 class="section-summary">{{$bs->approach_subtitle}}</h2>
                 <a href="{{$bs->approach_button_url}}" class="boxed-btn" target="_blank"><span>{{$bs->approach_button_text}}</span></a>
              </div>
           </div>
           <div class="col-lg-6">
              <ul class="approach-lists">
                 @foreach ($points as $key => $point)
                   <li class="single-approach">
                      <div class="approach-icon-wrapper"><i class="{{$point->icon}}"></i></div>
                      <div class="approach-text">
                         <h4>{{$point->title}}</h4>
                         <p>{{$point->short_text}}</p>
                      </div>
                   </li>
                 @endforeach
              </ul>
           </div>
        </div>
     </div>
  </div>
  <!--   how we do section end   -->


  <!--    statistics section start    -->
  <div class="statistics-section @if($bs->home_version != 'parallax') statistics-bg @endif" id="statisticsSection" @if($bs->home_version == 'parallax') data-parallax="scroll" data-speed="0.2" data-image-src="{{asset('assets/front/img/statistic_bg.jpg')}}" @endif>
     <div class="statistics-container">
        <div class="container">
           <div class="row no-gutters">
             @foreach ($statistics as $key => $statistic)
               <div class="col-lg-3 col-md-6">
                  <div class="round"
                     data-value="1"
                     data-number="{{$statistic->quantity}}"
                     data-size="200"
                     data-thickness="6"
                     data-fill="{
                     &quot;color&quot;: &quot;#{{$bs->base_color}}&quot;
                     }">
                     <strong></strong>
                     <h5><i class="{{$statistic->icon}}"></i> {{$statistic->title}}</h5>
                  </div>
               </div>
             @endforeach
           </div>
        </div>
     </div>
     <div class="statistic-overlay"></div>
  </div>
  <!--    statistics section end    -->


  <!--    case section start   -->
  <div class="case-section">
     <div class="container">
        <div class="row text-center">
           <div class="col-lg-6 offset-lg-3">
              <span class="section-title">{{$bs->portfolio_section_title}}</span>
              <h2 class="section-summary">{{$bs->portfolio_section_text}}</h2>
           </div>
        </div>
     </div>
     <div class="container-fluid">
        <div class="row">
           <div class="col-md-12">
              <div class="case-carousel owl-carousel owl-theme">
                 @foreach ($portfolios as $key => $portfolio)
                   <div class="single-case single-case-bg-1" style="background-image: url('{{asset('assets/front/img/portfolios/featured/'.$portfolio->featured_image)}}');">
                      <div class="outer-container">
                         <div class="inner-container">
                            <h4>{{strlen($portfolio->title) > 36 ? substr($portfolio->title, 0, 36) . '...' : $portfolio->title}}</h4>
                            @if (!empty($portfolio->service))
                            <p>{{$portfolio->service->title}}</p>
                            @endif
                            <a href="{{route('front.portfoliodetails', $portfolio->slug)}}" class="readmore-btn"><span>{{__('View More')}}</span></a>
                         </div>
                      </div>
                   </div>
                 @endforeach
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--    case section end   -->

  <!--   Testimonial section start    -->
  <div class="testimonial-section pb-115">
     <div class="container">
        <div class="row text-center">
           <div class="col-lg-6 offset-lg-3">
              <span class="section-title">{{$bs->testimonial_title}}</span>
              <h2 class="section-summary">{{$bs->testimonial_subtitle}}</h2>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
              <div class="testimonial-carousel owl-carousel owl-theme">
                 @foreach ($testimonials as $key => $testimonial)
                   <div class="single-testimonial">
                      <div class="img-wrapper"><img src="{{asset('assets/front/img/testimonials/'.$testimonial->image)}}" alt=""></div>
                      <div class="client-desc">
                         <p class="comment">{{$testimonial->comment}}</p>
                         <h6 class="name">{{$testimonial->name}}</h6>
                         <p class="rank">{{$testimonial->rank}}</p>
                      </div>
                   </div>
                 @endforeach
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--   Testimonial section end    -->


  <!--    team section start   -->
  <div class="team-section section-padding @if($bs->home_version != 'parallax') team-bg @endif" @if($bs->home_version == 'parallax') data-parallax="scroll" data-speed="0.2" data-image-src="{{asset('assets/front/img/team_bg.jpg')}}" @endif>
     <div class="team-content">
        <div class="container">
           <div class="row text-center">
              <div class="col-lg-6 offset-lg-3">
                 <span class="section-title">{{$bs->team_section_title}}</span>
                 <h2 class="section-summary">{{$bs->team_section_subtitle}}</h2>
              </div>
           </div>
           <div class="row">
              <div class="team-carousel common-carousel owl-carousel owl-theme">
                @foreach ($members as $key => $member)
                 <div class="single-team-member">
                    <div class="team-img-wrapper">
                       <img src="{{asset('assets/front/img/members/'.$member->image)}}" alt="">
                       <div class="social-accounts">
                          <ul class="social-account-lists">
                             @if (!empty($member->facebook))
                               <li class="single-social-account"><a href="{{$member->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                             @endif
                             @if (!empty($member->twitter))
                               <li class="single-social-account"><a href="{{$member->twitter}}"><i class="fab fa-twitter"></i></a></li>
                             @endif
                             @if (!empty($member->linkedin))
                               <li class="single-social-account"><a href="{{$member->linkedin}}"><i class="fab fa-linkedin-in"></i></a></li>
                             @endif
                             @if (!empty($member->instagram))
                               <li class="single-social-account"><a href="{{$member->instagram}}"><i class="fab fa-instagram"></i></a></li>
                             @endif
                          </ul>
                       </div>
                    </div>
                    <div class="member-info">
                       <h5 class="member-name">{{$member->name}}</h5>
                       <small>{{$member->rank}}</small>
                    </div>
                 </div>
                @endforeach
              </div>
           </div>
        </div>
     </div>
     <div class="team-overlay"></div>
  </div>
  <!--    team section end   -->


  <!--    blog section start   -->
  <div class="blog-section section-padding">
     <div class="container">
        <div class="row text-center">
           <div class="col-lg-6 offset-lg-3">
              <span class="section-title">{{$bs->blog_section_title}}</span>
              <h2 class="section-summary">{{$bs->blog_section_subtitle}}</h2>
           </div>
        </div>
        <div class="blog-carousel owl-carousel owl-theme common-carousel">
           @foreach ($blogs as $key => $blog)
              <div class="single-blog">
                 <div class="blog-img-wrapper">
                    <img src="{{asset('assets/front/img/blogs/'.$blog->main_image)}}" alt="">
                 </div>
                 <div class="blog-txt">
                    <p class="date"><small>{{__('By')}} <span class="username">{{__('Admin')}}</span></small> | <small>{{date ( 'd M, Y', strtotime($blog->created_at) )}}</small> </p>
                    <h4 class="blog-title"><a href="{{route('front.blogdetails', $blog->slug)}}">{{strlen($blog->title) > 40 ? substr($blog->title, 0, 40) . '...' : $blog->title}}</a></h4>
                    <p class="blog-summary">{!! (strlen(strip_tags($blog->content)) > 100) ? substr(strip_tags($blog->content), 0, 100) . '...' : strip_tags($blog->content) !!}</p>
                    <a href="{{route('front.blogdetails', $blog->slug)}}" class="readmore-btn"><span>{{__('Read More')}}</span></a>
                 </div>
              </div>
           @endforeach
        </div>
     </div>
  </div>
  <!--    blog section end   -->


  <!--    call to action section start    -->
  <div class="cta-section cta-bg">
     <div class="container">
        <div class="cta-content">
           <div class="row">
              <div class="col-md-9 col-lg-7">
                 <h3>{{$bs->cta_section_text}}</h3>
              </div>
              <div class="col-md-3 col-lg-5 contact-btn-wrapper">
                 <a href="{{$bs->cta_section_button_url}}" class="boxed-btn contact-btn"><span>{{$bs->cta_section_button_text}}</span></a>
              </div>
           </div>
        </div>
     </div>
     <div class="cta-overlay"></div>
  </div>
  <!--    call to action section end    -->


  <!--   partner section start    -->
  <div class="partner-section">
     <div class="container top-border">
        <div class="row">
           <div class="col-md-12">
              <div class="partner-carousel owl-carousel owl-theme common-carousel">
                 @foreach ($partners as $key => $partner)
                   <a class="single-partner-item d-block" href="{{$partner->url}}" target="_blank">
                      <div class="outer-container">
                         <div class="inner-container">
                            <img src="{{asset('assets/front/img/partners/'.$partner->image)}}" alt="">
                         </div>
                      </div>
                   </a>
                 @endforeach
              </div>
           </div>
        </div>
     </div>
  </div>
  <!--   partner section end    -->
@endsection
