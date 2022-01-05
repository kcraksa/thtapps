@extends('layout')

@section('title', 'News Management - View')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">News Management - Form View</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('news.update', $news->id) }}" id="form-add-news" method="POST">
						@csrf
						@method('PUT')
						<div class="mb-3">
							<label for="topic_id">Topic</label>
							<select class="form-select" name="topics_id" id="topics_id" required disabled>
								<option value="">-- Select Topic --</option>
								@foreach ($topics as $topic)

									@if ($topic->id == $news->topics_id)
										<option value="{{ $topic->id }}" selected>{{ $topic->topic }}</option>
									@else
										<option value="{{ $topic->id }}">{{ $topic->topic }}</option>
									@endif

								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<label for="title">Title</label>
							<input type="text" name="title" id="title" class="form-control" required value="{{ $news->title }}" disabled>
						</div>
						<div class="mb-3">
							<label for="content">Content</label>
							<textarea class="form-control ckeditor" id="content" name="content" required disabled>{{ $news->content }}</textarea>
						</div>
						<div class="mb-3">
							<label for="tag">Tags</label>
							<input type="text" name="tag" id="tag" class="form-control" placeholder="Enter to add a tag" disabled>
							<div id="tags_container" style="margin-top: 5px">
								@foreach ($tags as $tag)

								<div style="margin: 2px; display: inline-block">
									<input type="hidden" name="tags[]" value="{{ $tag->tag }}">
									<span class="badge bg-info text-dark">{{ $tag->tag }} <span title="Remove Tag" style="cursor: pointer" onclick="remove_tag(this)">x</span></span></div>

								@endforeach
							</div>
						</div>
						<div class="mb-3 text-end">
							<a href="{{ url('news') }}" type="button" class="btn btn-danger"><span class="fas fa-undo"></span> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('javascript')

<script>
	$(document).ready(function () {
		$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      	event.preventDefault();
		      	return false;
		    }
		});

		$('#tag').keyup(function (e) {
			e.preventDefault();
			if(e.keyCode == 13) {
				var tag = $(this).val();
				var field_tag = '<div style="margin: 2px; display: inline-block"><input type="hidden" name="tags[]" value="'+tag+'">';
				field_tag += '<span class="badge bg-info text-dark">'+tag+' <span title="Remove Tag" style="cursor: pointer" onclick="remove_tag(this)">x</span></span></div>';

				$('#tag').val('');
				$('#tags_container').append(field_tag);
			}
		})
	})

	function remove_tag(el) {
		$(el).closest('div').remove()
	}
</script>

@endsection