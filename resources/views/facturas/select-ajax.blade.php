@if(empty($productos) || $productos==0)
	<option>No existen resultados</option>
@elseif(!empty($productos))
	<option value="0">Seleccione producto</option>
	@foreach($productos as $producto=>$value)
		<option value="{{$producto}}">{{$value}}</option>
	@endforeach
@endif