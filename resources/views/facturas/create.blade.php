@extends("layout/layout")

@section("content")
	<div class="col col-lg-10">
		@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>                                        
                @endforeach
            </ul>
        </div>
        @endif
		{{ Form::open(["route"=> "facturas.store","files"=>true])}}
			@include("facturas.form")
		{{ Form::close()}}
	</div>
	
@endsection