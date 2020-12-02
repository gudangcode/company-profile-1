@extends('front.layout')

@section('content')
  <!--   hero area start   -->
  <div class="breadcrumb-area blogs">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{$bs->blog_title}}</span>
                 <h1>{{$bs->blog_subtitle}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li>{{__('Latest Blogs')}}</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="breadcrumb-area-overlay"></div>
  </div>
  <!--   hero area end    -->


  <!--    blog lists start   -->
  <div class="blog-lists section-padding">
     <div class="container">
        <div class="row">
           <div class="col-lg-8">
              <div class="row">
                @if (count($blogs) == 0)
                  <div class="col-md-12">
                    <div class="bg-light py-5">
                      <h3 class="text-center">{{__('NO BLOG FOUND')}}</h3>
                    </div>
                  </div>
                @else
                  @foreach ($blogs as $key => $blog)
                    <div class="col-md-6">
                       <div class="single-blog">
                          <div class="blog-img-wrapper">
                             <img src="{{asset('assets/front/img/blogs/'.$blog->main_image)}}" alt="">
                          </div>
                          <div class="blog-txt">
                             <p class="date"><small>{{__('By')}} <span class="username">{{__('Admin')}}</span></small>    |    <small>{{date('d M, Y', strtotime($blog->created_at))}}</small> </p>
                             <h4 class="blog-title"><a href="{{route('front.blogdetails', $blog->slug)}}">{{strlen($blog->title) > 40 ? substr($blog->title, 0, 40) . '...' : $blog->title}}</a></h4>
                             <p class="blog-summary">{!! (strlen(strip_tags($blog->content)) > 100) ? substr(strip_tags($blog->content), 0, 100) . '...' : strip_tags($blog->content) !!}</p>
                             <a href="{{route('front.blogdetails', $blog->slug)}}" class="readmore-btn"><span>{{__('Read More')}}</span></a>
                          </div>
                       </div>
                    </div>
                  @endforeach
                @endif
              </div>
              @if ($blogs->total() > 6)
                <div class="row">
                   <div class="col-md-12">
                      <nav class="pagination-nav {{$blogs->total() > 6 ? 'mb-4' : ''}}">
                        {{$blogs->appends(['term'=>request()->input('term'), 'month'=>request()->input('month'), 'year'=>request()->input('year'), 'category' => request()->input('category')])->links()}}
                      </nav>
                   </div>
                </div>
              @endif
           </div>
           <!--    blog sidebar section start   -->
           <div class="col-lg-4">
              <div class="sidebar">
                 <div class="blog-sidebar-widgets">
                    <div class="searchbar-form-section">
                       <form action="{{route('front.blogs', ['category' => request()->input('category'), 'month' => request()->input('month'), 'year' => request()->input('year')])}}" method="GET">
                          <div class="searchbar">
                             <input name="category" type="hidden" value="{{request()->input('category')}}">
                             <input name="month" type="hidden" value="{{request()->input('month')}}">
                             <input name="year" type="hidden" value="{{request()->input('year')}}">
                             <input name="term" type="text" placeholder="{{__('Search Blogs')}}" value="{{request()->input('term')}}">
                             <button type="submit"><i class="fa fa-search"></i></button>
                          </div>
                       </form>
                    </div>
                 </div>
                 <div class="blog-sidebar-widgets category-widget">
                    <div class="category-lists">
                       <h4>{{__('Categories')}}</h4>
                       <ul>
                          @foreach ($bcats as $key => $bcat)
                            <li class="single-category @if(request()->input('category') == $bcat->id) active @endif"><a href="{{route('front.blogs', ['term'=>request()->input('term'), 'category'=>$bcat->id, 'month' => request()->input('month'), 'year' => request()->input('year')])}}">{{$bcat->name}}</a></li>
                          @endforeach
                       </ul>
                    </div>
                 </div>
                 <div class="blog-sidebar-widgets category-widget">
                    <div class="category-lists">
                       <h4>{{__('Archives')}}</h4>
                       <ul>
                          @foreach ($archives as $key => $archive)
                            @php
                              $myArr = explode('-', $archive->date);
                              $monthNum  = $myArr[0];
                              $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                              $monthName = $dateObj->format('F');
                            @endphp
                            <li class="single-category @if(request()->input('month') == $myArr[0] && request()->input('year') == $myArr[1]) active @endif"><a href="{{route('front.blogs', ['term'=>request()->input('term'), 'category'=>request()->input('category'),'month'=>$myArr[0], 'year'=>$myArr[1]])}}">{{$monthName}} {{$myArr[1]}}</a></li>
                          @endforeach
                       </ul>
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
           <!--    blog sidebar section end   -->
        </div>
     </div>
  </div>
  <!--    blog lists end   -->
@endsection
