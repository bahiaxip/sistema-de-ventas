@extends("layout/layout")

@section("content")

<div class="col mt-3">
		<div class="card border-0">
			<div class="card-header text-center pt-3 fondo-gris text-white">
				<h5><strong>Detalle de producto</strong></h5>
			</div>
			<div class="card-body">
				<div class="row div-show">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Nombre:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$role->name }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Slug:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$role->slug }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Descripción:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$role->description }}
						</span>
					</div>
				</div>												
			</div>
		</div>
	</div>
		
@endsection