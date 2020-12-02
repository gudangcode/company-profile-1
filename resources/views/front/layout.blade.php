<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      @if (request()->is('blog-details/*'))
      <meta name="description" content="{{$blog->meta_description}}">
      <meta name="keywords" content="{{$blog->meta_keywords}}">
      @else
      <meta name="description" content="{{$bs->meta_description}}">
      <meta name="keywords" content="{{$bs->meta_keywords}}">
      @endif
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{$bs->website_title}}</title>
      <!-- favicon -->
      <link rel="shortcut icon" href="{{asset('assets/front/img/favicon.jpg')}}" type="image/x-icon">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
      <!-- fontawesome css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/fontawesome.min.css')}}">
      <!-- flaticon css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/flaticon.css')}}">
      <!-- owl carousel css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
      <!-- owl carousel theme css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">
      <!-- magnefic popup css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css')}}">
      <!-- lightbox css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/lightbox.min.css')}}">
      <!-- slicknav css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/slicknav.css')}}">
      <!-- toastr css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/toastr.min.css')}}">
      <!-- main css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
      <!-- responsive css -->
      <link rel="stylesheet" href="{{asset('assets/front/css/responsive.css')}}">
      <!-- base color change -->
      <link href="{{url('/')}}/assets/front/css/base-color.php?color={{$bs->base_color}}" rel="stylesheet">
      <!-- jquery js -->
      <script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>
      @if ($bs->is_tawkto == 1)
      <style>
      .back-to-top {
          bottom: 50px;
      }
      .back-to-top.show {
          right: 20px;
      }
      </style>
      @endif
      @if (count($langs) == 0)
      <style media="screen">
      .support-bar-area ul.social-links li:last-child {
          margin-right: 0px;
      }
      .support-bar-area ul.social-links::after {
          display: none;
      }
      </style>
      @endif
   </head>



   <body>
     @if ($bs->is_analytics == 1)
     <!-- Global site tag (gtag.js) - Google Analytics -->
     <script async src="https://www.googletagmanager.com/gtag/js?id={{$bs->google_analytics_id}}"></script>
     <script>
       window.dataLayer = window.dataLayer || [];
       function gtag(){dataLayer.push(arguments);}
       gtag('js', new Date());

       gtag('config', '{{$bs->google_analytics_id}}');
     </script>
     @endif

      <!--   header area start   -->
      <div class="header-area header-absolute">
         <div class="container">
            <div class="support-bar-area">
               <div class="row">
                  <div class="col-lg-6 support-contact-info">
                     <span class="address"><i class="far fa-envelope"></i> {{$bs->support_email}}</span>
                     <span class="phone"><i class="flaticon-chat"></i> {{$bs->support_phone}}</span>
                  </div>
                  <div class="col-lg-6 text-right">
                     <ul class="social-links">
                       @foreach ($socials as $key => $social)
                         <li><a target="_blank" href="{{$social->url}}"><i class="{{$social->icon}}"></i></a></li>
                       @endforeach
                     </ul>

                     @if (count($langs) > 0)
                       @php
                         $currentLang = currLanguage();
                       @endphp
                       <div class="language">
                          <a class="language-btn" href="#"><i class="flaticon-worldwide"></i> {{$currentLang->name}}</a>
                          <ul class="language-dropdown">
                            @foreach ($langs as $key => $lang)
                            <li><a href='{{ route('changeLanguage', $lang->code) }}'>{{$lang->name}}</a></li>
                            @endforeach
                          </ul>
                       </div>
                     @endif

                  </div>
               </div>
            </div>
            <div class="header-navbar">
               <div class="row">
                  <div class="col-lg-2 col-6">
                     <div class="logo-wrapper">
                        <a href="{{route('front.index')}}"><img src="{{asset('assets/front/img/logo.png')}}" alt=""></a>
                     </div>
                  </div>
                  <div class="col-lg-10 col-6 text-right position-static">
                     <ul class="main-menu" id="mainMenu">
                        <li class="@if(request()->path() == '/') active  @endif"><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                        <li class="dropdown mega @if(request()->is('service/*')) active @endif">
                           <a class="dropdown-btn" href="#">{{__('Services')}}</a>
                           <ul class="dropdown-lists">
                             @if (count($scats) > 0)
                               @foreach ($scats as $key => $scat)
                                 <h5 class="service-title">{{$scat->name}}</h5>
                                 @foreach ($scat->services as $key => $service)
                                   <li><a href="{{route('front.servicedetails', $service->slug)}}">{{$service->title}}</a></li>
                                 @endforeach
                               @endforeach
                             @endif
                           </ul>
                        </li>
                        <li class="mega-dropdown">
                          <a class="dropbtn @if(request()->is('service/*') || request()->path() == 'services') active @endif" href="#">{{__('Services')}} <i class="fas fa-angle-down"></i></a>
                          <div class="mega-dropdown-content">
                            <div class="row">
                              @if (count($scats) > 0)
                                @foreach ($scats as $key => $scat)
                                  <div class="col-lg-3">
                                    <div class="service-category">
                                      <h3>{{$scat->name}}</h3>
                                      @foreach ($scat->services as $key => $service)
                                        <a class="@if(Request::route('slug') == $service->slug) active @endif" href="{{route('front.servicedetails', $service->slug)}}">{{$service->title}}</a>
                                      @endforeach
                                    </div>
                                  </div>
                                @endforeach
                              @endif
                            </div>
                          </div>
                        </li>
                        <li class="@if(request()->path() == 'portfolios') active  @endif"><a href="{{route('front.portfolios')}}">{{__('Portfolios')}}</a></li>
                        <li class="dropdown
                        @if(request()->is('*/page')) active
                        @elseif(request()->path() == "faq") active
                        @elseif(request()->path() == "gallery") active
                        @endif">
                           <a class="dropdown-btn" href="#">{{$bs->parent_link_name}}</a>
                           <ul class="dropdown-lists">
                             @foreach ($pages as $key => $page)
                               <li class="@if(request()->path() == "$page->slug/page") active @endif"><a href="{{route('front.dynamicPage', $page->slug)}}">{{$page->name}}</a></li>
                             @endforeach
                             <li class="@if(request()->path() == "team") active @endif"><a href="{{route('front.team')}}">{{__('Team Members')}}</a></li>
                             <li class="@if(request()->path() == "gallery") active @endif"><a href="{{route('front.gallery')}}">{{__('Gallery')}}</a></li>
                             <li class="@if(request()->path() == "faq") active @endif"><a href="{{route('front.faq')}}">{{__('FAQ')}}</a></li>
                           </ul>
                        </li>
                        <li class="@if(request()->path() == 'blogs') active  @endif"><a href="{{route('front.blogs')}}">{{__('Blogs')}}</a></li>
                        <li class="@if(request()->path() == 'contact') active  @endif"><a href="{{route('front.contact')}}">{{__('Contact')}}</a></li>
                        <li><a href="{{route('front.quote')}}" class="boxed-btn">{{__('Request A Quote')}}</a></li>
                     </ul>
                     <div id="mobileMenu"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--   header area end   -->


      @yield('content')


      <!--    footer section start   -->
      <footer class="footer-section">
         <div class="container">
            <div class="top-footer-section">
               <div class="row">
                  <div class="col-lg-4 col-md-12">
                     <div class="footer-logo-wrapper">
                        <a href="{{route('front.index')}}">
                        <img src="{{asset('assets/front/img/footer_logo.jpg')}}" alt="">
                        </a>
                     </div>
                     <p class="footer-txt">{{$bs->footer_text}}</p>
                  </div>
                  <div class="col-lg-2 col-md-3">
                     <h4>{{__('Useful Links')}}</h4>
                     <ul class="footer-links">
                        @foreach ($ulinks as $key => $ulink)
                          <li><a href="{{$ulink->url}}">{{$ulink->name}}</a></li>
                        @endforeach
                     </ul>
                  </div>
                  <div class="col-lg-3 col-md-4">
                     <h4>{{__('Newsletter')}}</h4>
                     <form class="footer-newsletter" id="subscribeForm" action="{{route('front.subscribe')}}" method="post">
                       @csrf
                       <p>{{$bs->newsletter_text}}</p>
                       <input type="email" name="email" value="" placeholder="{{__('Enter Email Address')}}">
                       <p id="erremail" class="text-danger mb-0"></p>
                       <button type="submit">{{__('Subscribe')}}</button>
                     </form>
                  </div>
                  <div class="col-lg-3 col-md-5">
                     <h4>{{__('Contact Us')}}</h4 >
                     <div class="footer-contact-info">
                        <ul>
                           <li><i class="fa fa-home"></i><span>{{$bs->contact_address}}</span>
                           </li>
                           <li><i class="fa fa-phone"></i><span>{{$bs->contact_number}}</span></li>
                           <li><i class="far fa-envelope"></i><span>{{$bs->contact_mail}}</span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright-section">
               <div class="row">
                  <div class="col-sm-12 text-center">
                     {!! $bs->copyright_text !!}
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!--    footer section end   -->


      <!-- preloader section start -->
      <div class="loader-container">
         <span class="loader">
         <span class="loader-inner"></span>
         </span>
      </div>
      <!-- preloader section end -->


      <!-- back to top area start -->
      <div class="back-to-top">
         <i class="fas fa-chevron-up"></i>
      </div>
      <!-- back to top area end -->


      <script>
        var lat = {{$bs->latitude}};
        var lng = {{$bs->longitude}};
      </script>
      <!-- popper js -->
      <script src="{{asset('assets/front/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
      <!-- isotope js -->
      <script src="{{asset('assets/front/js/isotope.pkgd.min.js')}}"></script>
      <!-- owl carousel js -->
      <script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
      <!-- magnefic popup js -->
      <script src="{{asset('assets/front/js/jquery.slicknav.min.js')}}"></script>
      <!-- magnefic popup js -->
      <script src="{{asset('assets/front/js/jquery.magnific-popup.min.js')}}"></script>
      <!-- lightbox js -->
      <script src="{{asset('assets/front/js/lightbox.min.js')}}"></script>
      <!-- slicknav js -->
      <script src="{{asset('assets/front/js/toastr.min.js')}}"></script>
      @if ($bs->home_version == 'particles')
        <!-- particle js -->
        <script src="{{asset('assets/front/js/particles.min.js')}}"></script>
      @endif
      @if ($bs->home_version == 'water')
        <!-- jquery ripples js -->
        <script src="{{asset('assets/front/js/jquery.ripples-min.js')}}"></script>
      @endif
      @if ($bs->home_version == 'video')
        <!-- ytplayer js -->
        <script src="{{asset('assets/front/js/YTPlayer.min.js')}}"></script>
      @endif
      @if ($bs->home_version == 'parallax')
        <!-- parallax js -->
        <script src="{{asset('assets/front/js/parallax.min.js')}}"></script>
      @endif
      <!-- jQuery circle progress js -->
      <script src="{{asset('assets/front/js/circle-progress.min.js')}}"></script>
      @if (request()->path() == 'contact')
      <!-- google map api -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7eALQrRUekFNQX71IBNkxUXcz-ALS-MY&callback=initMap" async defer></script>
      <!-- google map activate js -->
      <script src="{{asset('assets/front/js/google-map-activate.js')}}"></script>
      @endif
      <!-- main js -->
      <script src="{{asset('assets/front/js/main.js')}}"></script>
      @if (session()->has('success'))
      <script>
         toastr["success"]("{{session('success')}}");
      </script>
      @endif
      <script>
        $(document).ready(function() {
          $("#subscribeForm").on('submit', function(e) {
            e.preventDefault();

            let formId = $(this).attr('id');
            let fd = new FormData(document.getElementById(formId));
            $.ajax({
              url: $(this).attr('action'),
              type: $(this).attr('method'),
              data: fd,
              contentType: false,
              processData: false,
              success: function(data) {
                // console.log(data.errors.email[0]);
                if ((data.errors)) {
                  $("#erremail").html(data.errors.email[0]);
                } else {
                  toastr["success"]("You are subscribed successfully!");
                  $("#subscribeForm").trigger('reset');
                  $("#erremail").html('');
                }
              }
            });
          });
        });
      </script>

      @if ($bs->is_tawkto == 1)
      <!--Start of Tawk.to Script-->
      <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/{{$bs->tawk_to_api_key}}/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
      </script>
      <!--End of Tawk.to Script-->
      @endif
   </body>
</html>
