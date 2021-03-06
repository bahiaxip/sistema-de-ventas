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

	{{ Form::model($vendedor,["route"=>["vendedores.update",$vendedor->id],"method"=> "PUT"]) }}
	@include("vendedores.form")
	{{ Form::close() }}
</div>

@endsection