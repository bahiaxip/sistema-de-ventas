@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-header text-center fondo-gris pt-3 text-white">
				<h5><strong>Detalle de vendedor</strong></h5>
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
							{{$vendedor->name}}
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
							{{$vendedor->surname}}
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
							{{$vendedor->email}}
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
							{{$vendedor->phone}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Supervisor:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$vendedor->supervisor->name}}
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection