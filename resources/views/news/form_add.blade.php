@extends('layout')

@section('title', 'News Management - Add')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">News Management - Form Add</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('news.store') }}" id="form-add-news" method="POST">
						@csrf
						<div class="mb-3">
							<label for="topic_id">Topic</label>
							<select class="form-select" name="topic_id" id="topic_id" required>
								<option value="">-- Select Topic --</option>
								@foreach ($topics as $topic)

								<option value="{{ $topic->id }}">{{ $topic->topic }}</option>

								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<label for="title">Title</label>
							<input type="text" name="title" id="title" class="form-control" required>
						</div>
						<div class="mb-3">
							<label for="content">Content</label>
							<textarea class="form-control ckeditor" id="content" name="content" required></textarea>
						</div>
						<div class="mb-3">
							<label for="tag">Tags</label>
							<input type="text" name="tag" id="tag" class="form-control">
							<div id="tags_container" style="margin-top: 5px"></div>
						</div>
						<div class="mb-3 text-end">
							<button type="submit" class="btn btn-primary" id="btn-save"><span class="fas fa-save"></span> Save</button>
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