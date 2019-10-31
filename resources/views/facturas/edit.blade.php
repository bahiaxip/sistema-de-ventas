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

	{{ Form::model($factura,["route"=>["facturas.update",$factura->id],"method"=> "PUT"]) }}
    <!-- booleano para campo IVA, determina el input iva para edit para create -->
	@include("facturas.form",["iva"=>false])
	{{ Form::close() }}
    
</div>

@endsection
