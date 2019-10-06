@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de producto</strong></h5>
			</div>
			<div class="card-body offset-3">
				<p><strong>Nombre:</strong> &nbsp;{{ $producto->name }}</p>
				<p><strong>Modelo:</strong> &nbsp;{{ $producto->model }}</p>
				<p><strong>Precio:</strong> &nbsp;{{ $producto->price }}</p>
				<p><strong>Descripción:</strong> &nbsp;{{ $producto->description }}</p>
				<p><strong>Stock:</strong> &nbsp;{{ $producto->stock }}</p>				
			</div>
		</div>
	</div>
@endsection