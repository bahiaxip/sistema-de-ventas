@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Ventas</h5>
				@can("ventas.create")
				<a href="{{route('ventas.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>		
		<div class="ventas_table">
			@include("ventas.table_ventas")
		</div>
	</div>

@endsection