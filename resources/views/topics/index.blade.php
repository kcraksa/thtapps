@extends('layout')

@section('title', 'Topics Management')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6 text-first">
							<h4 class="card-title">Topics Management</h4>
						</div>
						<div class="col-md-6 text-end">
							<a class="btn btn-default" href="{{ url('/') }}">Back to Home</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								@if (session('success'))
									<div class="alert alert-success alert-dismissible fade show" role="alert">
									  	{{ session('success') }}
									  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								@elseif (session('failed'))
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
									  	{{ session('failed') }}
									  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								@endif
								<div class="card">
									<form>
										<div class="card-header">
											<h6 class="card-title">Search</h6>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="searchNewsStatus" class="col-md-2 col-form-label">Topic</label>
												<div class="col-md-10">
													<input type="text" name="search_topic" class="form-control" placeholder="All Topics">
												</div>
											</div>
										</div>
										<div class="card-footer" style="text-align: right;">
											<button class="btn btn-primary btn-sm"><span class="fas fa-search"></span> Search</button>
											<button class="btn btn-danger btn-sm"><span class="fas fa-history"></span> Reset Search</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- table -->
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div style="margin: 10px 0px 10px 0px">
											<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#popupFormAdd">Add Topic</button>
										</div>
										<div class="table-responsive">
											<table class="table">
												<thead>
													<th width="5%">No.</th>
													<th width="85%">Topic</th>
													<th width="10%">Action</th>
												</thead>
												<tbody>
													@foreach ($topics as $k => $topic)

													<tr>
														<td>{{ $k + 1 }}</td>
														<td>{{ $topic->topic }}</td>
														<td>
															<button class="btn btn-warning btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target="#popupFormEdit{{ $topic->id }}"><span class="fas fa-pencil-alt"></span></button>
															<button class="btn btn-danger btn-sm" title="Delete"><span class="fas fa-trash-alt"></span></button>
														</td>
													</tr>

													<!-- Modal Edit -->

													<div class="modal fade" id="popupFormEdit{{ $topic->id }}" tabindex="-1" aria-labelledby="popupFormEdit{{ $topic->id }}Label" aria-hidden="true">
													  	<div class="modal-dialog">
													    	<div class="modal-content">
														      	<div class="modal-header">
														        	<h5 class="modal-title" id="popupFormEdit{{ $topic->id }}Label">Update Data Topic</h5>
														        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														      	</div>
														      	<div class="modal-body">
														        	<form action="{{ route('topics.update', $topic->id) }}" method="POST">
														        		@csrf
														        		@method('PUT')
														        		<input type="hidden" name="id" id="id" value="{{ $topic->id }}">
														        		<div class="mb-3">
														        			<label for="topic" class="form-label">Topic</label>
														        			<input class="form-control" type="text" name="topic" id="topic" required="true" value="{{ $topic->topic }}" />
														        		</div>
														        		<div class="mb-3 text-end">
														        			<button type="submit" class="btn btn-sm btn-primary"><span class="fas fa-save"></span> Update</button>
														        			<button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><span class="fas fa-undo"></span> Cancel</button>
														        		</div>
														        	</form>
														      	</div>
														    </div>
													  	</div>
													</div>

													<!-- End of Modal Edit -->

													@endforeach
												</tbody>
											</table>
											<div class="d-flex justify-content-center">
								                {!! $topics->links() !!}
								            </div> 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="popupFormAdd" tabindex="-1" aria-labelledby="popupFormAddLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="popupFormAddLabel">Add New Topic</h5>
	        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      	</div>
	      	<div class="modal-body">
	        	<form action="{{ route('topics.store') }}" method="POST">
	        		@csrf
	        		<div class="mb-3">
	        			<label for="topic" class="form-label">Topic</label>
	        			<input class="form-control" type="text" name="topic" id="topic" required="true" />
	        		</div>
	        		<div class="mb-3 text-end">
	        			<button type="submit" class="btn btn-sm btn-primary"><span class="fas fa-save"></span> Save</button>
	        			<button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><span class="fas fa-undo"></span> Cancel</button>
	        		</div>
	        	</form>
	      	</div>
	    </div>
  	</div>
</div>

@endsection