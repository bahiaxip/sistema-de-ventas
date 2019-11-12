@extends("layout/layout")

@section("content")
	<div class="row">
		<div class="col col-auto text-white">

			@if(count($errors))
			<div class="alert alert-success">
	            <ul>
	                @foreach($errors->all() as $error)
	                <li>{{ $error }}</li>                                        
	                @endforeach
	            </ul>
	        </div>
	    	@endif

			{{ Form::model($role,["route"=>["roles.update",$role->id],"method"=>"PUT"]) }}
				@include("roles.form")
			{{ Form::close() }}
		</div>
	</div>
@endsection