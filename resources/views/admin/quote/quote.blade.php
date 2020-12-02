@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Quotes</h4>
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
        <a href="#">Quote Management</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Quotes</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Quotes</div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($quotes) == 0)
                <h3 class="text-center">NO BUDGET FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Skype / Whatsapp</th>
                        <th scope="col">Services</th>
                        <th scope="col">Description</th>
                        <th scope="col">NDA</th>
                        <th scope="col">Request Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($quotes as $key => $quote)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$quote->name}}</td>
                          <td>{{$quote->email}}</td>
                          <td>{{$quote->phone}}</td>
                          <td>{{$quote->country}}</td>
                          <td>{{$quote->budget}}</td>
                          <td>{{$quote->skype_whatsapp}}</td>
                          <td>
                            <button class="btn btn-default" data-toggle="modal" data-target="#servicesModal{{$quote->id}}">
                              <span class="btn-label">
                                <i class="fa fa-eye"></i>
                              </span>
                              View
                            </button>
                          </td>
                          <td>
                            <button class="btn btn-default" data-toggle="modal" data-target="#descriptionModal{{$quote->id}}">
                              <span class="btn-label">
                                <i class="fa fa-eye"></i>
                              </span>
                              View
                            </button>
                          </td>
                          <td>
                            <a class="btn btn-default" href="{{asset('assets/front/ndas/'.$quote->nda)}}" target="_blank">
                              <span class="btn-label">
                                <i class="fa fa-eye"></i>
                              </span>
                              View
                            </a>
                          </td>
                          <td>{{$quote->created_at}}</td>
                        </tr>

                        <!-- Services Modal -->
                        <div class="modal fade" id="servicesModal{{$quote->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Services</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                @php
                                  $servicearr = json_decode($quote->services, true);
                                @endphp
                                <ol>
                                  @foreach ($servicearr as $key => $servele)
                                    <li>{{$servele}}</li>
                                  @endforeach
                                </ol>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Description Modal -->
                        <div class="modal fade" id="descriptionModal{{$quote->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Description</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                @php
                                  echo nl2br($quote->description);
                                @endphp
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
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
              {{$quotes->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection
