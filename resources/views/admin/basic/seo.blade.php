@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">SEO Informations</h4>
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
        <a href="#">SEO Informations</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.seo.update')}}" method="post">
          @csrf
          <div class="card-header">
            <div class="card-title">Update SEO Informations</div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label>Meta Keywords</label>
                  <input class="form-control" name="meta_keywords" value="{{$bs->meta_keywords}}" placeholder="Enter meta keywords" data-role="tagsinput">
                  @if ($errors->has('meta_keywords'))
                    <p class="mb-0 text-danger">{{$errors->first('meta_keywords')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Meta Description</label>
                  <textarea class="form-control" name="meta_description" rows="5" placeholder="Enter meta description">{{$bs->meta_description}}</textarea>
                  @if ($errors->has('meta_description'))
                    <p class="mb-0 text-danger">{{$errors->first('meta_description')}}</p>
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
