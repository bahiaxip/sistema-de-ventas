@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-header text-center pt-3 fondo-gris text-white">
				<h5><strong>Detalle de destinatario</strong></h5>
			</div>
			<div class="card-body">
				<div class="row div-show">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Nombre:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->name }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Apellidos:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->surname }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							País:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->country }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Provincia:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->province }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Ciudad:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->city }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Dirección:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->address }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Código Postal:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->postal_code }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							E-Mail:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->email }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Teléfono:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->phone }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Fax:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->fax }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Móvil:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{ $destinatario->cellphone }}
						</span>
					</div>
				</div>				
			</div>
		</div>
	</div>
@endsection