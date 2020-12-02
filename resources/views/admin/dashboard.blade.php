@extends('admin.layout')

@section('content')
  <div class="mt-2 mb-4">
    <h2 class="text-white pb-2">Welcome back, {{Auth::guard('admin')->user()->first_name}} {{Auth::guard('admin')->user()->last_name}}!</h2>
  </div>
  <div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="card card-stats card-primary card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-users"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Team Members</p>
								<h4 class="card-title">{{\App\Member::count()}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="card card-stats card-info card-round">
				<div class="card-body">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-interface-6"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Subscribers</p>
								<h4 class="card-title">{{\App\Subscriber::count()}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="card card-stats card-secondary card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-success"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Quotations</p>
								<h4 class="card-title">{{\App\Quote::count()}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="card card-stats card-success card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="flaticon-analytics"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Projects</p>
								<h4 class="card-title">{{\App\Portfolio::count()}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="card card-stats card-warning card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="fab fa-blogger-b"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Blogs</p>
								<h4 class="card-title">{{\App\Blog::count()}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="card card-stats card-danger card-round">
				<div class="card-body ">
					<div class="row">
						<div class="col-5">
							<div class="icon-big text-center">
								<i class="la flaticon-bars-2"></i>
							</div>
						</div>
						<div class="col-7 col-stats">
							<div class="numbers">
								<p class="card-category">Services</p>
								<h4 class="card-title">{{\App\Service::count()}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


  <div class="row">
    <div class="col-lg-6">
      <div class="row row-card-no-pd">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header">
    					<div class="card-head-row">
    						<h4 class="card-title">Recent Quotations</h4>
    					</div>
    					<p class="card-category">
    					Top 10 latest quotation request</p>
    				</div>
    				<div class="card-body">
    					<div class="row">
    						<div class="col-md-12">
    							<div class="table-responsive table-hover table-sales">
    								<table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Country</th>
                          <th>Budget</th>
                          <th>Service</th>
                        </tr>
                      </thead>
    									<tbody>
                        @foreach ($quotes as $key => $quote)
                          <tr>
                            <td>{{$quote->name}}</td>
                            <td>{{$quote->phone}}</td>
                            <td>{{$quote->country}}</td>
                            <td>{{$quote->budget}}</td>
      											<td>
                              @php
                                $services = json_decode($quote->services, true);
                              @endphp
                              @foreach ($services as $key => $service)
                                {{$service}}
                                @if (!$loop->last)
                                  ,
                                @endif
                              @endforeach
                            </td>
      										</tr>
                        @endforeach
    									</tbody>
    								</table>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="col-lg-6">
      <div class="row row-card-no-pd">
    		<div class="col-md-12">
    			<div class="card">
    				<div class="card-header">
    					<div class="card-head-row">
    						<h4 class="card-title">Recent Projecs</h4>
    					</div>
    					<p class="card-category">
    					Top 10 latest submitted projects</p>
    				</div>
    				<div class="card-body">
    					<div class="row">
    						<div class="col-md-12">
    							<div class="table-responsive table-hover table-sales">
    								<table class="table">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Client</th>
                          <th>Architecht</th>
                          <th>Submission Date</th>
                        </tr>
                      </thead>
    									<tbody>
                        @foreach ($portfolios as $key => $portfolio)
                          <tr>
                            <td><img src="{{asset('assets/front/img/portfolios/featured/'.$portfolio->featured_image)}}" width="80" /></td>
                            <td>{{strlen($portfolio->title) > 25 ? substr($portfolio->title, 0, 25) . '...' : $portfolio->title}}</td>
                            <td>{{$portfolio->client_name}}</td>
                            <td>{{$portfolio->start_date}}</td>
      											<td>{{$portfolio->submission_date}}</td>
      										</tr>
                        @endforeach
    									</tbody>
    								</table>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
  </div>

@endsection
