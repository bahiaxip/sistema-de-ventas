@php $sum=0; @endphp
@foreach($productos_factura as $pro)
<tr >
	
	<td>
		{{ Form::number("pro_id",$pro->id_producto,["class"=>"pro_id form-control","readonly"=>true,"data-id"=>$pro->id_producto]) }}
	</td>
	<td>
		<select name="productos" id="productos" class="productos form-control" onchange="editSelectProductos(this)">						
			
			@foreach($productos as $p)
				@if($p->id==$pro->id_producto)
				<option value="{{$p->id}}" selected="selected" data-price="{{$p->price}}">{{$p->name}}</option>
				@else
				<option value="{{$p->id}}" data-price="{{$p->price}}">{{$p->name}}</option>
				@endif				
			@endforeach

		</select>
	</td>				
	<td>
		{{ Form::number("precio",$pro->productos->price,["readonly"=>true,"class"=>"form-control"]) }}
	</td>
	<td>
		{{ Form::number("cantidades",$pro->cantidad,["class"=>"cantidad form-control"]) }}
	</td>
	<td>
		{{Form::number("total",$pro->productos->price*$pro->cantidad,["readonly"=>true,"class"=>"total form-control"])}}
	</td>
	<td>
		<a class="btn btn-danger delete_prod " href="javascript:void(0)" onclick="deleteProd(this,event)"  title="Eliminar">Eliminar</a>
	</td>
	@php

	@endphp
</tr>
<?php 
	$sum=$sum+$pro->productos->price*$pro->cantidad;		
?>
@endforeach
@php
	session()->put(["suma"=>$sum]);
@endphp

