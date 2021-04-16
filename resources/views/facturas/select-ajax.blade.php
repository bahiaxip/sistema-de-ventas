@if(empty($productos))
	<option value="0">Seleccione producto</option>
	@foreach($total_productos as $prod)
		<option value="{{$prod->id}}" data-price="{{$prod->price}}">{{$prod->name}}</option>
	@endforeach
@elseif($productos=="[]")
	<option>No existen resultados</option>
@elseif(!empty($productos))
	<option value="0">Seleccione producto</option>
	
	@foreach($productos as $pro)
		<option value="{{$pro->id}}" data-price="{{$pro->price}}">{{$pro->name}}</option>
	@endforeach
@endif