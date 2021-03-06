@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Productos</h5>
				@can("productos.create")
				<a href="{{route('productos.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>
		<div class="productos_table">
			@include("productos.table_productos")
		</div>
	</div>

@endsection