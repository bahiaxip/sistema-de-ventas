@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-header text-center pt-3 fondo-gris text-white">
				<h5><strong>Detalle de venta</strong></h5>
			</div>
			<div class="card-body">
				<div class="row div-show">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							ID:
						</span>
					</div>				

					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{ $venta->id }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Cliente:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{ $venta->cliente->surname }}, {{$venta->cliente->name}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Destinatario:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{ $venta->destinatario->surname}}, {{$venta->destinatario->name}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Vendedor:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{ $venta->vendedor->surname}}, {{$venta->vendedor->name}}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Neto:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{number_format($venta->total,0,",",".")}}€
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Fecha:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{ $venta->date }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Hora:
						</span>
					</div>
					<div class="col-12 text-center col-md-9 pt-1 text-md-left">	
						<span>
							{{ $venta->time }}
						</span>
					</div>
				</div>
				<div class="row div-show pt-3">
					<div class="col-12 pt-2 text-center col-md-3 text-md-left">
						<span class="badge p-2 span-show">
							Facturas:
						</span>
					</div>
					<div class="col-12 pt-0 text-center col-md-9 pt-2 text-md-left">	
						<span>
							<?php
							if($facturas->count()>0){
								?>
								<a href="{{route('facturas.index','venta='.$venta->id)}}" class="btn btn-black" title="Ver Facturas" >Ver Facturas</a>
								<?php					
							}else{
								?>
								<a href="{{ route('facturas.create','venta='.$venta->id) }}" class="btn btn-black" title="Crear Factura">Crear Factura</a>
								<?php
							}
							?>
						</span>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection