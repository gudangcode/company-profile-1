@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Portfolios</h4>
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
        <a href="#">Portfolio Page</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Portfolios</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Portfolios</div>
          <a href="{{route('admin.portfolio.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Portfolio</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($portfolios) == 0)
                <h3 class="text-center">NO PORTFOLIO FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Featured Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Service</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Submission Date</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($portfolios as $key => $portfolio)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td><img src="{{asset('assets/front/img/portfolios/featured/'.$portfolio->featured_image)}}" width="80"></td>
                          <td>{{strlen($portfolio->title) > 200 ? substr($portfolio->title, 0, 200) . '...' : $portfolio->title}}</td>
                          <td>{{$portfolio->client_name}}</td>
                          <td>
                            @if (!empty($portfolio->service))
                            {{$portfolio->service->title}}
                            @endif
                          </td>
                          <td>{{$portfolio->start_date}}</td>
                          <td>{{$portfolio->submission_date}}</td>
                          <td>
                            <a class="btn btn-secondary btn-sm" href="{{route('admin.portfolio.edit', $portfolio->id)}}">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            Edit
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.portfolio.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="portfolio_id" value="{{$portfolio->id}}">
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
              {{$portfolios->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
