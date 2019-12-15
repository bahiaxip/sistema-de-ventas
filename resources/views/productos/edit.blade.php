@extends("layout/layout")

@section("content")

<div class="col col-xl-10 formstyle">
	@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>                                        
                @endforeach
            </ul>
        </div>
    @endif

	{{ Form::model($producto,["route"=>["productos.update",$producto->id],"method"=> "PUT"]) }}
	@include("productos.form")
	{{ Form::close() }}
</div>

@endsection