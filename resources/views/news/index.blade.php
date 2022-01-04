@extends('layout')

@section('title', 'News Management')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">News Management</h4>
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
									<form action="{{ route('news.index') }}" method="GET">
										<div class="card-header">
											<h6 class="card-title">Search</h6>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="searchNewsStatus" class="col-md-2 col-form-label">News Status</label>
												<div class="col-md-4">
													<select class="form-select" name="search_news_status">
														@foreach ($status as $k => $stat)

															@if (isset($search_param['search_news_status']) && $search_param['search_news_status'] == $k)
																<option value="{{ $k }}" selected>{{ $stat }}</option>
															@else
																<option value="{{ $k }}">{{ $stat }}</option>
															@endif														

														@endforeach
													</select>
												</div>
												<label for="searchNewsStatus" class="col-md-2 col-form-label">Topic</label>
												<div class="col-md-4">
													<select class="form-select" name="search_topic" id="search_topic">
														<option value="">All Topic</option>
														@foreach ($topics as $topic)

															@if (isset($search_param['search_topic']) && $search_param['search_topic'] == $topic->id)
																<option value="{{ $topic->id }}" selected>{{ $topic->topic }}</option>
															@else
																<option value="{{ $topic->id }}">{{ $topic->topic }}</option>
															@endif														

														@endforeach
													</select>
												</div>
											</div>
										</div>
										<div class="card-footer" style="text-align: right;">
											<button class="btn btn-primary btn-sm" type="submit"><span class="fas fa-search"></span> Search</button>
											<a href="{{ route('news.index') }}" class="btn btn-danger btn-sm"><span class="fas fa-history"></span> Reset Search</a>
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
											<a href="{{ url('news/create') }}" class="btn btn-primary btn-sm">Add News</a>
										</div>
										<div class="table-responsive">
											<table class="table">
												<thead>
													<th width="5%">No.</th>
													<th width="25%">Topic</th>
													<th width="40%">Title</th>
													<th width="15%">Status</th>
													<th width="15%">Action</th>
												</thead>
												<tbody>
													@foreach ($news as $k => $n)

													<tr>
														<td>{{ $k + 1 }}</td>
														<td>{{ $n->topic }}</td>
														<td>{{ $n->title }}</td>
														<td>{{ $n->status }}</td>
														<td>
															<button class="btn btn-primary btn-sm" title="View"><span class="fas fa-eye"></span></button>
															<a href="{{ route('news.edit', $n->id) }}" class="btn btn-warning btn-sm" title="Edit"><span class="fas fa-pencil-alt"></span></a>
															<button class="btn btn-success btn-sm" title="Publish" data-bs-toggle="modal" data-bs-target="#popupConfirmPublish{{ $n->id }}"><span class="fas fa-share"></span></button>
															<button class="btn btn-danger btn-sm" title="Delete" data-bs-toggle="modal" data-bs-target="#popupConfirmDelete{{ $n->id }}"><span class="fas fa-trash-alt"></span></button>

															<!-- Modals -->

															<!-- Modal Confirmation Delete -->

															<div class="modal fade" id="popupConfirmDelete{{ $n->id }}" tabindex="-1">
															  	<div class="modal-dialog">
															    	<div class="modal-content">
															      		<div class="modal-header">
															        		<h5 class="modal-title">Confirmation</h5>
															        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															      		</div>
															      		<div class="modal-body">
															        		<p>Delete News : <b>{{ $n->title }}</b> ?</p>
															      		</div>
															      		<div class="modal-footer">
															        		<form action="{{ route('news.destroy', $n->id) }}" method="POST">
															        			@csrf
															        			@method('DELETE')
															        			<button type="submit" class="btn btn-primary">Yes</button>
															        			<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
															        		</form>
															      		</div>
															    	</div>
															 	</div>
															</div>

															<!-- Modal Confirmation Publish -->

															<div class="modal fade" id="popupConfirmPublish{{ $n->id }}" tabindex="-1">
															  	<div class="modal-dialog">
															    	<div class="modal-content">
															      		<div class="modal-header">
															        		<h5 class="modal-title">Confirmation</h5>
															        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															      		</div>
															      		<div class="modal-body">
															        		<p>Publish News : <b>{{ $n->title }}</b> ?</p>
															      		</div>
															      		<div class="modal-footer">
															        		<form action="{{ route('news.publish', $n->id) }}" method="POST">
															        			@csrf
															        			@method('PUT')
															        			<button type="submit" class="btn btn-primary">Yes</button>
															        			<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
															        		</form>
															      		</div>
															    	</div>
															 	</div>
															</div>


															<!-- End Modals -->

														</td>
													</tr>

													@endforeach
												</tbody>
											</table>
											<div class="d-flex justify-content-center">
								                {!! $news->links() !!}
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

@endsection