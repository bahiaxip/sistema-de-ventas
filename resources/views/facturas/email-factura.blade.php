<p style="font-size:20px">Desde el sistema de ventas le enviamos la factura con ID tal asociado a la venta con ID tal.</p>

<div>
	@if($productos_factura->count()!=0)
<?php $sum=0; ?>
<table style="font-size:20px;width:500px;" class="table table-hover">
	<thead style="background:rgba(255,140,0,1);
	color:#FFF;">
		<tr >
			<th style="padding:10px" >ID</th>
			<th >Producto</th>
			<th >Precio</th>
			<th >Cantidad</th>
			<th >Total Producto</th>
		</tr>
	</thead>

	<tbody style="background-color:#EEE9E9;text-align:center">
		@foreach($productos_factura as $pro)
		<tr>
			<td style="padding:10px">{{$pro->productos->id}}</td>
			<td>{{$pro->productos->name}}</td>
			<td>{{$pro->productos->price}}</td>
			<td>{{$pro->cantidad}}</td>
			<td>{{$pro->productos->price*$pro->cantidad}}</td>
		</tr>
		<?php 
		$sum=$sum+$pro->productos->price*$pro->cantidad;		
		?>
		@endforeach
		@php
		$total_sum=$sum *((100+$pro->factura->vat)/100);
		@endphp
		<tr>
			<td style="text-align:right;padding:10px" colspan="4">Total Neto</td>
			<td class="suma"><?php echo number_format($sum,0,",","."); ?></td>
		</tr>
		<tr>
			<td style="text-align:right;padding:10px" colspan="4">IVA</td>
			<td><?php echo $productos_factura[0]->factura->vat."%"; ?></td>
		</tr>
		<tr>
			<td style="text-align:right;padding:10px" colspan="4"><?php echo "Total"; ?></td>
			@php
			session()->put(["suma"=>$sum]);
			@endphp

			<td><?php echo number_format($total_sum,0,",","."); ?>€</td>
		</tr>
	</tbody>
</table>
@endif
</div>

