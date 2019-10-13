<?php $sum=0; ?>
<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Total Producto</th>
		</tr>
	</thead>

	<tbody>
		@foreach($productos_factura as $pro)
		<tr>
			<td>{{$pro->productos->id}}</td>
			<td>{{$pro->productos->name}}</td>
			<td>{{$pro->productos->price}}</td>
			<td>{{$pro->cantidad}}</td>
			<td>{{$pro->productos->price*$pro->cantidad}}</td>
		</tr>
		<?php $sum=$sum+$pro->productos->price*$pro->cantidad; ?>
		@endforeach
		<tr>
			<td style="text-align:right" colspan="4">IVA</td>
			<td><?php echo $pro->factura->vat."%"; ?></td>
		</tr>
		<tr>
			<td style="text-align:right" colspan="4"><?php echo "Total"; ?></td>
			<td><?php echo $sum; ?></td>
		</tr>
	</tbody>
</table>