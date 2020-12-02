<div class="hero-area hero2-carousel owl-carousel owl-theme">
  @if (!empty($sliders))
    @foreach ($sliders as $key => $slider)
      <div class="hero-bg-2" style="background-image: url('{{asset('assets/front/img/sliders/'.$slider->image)}}')">
         <div class="container">
            <div class="hero-txt">
               <div class="row">
                  <div class="col-12">
                     <span>{{$slider->title}}</span>
                     <h1>{{$slider->text}}</h1>
                     <a href="{{$slider->button_url}}" class="hero-boxed-btn">{{$slider->button_text}}</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="hero-area-overlay"></div>
      </div>
    @endforeach
  @endif
</div>
