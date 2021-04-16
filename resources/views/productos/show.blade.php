@extends("layout.layout")

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
							{{$producto->name}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Categoría:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$producto->category->name}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Modelo:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$producto->product_model}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Marca:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$producto->brand}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2">
							Precio:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$producto->price}}
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
							{{$producto->description}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge span-show p-2" >
							Stock:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{$producto->stock}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-1">
					<div class="col-12 text-center col-md-3 text-md-left pt-2">
						<span class="badge span-show p-2">
							Código:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 text-md-left pt-2">
						<span>
							{{--{!! DNS1D::getBarcodeHTML($producto->code,"C128",3,33,"black") !!}--}}
							{!! DNS1D::getBarcodeHTML($producto->code,"C128",2,33,"black") !!}
						</span>
					</div>
				</div>								
			</div>
		</div>
	</div>
@endsection