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
    <div class="container info-factura" style="display:none">
        <div class="alert alert-danger text-center info-factura-body">            
        </div>
    </div>
	{{ Form::model($factura,["route"=>["facturas.update",$factura->id],"method"=> "PUT"]) }}
    <!-- booleano para campo IVA, determina el input iva para edit y para create -->
	@include("facturas.form",["iva"=>false])
	{{ Form::close() }}    
</div>

@endsection
