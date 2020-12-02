@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Features</h4>
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
        <a href="#">Features</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="{{route('admin.feature.update')}}" method="post">
          <div class="card-header">
            <div class="card-title d-inline-block">Edit Feature</div>
            <a class="btn btn-info btn-sm float-right d-inline-block" href="{{route('admin.feature.index')}}">
							<span class="btn-label">
								<i class="fas fa-backward" style="font-size: 12px;"></i>
							</span>
							Back
						</a>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                  @csrf
                  <input type="hidden" name="feature_id" value="{{$feature->id}}">
                  <div class="form-group">
                    <label for="">Icon **</label>
                    <div class="btn-group d-block">
                        <button type="button" class="btn btn-primary iconpicker-component"><i class="{{$feature->icon}}"></i></button>
                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                data-selected="fa-car" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu"></div>
                    </div>
                    <input id="inputIcon" type="hidden" name="icon" value="{{$feature->icon}}">
                    @if ($errors->has('icon'))
                      <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                    @endif
                    <div class="mt-2">
                      <small>NB: click on the dropdown sign to select an icon.</small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Title **</label>
                    <input class="form-control" name="title" placeholder="Enter title" value="{{$feature->title}}">
                    @if ($errors->has('title'))
                      <p class="mb-0 text-danger">{{$errors->first('title')}}</p>
                    @endif
                  </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection


@section('scripts')
  <script>
    $(document).ready(function() {
      $('.icp').on('iconpickerSelected', function(event){
        $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
      });
    });
  </script>
@endsection
