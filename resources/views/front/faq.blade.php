@extends('front.layout')


@section('content')
<!--   breadcrumb area start   -->
<div class="breadcrumb-area cases">
   <div class="container">
      <div class="breadcrumb-txt">
         <div class="row">
            <div class="col-xl-7 col-lg-8 col-sm-10">
               <span>{{$bs->faq_title}}</span>
               <h1>{{$bs->faq_subtitle}}</h1>
               <ul class="breadcumb">
                  <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                  <li>{{__('FAQS')}}</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="breadcrumb-area-overlay"></div>
</div>
<!--   breadcrumb area end    -->


<!--   FAQ section start   -->
<div class="faq-section">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="accordion" id="accordionExample1">
               @for ($i=0; $i < ceil(count($faqs)/2); $i++)
               <div class="card">
                  <div class="card-header" id="heading{{$faqs[$i]->id}}">
                     <h2 class="mb-0">
                        <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$faqs[$i]->id}}" aria-expanded="false" aria-controls="collapse{{$faqs[$i]->id}}">
                        {{$faqs[$i]->question}}
                        </button>
                     </h2>
                  </div>
                  <div id="collapse{{$faqs[$i]->id}}" class="collapse" aria-labelledby="heading{{$faqs[$i]->id}}" data-parent="#accordionExample1">
                     <div class="card-body">
                        {{$faqs[$i]->answer}}
                     </div>
                  </div>
               </div>
               @endfor
            </div>
         </div>
         <div class="col-lg-6">
            <div class="accordion" id="accordionExample2">
               @for ($i=ceil(count($faqs)/2); $i < count($faqs); $i++)
               <div class="card">
                  <div class="card-header" id="heading{{$faqs[$i]->id}}">
                     <h2 class="mb-0">
                        <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$faqs[$i]->id}}" aria-expanded="false" aria-controls="collapse{{$faqs[$i]->id}}">
                        {{$faqs[$i]->question}}
                        </button>
                     </h2>
                  </div>
                  <div id="collapse{{$faqs[$i]->id}}" class="collapse" aria-labelledby="heading{{$faqs[$i]->id}}" data-parent="#accordionExample2">
                     <div class="card-body">
                        {{$faqs[$i]->answer}}
                     </div>
                  </div>
               </div>
               @endfor
            </div>
         </div>
      </div>
   </div>
</div>
<!--   FAQ section end   -->
@endsection
