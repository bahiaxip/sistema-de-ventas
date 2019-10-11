@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0">
			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de factura</strong></h5>
			</div>
			<div class="card-body offset-3">
				<p><strong>Factura:</strong> &nbsp;{{ $factura->id }}</p>
				<p><strong>Importe Neto:</strong> &nbsp;{{ $factura->net}}</p>
				<p><strong>IVA:</strong> &nbsp;{{ $factura->vat }}</p>
				<p><strong>Total:</strong> &nbsp;{{number_format($factura->total,0,",",".")}}</p>
				<p><strong>Estado:</strong> &nbsp;{{$factura->state}}</p>
				<p><strong>Orden de compra:</strong> &nbsp;{{$factura->order_buy}}</p>
				<p><strong>Guía de oficina:</strong> &nbsp; {{$factura->office_guide}} </p>
			</div>
		</div>
	</div>
@endsection