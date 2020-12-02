@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Team Section</h4>
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
        <a href="#">Team Section</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Background Image</div>
        </div>
        <div class="card-body">
          <form class="mb-3 dm-uploader drag-and-drop-zone" enctype="multipart/form-data" action="{{route('admin.team.upload')}}" method="POST">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <div class="form-row">
                  <div class="col-12 mb-2">
                    <label for=""><strong>Background Image **</strong></label>
                  </div>
                  <div class="col-md-6 d-md-block mb-3">
                    @if (file_exists('assets/front/img/team_bg.jpg'))
                      <img src="{{asset('assets/front/img/team_bg.jpg?'.time())}}" alt="..." class="img-thumbnail">
                    @else
                      <img src="{{asset('assets/admin/img/noimage.jpg')}}" alt="..." class="img-thumbnail">
                    @endif
                  </div>
                  <div class="col-md-12">
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
                      <p class="text-warning mb-0">Only jpg, jpeg, png image is allowed.</p>
                      <p class="text-danger mb-0 em" id="errteam_bg"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <div class="card-title">Title & Subtitle</div>
        </div>

        <form class="" action="{{route('admin.teamtext.update')}}" method="post">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Title **</label>
                  <input class="form-control" name="team_section_title" value="{{$bs->team_section_title}}" placeholder="Enter Title">
                  @if ($errors->has('team_section_title'))
                    <p class="mb-0 text-danger">{{$errors->first('team_section_title')}}</p>
                  @endif
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Subtitle **</label>
                  <input class="form-control" name="team_section_subtitle" value="{{$bs->team_section_subtitle}}" placeholder="Enter Subtitle">
                  @if ($errors->has('team_section_subtitle'))
                    <p class="mb-0 text-danger">{{$errors->first('team_section_subtitle')}}</p>
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

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Members</div>
          <a href="{{route('admin.member.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Member</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($members) == 0)
                <h3 class="text-center">NO MEMBER FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Rank</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($members as $key => $member)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td><img src="{{asset('assets/front/img/members/'.$member->image)}}" alt="" width="40"></td>
                          <td>{{$member->name}}</td>
                          <td>{{$member->rank}}</td>
                          <td>
                            <a class="btn btn-secondary btn-sm" href="{{route('admin.member.edit', $member->id)}}">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            Edit
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.member.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="member_id" value="{{$member->id}}">
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
      </div>
    </div>
  </div>
@endsection
