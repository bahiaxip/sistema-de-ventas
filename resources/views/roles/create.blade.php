@extends("layout/layout")

@section("content")
	<div class="row">
		<div class="col">
		{{ Form::open(["route"=>["roles.store"],"method"=>"POST"]) }}
		@include("roles.form")
		{{ Form::close() }}
		</div>
	</div>

@endsection