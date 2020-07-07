@if($productos_factura->count()!=0)
<?php $sum=0; ?>
<table style="" class="table table-hover">
	<thead style="background-color:#EE7600;
	color:#FFF;">
		<tr >
			<th >ID</th>
			<th >Producto</th>
			<th >Precio</th>
			<th >Cantidad</th>
			<th >Total Producto</th>
		</tr>
	</thead>

	<tbody style="background-color:#EEE9E9">
		@foreach($productos_factura as $pro)
		<tr>
			<td>{{$pro->productos->id}}</td>
			<td>{{$pro->productos->name}}</td>
			<td>{{number_format($pro->productos->price,2,",",".")}}</td>
			<td>{{$pro->cantidad}}</td>
			<td>{{number_format($pro->productos->price*$pro->cantidad,2,",",".")}}</td>
		</tr>
		<?php 
		$sum=$sum+$pro->productos->price*$pro->cantidad;		
		?>
		@endforeach
		@php
		$total_sum=$sum *((100+$pro->factura->vat)/100);
		@endphp
		<tr>
			<td style="text-align:right" colspan="4">Total Neto</td>
			<td class="suma"><?php echo number_format($sum,2,",","."); ?></td>
			<!--<td class="suma"><?php echo $sum; ?></td>-->
		</tr>
		<tr>
			<td style="text-align:right" colspan="4">IVA</td>
			<td><?php echo $productos_factura[0]->factura->vat."%"; ?></td>
		</tr>
		<tr>
			<td style="text-align:right" colspan="4"><?php echo "Total"; ?></td>
			@php
			session()->put(["suma"=>$sum]);
			@endphp

			<td><?php echo number_format($total_sum,2,",","."); ?>€</td>
			<!--<td><?php echo $total_sum;?>€</td>-->
		</tr>
	</tbody>
</table>
@endif