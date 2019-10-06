@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de destinatario</strong></h5>
			</div>
			<div class="card-body offset-3">
				<p><strong>Nombre:</strong> &nbsp;{{ $destinatario->name }}</p>
				<p><strong>Apellidos:</strong> &nbsp;{{ $destinatario->surname }}</p>
				<p><strong>País:</strong> &nbsp;{{ $destinatario->country }}</p>
				<p><strong>Provincia:</strong> &nbsp;{{ $destinatario->province }}</p>
				<p><strong>Provincia:</strong> &nbsp;{{ $destinatario->city }}</p>
				<p><strong>Dirección:</strong> &nbsp;{{ $destinatario->address }}</p>
				<p><strong>Código Postal:</strong> &nbsp;{{ $destinatario->postal_code }}</p>
				<p><strong>E-Mail:</strong> &nbsp;{{ $destinatario->email }}</p>
				<p><strong>Teléfono:</strong> &nbsp;{{ $destinatario->phone }}</p>
				<p><strong>Fax:</strong> &nbsp;{{ $destinatario->fax }}</p>
				<p><strong>Móvil:</strong> &nbsp;{{$destinatario->cellphone}}</p>
			</div>
		</div>
	</div>
@endsection