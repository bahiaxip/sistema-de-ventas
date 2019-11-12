<table class="table table-bordered ">
	<thead class="table-titulo">
		<th>Venta</th>
		<th>Cliente</th>
		<th>Vendedor</th>				
		@can("ventas.show")<th class="text-center">Ver</th>@endcan
		@can("ventas.edit")<th class="text-center">Editar</th>@endcan
		@can("ventas.destroy")<th class="text-center">Eliminar</th>@endcan
	</thead>
	<tbody class="table-sistema">		
	@if($ventas->count()==0)			
		<tr>
			<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
		</tr>
	@endif
	@foreach($ventas as $venta)
		<tr class="">
			<td>{{ $venta->id }}</td>
			<td>{{ $venta->cliente->name}} {{$venta->cliente->surname }}</td>
			<td>{{ $venta->vendedor->name }}</td>
			@can("ventas.show")
			<td class="text-center">
				@if(config('datos.design')=="true")
				<a href="{{ route('ventas.show',$venta->id) }}" title="Ver">
					<i class="fab fa-sistrix fa-lg"></i>
				</a>
				@else
				<a href="{{ route('ventas.show',$venta->id) }}" title="Ver" class="btn btn-outline-info btn-sm">
					Ver
				</a>
				@endif
			</td>
			@endcan
			@can("ventas.edit")
			<td class="text-center">
				@if(config('datos.design')=="true")
				<a href="{{ route('ventas.edit',$venta->id) }}" title="Editar">							
					<i class="far fa-edit fa-lg"></i>
				</a>
				@else
				<a href="{{ route('ventas.edit',$venta->id) }}" title="Editar {{$venta->id}}" class="btn btn-outline-success btn-sm">
					Editar
				</a>							
				@endif
			</td>
			@endcan
			@can("ventas.destroy")
			<td class="text-center">						
				{{ Form::open(["route"=>["ventas.destroy",$venta->id],"method"=>"DELETE"]) }}
				@if(config('datos.design')=="true")
					<i class="fas fa-times-circle fa-lg btn-delete-data" title="Eliminar" onclick="deleteData({{$venta->id}},this,'ventas_destroy',event)"></i>
				@else
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" onclick="deleteData({{$venta->id}},this,'ventas_destroy',event)" >Eliminar</button>
				@endif
				{{ Form::close() }}					
			</td>
			@endcan
		</tr>
	@endforeach
	</tbody>	
</table>
<div class="">
	{{ $ventas->links("pagination::bootstrap-4") }}
</div>