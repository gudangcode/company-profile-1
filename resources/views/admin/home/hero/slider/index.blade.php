@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Sliders</h4>
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
        <a href="#">Hero Section</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Sliders</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Sliders</div>
          <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Slider</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              @if (count($sliders) == 0)
                <h3 class="text-center">NO SLIDER FOUND</h3>
              @else
                <div class="row">
                  @foreach ($sliders as $key => $slider)
                    <div class="col-md-3">
                      <div class="card">
        								<div class="card-body">
                          <img src="{{asset('assets/front/img/sliders/'.$slider->image)}}" alt="" style="width:100%;">
        								</div>
        								<div class="card-footer text-center">
                          <a class="btn btn-secondary btn-sm mr-2" href="{{route('admin.slider.edit', $slider->id)}}">
                          <span class="btn-label">
                            <i class="fas fa-edit"></i>
                          </span>
                          Edit
                          </a>
                          <form class="deleteform d-inline-block" action="{{route('admin.slider.delete')}}" method="post">
                            @csrf
                            <input type="hidden" name="slider_id" value="{{$slider->id}}">
                            <button type="submit" class="btn btn-danger btn-sm deletebtn">
                              <span class="btn-label">
                                <i class="fas fa-trash"></i>
                              </span>
                              Delete
                            </button>
                          </form>
        								</div>
        							</div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Create Slider Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Slider</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.slider.upload')}}" method="POST">
            <div class="form-row px-2">
              <div class="col-12 mb-2">
                <label for=""><strong>Image **</strong></label>
              </div>
              <div class="col-md-12 d-md-block d-sm-none mb-3">
                <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
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
                    <input type="file" title='Click to add Files' name="logo" />
                  </div>
                  <small class="status text-muted">Select a file or drag it over this area..</small>
                  <p class="em text-danger mb-0" id="errslider_image"></p>
                </div>
              </div>
            </div>
          </form>
          <form id="ajaxForm" action="{{route('admin.slider.store')}}" method="post">
            @csrf
            <input type="hidden" id="image" name="slider_image" value="">
            <div class="form-group">
              <label for="">Title **</label>
              <input type="text" class="form-control" name="title" value="" placeholder="Enter Title">
              <p id="errtitle" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Text **</label>
              <input type="text" class="form-control" name="text" value="" placeholder="Enter Text">
              <p id="errtext" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Button Text **</label>
              <input type="text" class="form-control" name="button_text" value="" placeholder="Enter Button Text">
              <p id="errbutton_text" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Button URL **</label>
              <input type="text" class="form-control" name="button_url" value="" placeholder="Enter Button URL">
              <p id="errbutton_url" class="mb-0 text-danger em"></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>
@endsection
