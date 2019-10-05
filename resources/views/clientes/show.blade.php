@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de cliente</strong></h5>
			</div>
			<div class="card-body offset-3">
				<p><strong>Nombre:</strong> &nbsp;{{ $cliente->name }}</p>
				<p><strong>Apellidos:</strong> &nbsp;{{ $cliente->surname }}</p>
				<p><strong>Dirección:</strong> &nbsp;{{ $cliente->address }}</p>
				<p><strong>Provincia:</strong> &nbsp;{{ $cliente->province }}</p>
				<p><strong>País:</strong> &nbsp;{{ $cliente->country }}</p>
				<p><strong>Código Postal:</strong> &nbsp;{{ $cliente->postal_code }}</p>
				@if($cliente->logo)
					<label for="logo"><strong>Logo:</strong></label><br>
					<img name="logo" id="logo" src="{{asset( './'.$cliente->logo) }}" width="100">
				@endif
				<p><strong>E-Mail:</strong> &nbsp;{{ $cliente->email }}</p>
				<p><strong>Teléfono:</strong> &nbsp;{{ $cliente->phone }}</p>
				<p><strong>Fax:</strong> &nbsp;{{ $cliente->fax }}</p>
				<p><strong>Móvil:</strong> &nbsp;{{$cliente->cellphone}}</p>
			</div>
		</div>
	</div>
@endsection