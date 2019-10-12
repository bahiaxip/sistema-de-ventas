<div class="form-group">
	{{ Form::label("vat","Importe IVA") }}
	{{ Form::text("vat",21,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("total","Importe Total") }}
	{{ Form::text("total",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("state","Estado de pago") }}
</div>
<div class="form-group">
	<label>{{ Form::radio("state","PAID",["class"=>"form-control"]) }}Pago efectuado</label>
	<label>{{ Form::radio("state","DUE",["class"=>"form-control"]) }}Pago pendiente</label>
</div>
<div class="form-group">
	{{ Form::label("order_buy","Orden de compra") }}
	{{ Form::text("order_buy",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("office_guide","Guía de oficina") }}
	{{ Form::text("office_guide",null,["class"=>"form-control"]) }}
</div>
	@if(isset($venta_id))
		{{ Form::hidden("venta_id",$venta_id) }}
	@endif

{{ Form::submit("Guardar",["class"=>"btn btn-primary"]) }}
