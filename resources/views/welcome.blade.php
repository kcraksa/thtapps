@extends('layout')

@section('title', 'Welcome Page')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Take Home Test App</h1>
			by : Krisna Cipta Raksa
		</div>
	</div>
	<div style="margin: 50px;"></div>
	<div class="row">
		<div class="col-md-12">
			<b>Choose an app :</b>
			<div class="row">
				<div class="col-md-6">
					<a href="{{ url('topics') }}" title="Topics Management">
						<div class="card">
					    	<div class="card-body">
					      		<div class="row">
					      			<div class="col-md-2">
					      				<span class="fas fa-rss-square" style="font-size: 50pt; text-align: center; vertical-align: center;"></span>
					      			</div>
					      			<div class="col-md-10">
					      				<div>
					      					<h5 class="card-title"><b>Topics Management</b></h5>
								      		<p class="card-text">Create, Read, Update and Delete Topic.</p>
					      				</div>
					      			</div>
					      		</div>
					    	</div>
					  	</div>
					</a>
				</div>
				<div class="col-md-6">
					<a href="{{ url('news') }}" title="News Management">
						<div class="card">
					    	<div class="card-body">
					      		<div class="row">
					      			<div class="col-md-2">
					      				<span class="fas fa-newspaper" style="font-size: 50pt; text-align: center; vertical-align: center;"></span>
					      			</div>
					      			<div class="col-md-10">
					      				<div>
					      					<h5 class="card-title"><b>News Management</b></h5>
								      		<p class="card-text">Create, Read, Update and Delete News.</p>
					      				</div>
					      			</div>
					      		</div>
					    	</div>
					  	</div>
					</a>
				</div>
			</div>
		</div>
	</div>	
</div>

@endsection