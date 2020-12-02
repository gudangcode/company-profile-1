@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Logo & Text</h4>
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
        <a href="#">Footer</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Logo & Text</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Update Logo & Text</div>
        </div>
        <div class="card-body pt-5 pb-4">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.footer.upload')}}" method="POST">
                <div class="form-row">
                  <div class="col-12 mb-2">
                    <label for=""><strong>Footer Logo **</strong></label>
                  </div>
                  <div class="col-md-12 d-md-block d-sm-none mb-3">
                    @if (file_exists('assets/front/img/footer_logo.jpg'))
                      <img src="{{asset('assets/front/img/footer_logo.jpg?'.time())}}" alt="..." class="img-thumbnail">
                    @else
                      <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                    @endif
                  </div>
                  <div class="col-sm-12">
                    <div class="from-group mb-2">
                      <input type="text" class="form-control progressbar" aria-describedby="fileHelp" placeholder="No image uploaded..." readonly="readonly" />

                      <div class="progress mb-2 d-none">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                          role="progressbar"
                          style="width: 0%;"
                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
                          0%
                        </div>
                      </div>

                    </div>

                    <div class="mt-4">
                      <div role="button" class="btn btn-primary mr-2">
                        <i class="fa fa-folder-o fa-fw"></i> Browse Files
                        <input type="file" title='Click to add Files' name="footer_logo" />
                      </div>
                      <small class="status text-muted">Select a file or drag it over this area..</small>
                      <p class="text-warning mb-0 mt-2">Upload 140X55 image for best quality.</p>
                      <p class="text-warning mb-0">Only jpg, jpeg, png image is allowed.</p>
                      <p class="text-danger mb-0 em" id="errfooter_logo"></p>
                    </div>
                  </div>
                </div>
              </form>


              <form id="ajaxForm" action="{{route('admin.footer.update')}}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Footer Text **</label>
                  <input type="text" class="form-control" name="footer_text" value="{{$bs->footer_text}}">
                  <p id="errfooter_text" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Newsletter Text **</label>
                  <input type="text" class="form-control" name="newsletter_text" value="{{$bs->newsletter_text}}">
                  <p id="errnewsletter_text" class="em text-danger mb-0"></p>
                </div>
                <div class="form-group">
                  <label for="">Copyright Text **</label>
                  <textarea id="copyright_text" name="copyright_text" class="nic-edit form-control" rows="8" cols="80">{{$bs->copyright_text}}</textarea>
                  <p id="errcopyright_text" class="em text-danger mb-0"></p>
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
