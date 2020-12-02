@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Services</h4>
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
        <a href="#">Service Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Services</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Services</div>
          <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Service</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($services) == 0)
                <h3 class="text-center">NO SERVICE FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($services as $key => $service)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td><img src="{{asset('assets/front/img/services/'.$service->main_image)}}" alt="" width="70"></td>
                          <td>{{strlen($service->title) > 100 ? substr($service->title, 0, 100) . '...' : $service->title}}</td>
                          <td>{{$service->scategory->name}}</td>
                          <td>
                            <a class="btn btn-secondary btn-sm" href="{{route('admin.service.edit', $service->id)}}">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            Edit
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.service.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="service_id" value="{{$service->id}}">
                              <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                Delete
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              {{$services->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Create Service Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.service.upload')}}" method="POST">
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
                    <input type="file" title='Click to add Files' />
                  </div>
                  <small class="status text-muted">Select a file or drag it over this area..</small>
                  <p class="em text-danger mb-0" id="errservice_image"></p>
                </div>
              </div>
            </div>
          </form>

          <form id="ajaxForm" class="" action="{{route('admin.service.store')}}" method="POST">
            @csrf
            <input type="hidden" id="image" name="" value="">
            <div class="form-group">
              <label for="">Title **</label>
              <input type="text" class="form-control" name="title" placeholder="Enter title" value="">
              <p id="errtitle" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Category **</label>
              <select class="form-control" name="category">
                <option value="" selected disabled>Select a category</option>
                @foreach ($scats as $key => $scat)
                  <option value="{{$scat->id}}">{{$scat->name}}</option>
                @endforeach
              </select>
              <p id="errcategory" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Content **</label>
              <textarea id="nicContent" class="form-control nic-edit" name="content" rows="8" cols="80" placeholder="Enter content"></textarea>
              <p id="errcontent" class="mb-0 text-danger em"></p>
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
