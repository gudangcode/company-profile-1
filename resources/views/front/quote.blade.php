@extends('front.layout')

@section('content')
  <!--   breadcrumb area start   -->
  <div class="breadcrumb-area cases">
     <div class="container">
        <div class="breadcrumb-txt">
           <div class="row">
              <div class="col-xl-7 col-lg-8 col-sm-10">
                 <span>{{$bs->quote_title}}</span>
                 <h1>{{$bs->quote_subtitle}}</h1>
                 <ul class="breadcumb">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li>{{__('Quote Page')}}</li>
                 </ul>
              </div>
           </div>
        </div>
     </div>
     <div class="breadcrumb-area-overlay"></div>
  </div>
  <!--   breadcrumb area end    -->


  <!--   quote area start   -->
  <div class="quote-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <form action="{{route('front.sendquote')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-element mb-4">
                  <input name="name" type="text" value="{{old('name')}}" placeholder="{{__('Name')}}">
                  @if ($errors->has('name'))
                    <p class="text-danger mb-0">{{$errors->first('name')}}</p>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-element mb-4">
                  <input type="text" name="email" value="{{old('email')}}" placeholder="{{__('Email')}}">
                  @if ($errors->has('email'))
                    <p class="text-danger mb-0">{{$errors->first('email')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-element mb-4">
                  <input type="text" name="phone" value="{{old('phone')}}" placeholder="{{__('Contact Number')}}">
                  @if ($errors->has('phone'))
                    <p class="text-danger mb-0">{{$errors->first('phone')}}</p>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-element mb-4">
                  <input type="text" name="country" value="{{old('country')}}" placeholder="{{__('Country Name')}}">
                  @if ($errors->has('country'))
                    <p class="text-danger mb-0">{{$errors->first('country')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-element mb-4">
                  <select name="budget">
                    <option value="" selected disabled>{{__('Approximate Budget')}}</option>
                    @foreach ($budgets as $key => $budget)
                      <option value="{{$budget->limits}}" {{old('budget') == $budget->limits ? 'selected' : ''}}>{{$budget->limits}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('budget'))
                    <p class="text-danger mb-0">{{$errors->first('budget')}}</p>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-element mb-4">
                  <input type="text" name="skype_whatsapp" value="{{old('skype_whatsapp')}}" placeholder="{{__('Skype ID / Whatsapp Number')}}">
                  @if ($errors->has('skype_whatsapp'))
                    <p class="text-danger mb-0">{{$errors->first('skype_whatsapp')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-12 mb-2">
                  <h6><strong>{{__('Select Your Choices :')}}</strong></h6>
              </div>
              <div class="col-lg-12">
                <div class="row">
                  @foreach ($services as $key => $service)
                    <div class="col-lg-3 col-md-6">
                      <div class="custom-control custom-checkbox">
                        <input name="services[]" type="checkbox" class="custom-control-input" id="customCheck{{$service->id}}" value="{{$service->title}}" {{is_array(old('services')) && in_array($service->title, old('services')) ? 'checked' : ''}}>
                        <label class="custom-control-label pt-1" for="customCheck{{$service->id}}">{{$service->title}}</label>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="col-lg-12">
                @if ($errors->has('services'))
                  <p class="text-danger mb-0">{{$errors->first('services')}}</p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-element mb-4">
                  <textarea name="description" rows="8" cols="80" placeholder="{{__('Project Description')}}">{{old('description')}}</textarea>
                  @if ($errors->has('description'))
                    <p class="text-danger mb-0">{{$errors->first('description')}}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-12">
                <div class="form-element mb-2">
                  <input type="file" name="nda" value="">
                </div>
                <p class="text-warning mb-0">** {{__('Only doc, docx, pdf, rtf, txt files are allowed')}}</p>
                @if ($errors->has('nda'))
                  <p class="text-danger mb-0">{{$errors->first('nda')}}</p>
                @endif
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="checknda" class="custom-control-input" id="nda" value="1" {{old('checknda') == 1 ? 'checked' : ''}}>
                  <label class="custom-control-label pt-1" for="nda">{{__('Send me a copy of NDA')}}</label>
                </div>
                @if ($errors->has('checknda'))
                  <p class="text-danger mb-0">{{$errors->first('checknda')}}</p>
                @endif
              </div>
            </div>

            @if ($bs->is_recaptcha == 1)
              <div class="row mb-4">
                <div class="col-lg-12">
                  {!! NoCaptcha::renderJs() !!}
                  {!! NoCaptcha::display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                    <p class="text-danger mb-0">{{$errors->first('g-recaptcha-response')}}</p>
                  @endif
                </div>
              </div>
            @endif

            <div class="row">
              <div class="col-lg-12 text-center">
                <button type="submit" name="button">{{__('Submit')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--   quote area end   -->
@endsection
