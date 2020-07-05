<table class="table table-bordered">
	<thead class="table-titulo">
		<th>Importe Neto</th>
		<th>IVA</th>				
		@can("ventas.show")<th class="text-center">Ver</th>@endcan
		@can("ventas.edit")<th class="text-center">Editar</th>@endcan
		@can("ventas.destroy")<th class="text-center">Eliminar</th>@endcan
	</thead>
	<tbody class="table-sistema">
	@if($facturas->count()==0)
		<tr>
			<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
		</tr>
	@endif
	@foreach($facturas as $factura)
		<tr class="">
			<td>{{ $factura->net}}</td>
			<td>{{ $factura->vat }}</td>
			@can("ventas.show")				
			<td class="text-center">
				<a href="{{ route('facturas.show',$factura->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
			</td>
			@endcan
			@can("ventas.edit")
			<td class="text-center">
				<a href="{{ route('facturas.edit',$factura->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
			</td>
			@endcan
			@can("ventas.destroy")
			<td class="text-center">
				{{ Form::open(["route"=>["facturas.destroy",$factura->id],"method"=>"DELETE"]) }}
				<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" onclick="deleteData({{$factura->id}},this,'facturas_destroy',event)">Eliminar</button>
				{{ Form::close() }}
			</td>
			@endcan
		</tr>
	@endforeach
	</tbody>		
</table>
<div class="">
	{{ $facturas->appends(["venta"=>$venta->id])->links("pagination::bootstrap-4") }}
</div>