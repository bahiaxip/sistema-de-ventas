@extends("layout/layout")

@section("content")


	<div class="col-auto col-lg-10 text-white">

		{{ Form::model($user,["route"=>["users.update",$user->id],"method"=>"PUT"]) }}
		@include("users.form")
		{{ Form::close() }}
	</div>
	


@endsection