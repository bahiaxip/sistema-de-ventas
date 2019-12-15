@extends("layout/layout")

@section("content")


	<div class="col-auto col-lg-10 text-white">
		@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>                                        
                @endforeach
            </ul>
        </div>
    	@endif
    	
		{{ Form::model($user,["route"=>["users.update",$user->id],"method"=>"PUT"]) }}
		@include("users.form")
		{{ Form::close() }}
	</div>
	


@endsection