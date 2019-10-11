@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de venta</strong></h5>
			</div>
			<div class="card-body offset-3">
				<p><strong>Cliente:</strong> &nbsp;{{ $venta->cliente->surname }}, {{$venta->cliente->name}}</p>
				<p><strong>Destinatario factura:</strong> &nbsp;{{ $venta->destinatario->surname}}, {{$venta->destinatario->name}}</p>
				<p><strong>Vendedor:</strong> &nbsp;{{ $venta->vendedor->surname }}, {{$venta->vendedor->name}}</p>
				<p><strong>Total:</strong> &nbsp;{{number_format($venta->total,0,",",".")}}</p>
				<p><strong>Fecha:</strong> &nbsp;{{$venta->date}}</p>
				<p><strong>Hora:</strong> &nbsp;{{$venta->time}}</p>
				<p><strong>Facturas:</strong> &nbsp; 
				<?php
				if($facturas->count()>0){
					?>
					<a href="{{route('facturas.index','venta='.$venta->id)}}" >Ver Facturas</a>
					<?php					
				}else{
					?>
					<a href="{{ route('facturas.create','venta='.$venta->id) }}">Crear Factura</a>
					<?php
				}
				?>
				</p>
			</div>
		</div>
	</div>
@endsection