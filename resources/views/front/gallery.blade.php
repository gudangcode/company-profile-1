@extends('front.layout')


@section('content')
<!--   breadcrumb area start   -->
<div class="breadcrumb-area cases">
   <div class="container">
      <div class="breadcrumb-txt">
         <div class="row">
            <div class="col-xl-7 col-lg-8 col-sm-10">
               <span>{{$bs->gallery_title}}</span>
               <h1>{{$bs->gallery_subtitle}}</h1>
               <ul class="breadcumb">
                  <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                  <li>{{__('GALLERY')}}</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="breadcrumb-area-overlay"></div>
</div>
<!--   breadcrumb area end    -->


<!--    Gallery section start   -->
<div class="gallery-section masonry clearfix">
   <div class="container">
      <div class="grid">
         <div class="grid-sizer"></div>
         @foreach ($galleries as $key => $gallery)
           <div class="single-pic">
              <img src="{{asset('assets/front/img/gallery/'.$gallery->image)}}" alt="">
              <div class="single-pic-overlay"></div>
              <div class="txt-icon">
                 <div class="outer">
                    <div class="inner">
                       <h4>{{strlen($gallery->title) > 20 ? substr($gallery->title, 0, 20) . '...' : $gallery->title}}</h4>
                       <a class="icon-wrapper" href="{{asset('assets/front/img/gallery/'.$gallery->image)}}" data-lightbox="single-pic" data-title="{{$gallery->title}}">
                       <i class="fas fa-search-plus"></i>
                       </a>
                    </div>
                 </div>
              </div>
           </div>
         @endforeach
      </div>
      <div class="row">
         <div class="col-md-12">
            <nav class="pagination-nav">
              {{$galleries->links()}}
            </nav>
         </div>
      </div>
   </div>
</div>
<!--    Gallery section end   -->
@endsection
