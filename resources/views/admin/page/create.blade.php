@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Pages</h4>
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
        <a href="#">Create Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Pages</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Create Page</div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-10 offset-lg-1">
              <form id="ajaxForm" action="{{route('admin.page.store')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Name **</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter Name" value="">
                      <p id="errname" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Title **</label>
                      <input type="text" class="form-control" name="title" placeholder="Enter Title" value="">
                      <p id="errtitle" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">Subtitle **</label>
                      <input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="">
                      <p id="errsubtitle" class="em text-danger mb-0"></p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Body **</label>
                  <textarea id="body" class="form-control nic-edit" name="body" rows="20" cols="80"></textarea>
                  <p id="errbody" class="em text-danger mb-0"></p>
                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
