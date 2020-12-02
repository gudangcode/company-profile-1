@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Page Headings</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Basic Settings</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Page Headings</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.heading.update')}}" method="post">
          @csrf
          <div class="card-header">
            <div class="card-title">Update Page Headings</div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label>Service Title **</label>
                  <input class="form-control" name="service_title" value="{{$bs->service_title}}">
                  @if ($errors->has('service_title'))
                    <p class="mb-0 text-danger">{{$errors->first('service_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Service Subtitle **</label>
                  <input class="form-control" name="service_subtitle" value="{{$bs->service_subtitle}}">
                  @if ($errors->has('service_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('service_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Service Details Title **</label>
                  <input class="form-control" name="service_details_title" value="{{$bs->service_details_title}}">
                  @if ($errors->has('service_details_title'))
                    <p class="mb-0 text-danger">{{$errors->first('service_details_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Portfolio Title **</label>
                  <input class="form-control" name="portfolio_title" value="{{$bs->portfolio_title}}">
                  @if ($errors->has('portfolio_title'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolio_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Portfolio Subtitle **</label>
                  <input class="form-control" name="portfolio_subtitle" value="{{$bs->portfolio_subtitle}}">
                  @if ($errors->has('portfolio_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolio_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Portfolio Details Title **</label>
                  <input class="form-control" name="portfolio_details_title" value="{{$bs->portfolio_details_title}}">
                  @if ($errors->has('portfolio_details_title'))
                    <p class="mb-0 text-danger">{{$errors->first('portfolio_details_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>FAQ Title **</label>
                  <input class="form-control" name="faq_title" value="{{$bs->faq_title}}">
                  @if ($errors->has('faq_title'))
                    <p class="mb-0 text-danger">{{$errors->first('faq_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>FAQ Subtitle **</label>
                  <input class="form-control" name="faq_subtitle" value="{{$bs->faq_subtitle}}">
                  @if ($errors->has('faq_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('faq_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Blog Title **</label>
                  <input class="form-control" name="blog_title" value="{{$bs->blog_title}}">
                  @if ($errors->has('blog_title'))
                    <p class="mb-0 text-danger">{{$errors->first('blog_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Blog Subtitle **</label>
                  <input class="form-control" name="blog_subtitle" value="{{$bs->blog_subtitle}}">
                  @if ($errors->has('blog_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('blog_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Blog Details Title **</label>
                  <input class="form-control" name="blog_details_title" value="{{$bs->blog_details_title}}">
                  @if ($errors->has('blog_details_title'))
                    <p class="mb-0 text-danger">{{$errors->first('blog_details_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Gallery Title **</label>
                  <input class="form-control" name="gallery_title" value="{{$bs->gallery_title}}">
                  @if ($errors->has('gallery_title'))
                    <p class="mb-0 text-danger">{{$errors->first('gallery_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Gallery Subtitle **</label>
                  <input class="form-control" name="gallery_subtitle" value="{{$bs->gallery_subtitle}}">
                  @if ($errors->has('gallery_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('gallery_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Team Title **</label>
                  <input class="form-control" name="team_title" value="{{$bs->team_title}}">
                  @if ($errors->has('team_title'))
                    <p class="mb-0 text-danger">{{$errors->first('team_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Team Subtitle **</label>
                  <input class="form-control" name="team_subtitle" value="{{$bs->team_subtitle}}">
                  @if ($errors->has('team_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('team_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Contact Title **</label>
                  <input class="form-control" name="contact_title" value="{{$bs->contact_title}}">
                  @if ($errors->has('contact_title'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Contact Subtitle **</label>
                  <input class="form-control" name="contact_subtitle" value="{{$bs->contact_subtitle}}">
                  @if ($errors->has('contact_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('contact_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Quote Title **</label>
                  <input class="form-control" name="quote_title" value="{{$bs->quote_title}}">
                  @if ($errors->has('quote_title'))
                    <p class="mb-0 text-danger">{{$errors->first('quote_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Quote Subtitle **</label>
                  <input class="form-control" name="quote_subtitle" value="{{$bs->quote_subtitle}}">
                  @if ($errors->has('quote_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('quote_subtitle')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Error Page Title **</label>
                  <input class="form-control" name="error_title" value="{{$bs->error_title}}">
                  @if ($errors->has('error_title'))
                    <p class="mb-0 text-danger">{{$errors->first('error_title')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Error Page Subtitle **</label>
                  <input class="form-control" name="error_subtitle" value="{{$bs->error_subtitle}}">
                  @if ($errors->has('error_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('error_subtitle')}}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
