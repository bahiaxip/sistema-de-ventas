@extends("layout/layout")

@section("content")

<div class="col-auto col-lg-10">
	@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>                                        
                @endforeach
            </ul>
        </div>
    @endif

	{{ Form::model($cliente,["route"=>["clientes.update",$cliente->id],"method"=> "PUT","files"=>true]) }}
	@include("clientes.form")
	{{ Form::close() }}
</div>

@endsection