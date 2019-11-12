@extends("layout/layout")

@section("content")
	<div class="row">
		<div class="col text-white">
			@if(count($errors))
			<div class="alert alert-success">
	            <ul>
	                @foreach($errors->all() as $error)
	                <li>{{ $error }}</li>                                        
	                @endforeach
	            </ul>
	        </div>
	    	@endif
		{{ Form::open(["route"=>["roles.store"],"method"=>"POST"]) }}
		@include("roles.form")
		{{ Form::close() }}
		</div>
	</div>

@endsection