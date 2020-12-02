@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Support Informations</h4>
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
        <a href="#">Support Informations</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.support.update')}}" method="POST">
          <div class="card-header">
            <div class="card-title">Change Informations</div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label>Email **</label>
                  <input class="form-control" name="support_email" value="{{$bs->support_email}}" placeholder="Email">
                  @if ($errors->has('support_email'))
                    <p class="mb-0 text-danger">{{$errors->first('support_email')}}</p>
                  @endif
                </div>
                <div class="form-group">
                  <label>Phone **</label>
                  <input class="form-control" name="support_phone" value="{{$bs->support_phone}}" placeholder="Phone">
                  @if ($errors->has('support_phone'))
                    <p class="mb-0 text-danger">{{$errors->first('support_phone')}}</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-lg-3 col-md-3 col-sm-12">

                </div>
                <div class="col-12 text-center">
                  <button id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
