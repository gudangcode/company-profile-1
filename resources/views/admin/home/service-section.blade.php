@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Service Section</h4>
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
        <a href="#">Home Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Service Section</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Update Service Section</div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">

              <form id="ajaxForm" action="{{route('admin.servicesection.update')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Title **</label>
                  <input name="service_section_title" class="form-control" value="{{$bs->service_section_title}}">
                  <p id="errservice_section_title" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Subtitle **</label>
                  <input name="service_section_subtitle" class="form-control" value="{{$bs->service_section_subtitle}}">
                  <p id="errservice_section_subtitle" class="em text-danger mb-0"></p>
                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
