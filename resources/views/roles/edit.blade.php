@extends("layout/layout")

@section("content")
	<div class="row">
		<div class="col col-auto">
			{{ Form::model($role,["route"=>["roles.update",$role->id],"method"=>"PUT"]) }}
				@include("roles.form")
			{{ Form::close() }}
		</div>
	</div>
@endsection