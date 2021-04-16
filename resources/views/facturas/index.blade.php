@extends("layout/layout")

@section("content")
	
<div class="col mt-3">
	<div class="card pl-2 pr-2 pt-2 border-0">			
		<div class="card-title">
			<h5 class="float-left">Facturas de Venta {{ $venta->id }} asociadas a {{$venta->cliente->name}} </h5>
			@can("ventas.create")
			<a href="{{route('facturas.create','venta='.$venta->id) }}" class="btn btn-sm btn-black float-right">Crear</a>
			@endcan
		</div>
	</div>		
	<div class="facturas_table">
		@include("facturas.table_facturas")
	</div>
</div>

@endsection