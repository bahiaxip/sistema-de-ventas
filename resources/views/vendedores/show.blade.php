@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de vendedor</strong></h5>
			</div>
			<div class="card-body offset-3">
				<p><strong>Nombre:</strong> &nbsp;{{ $vendedor->name }}</p>
				<p><strong>Apellidos:</strong> &nbsp;{{ $vendedor->surname }}</p>
				<p><strong>E-Mail:</strong> &nbsp;{{ $vendedor->email }}</p>
				<p><strong>Teléfono:</strong> &nbsp;{{ $vendedor->phone }}</p>
			</div>
		</div>
	</div>
@endsection