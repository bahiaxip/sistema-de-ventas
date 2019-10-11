<div class="form-group">
	{{ Form::label("id_cliente","Cliente") }}
	<select name="id_cliente" class="form-control">
		@php
		if(isset($venta)){
		@endphp
			<option value="{{$venta->id_cliente}}">{{$venta->cliente->surname}}, {{$venta->cliente->name}}</option>
		@php
		}else
		{
		@endphp
			<option value="0">Seleccione...</option>	
		@php
		}
		@endphp
		
		@foreach($clientes as $cliente)

			<option value="{{$cliente->id}}">{{$cliente->surname}}, {{$cliente->name}}</option>
		@endforeach

	</select>
</div>
<div class="form-group">
	{{ Form::label("id_factura","Factura")}}
	<select name="id_factura" class="form-control">
		@php
		
		@endphp
		<option value="0">Seleccione...</option>
		@foreach($facturas as $factura)
		<option value="{{$factura->id}}">{{$factura->id_destinatario_factura}}</option>
		@endforeach
	</select>
</div>
<div class="form-group">
	{{ Form::label("id_vendedor","Vendedor")}}
	<select name="id_vendedor" class="form-control">
		@php
		if(isset($venta)){
		@endphp
			<option value="{{$venta->id_vendedor}}">{{$venta->vendedor->surname}}, {{$venta->vendedor->name}}</option>
		@php
		}else{
		@endphp
			<option value="0">Seleccione...</option>
		@php
		}
		@endphp
		@foreach($vendedores as $vendedor)
		<option value="{{$vendedor->id}}">{{$vendedor->surname}}, {{$vendedor->name}}</option>
		@endforeach
	</select>
</div>
<div class="form-group">
	{{ Form::label("total","Total") }}
	{{ Form::text("total",null,["class"=>"form-control"])}}
</div>
{{ Form::submit("Guardar",["class"=>"btn btn-primary"]) }}