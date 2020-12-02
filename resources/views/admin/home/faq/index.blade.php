@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Faqs</h4>
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
        <a href="#">Faqs</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">Faqs</div>
          <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Faq</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              @if (count($faqs) == 0)
                <h3 class="text-center">NO FAQ FOUND</h3>
              @else
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($faqs as $key => $faq)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{strlen($faq->question) > 50 ? substr($faq->question, 0, 50) . '...' : $faq->question}}</td>
                          <td>{{strlen($faq->answer) > 80 ? substr($faq->answer, 0, 80) . '...' : $faq->answer}}</td>
                          <td>
                            <a class="btn btn-secondary btn-sm editbtn" href="#editModal" data-toggle="modal" data-faq_id="{{$faq->id}}" data-question="{{$faq->question}}" data-answer="{{$faq->answer}}">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              Edit
                            </a>
                            <form class="deleteform d-inline-block" action="{{route('admin.faq.delete')}}" method="post">
                              @csrf
                              <input type="hidden" name="faq_id" value="{{$faq->id}}">
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


  <!-- Create Faq Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Faq</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxForm" class="" action="{{route('admin.faq.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="">Question **</label>
              <input type="text" class="form-control" name="question" value="" placeholder="Enter question">
              <p id="errquestion" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Answer **</label>
              <textarea class="form-control" name="answer" rows="5" cols="80" placeholder="Enter answer"></textarea>
              <p id="errtitle" class="mb-0 text-danger em"></p>
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

  <!-- Edit Faq Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Faq</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="ajaxEditForm" class="" action="{{route('admin.faq.update')}}" method="POST">
            @csrf
            <input id="infaq_id" type="hidden" name="faq_id" value="">
            <div class="form-group">
              <label for="">Question **</label>
              <input id="inquestion" type="text" class="form-control" name="question" value="" placeholder="Enter question">
              <p id="eerrquestion" class="mb-0 text-danger em"></p>
            </div>
            <div class="form-group">
              <label for="">Answer **</label>
              <textarea id="inanswer" class="form-control" name="answer" rows="5" cols="80" placeholder="Enter answer"></textarea>
              <p id="eerranswer" class="mb-0 text-danger em"></p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="updateBtn" type="button" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
