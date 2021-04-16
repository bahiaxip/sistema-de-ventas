<table class="table table-bordered ">
	<thead class="table-titulo">
		<th>Nombre</th>
		<th>Apellidos</th>				
		@can("ventas.show")<th class="text-center">Ver</th>@endcan
		@can("ventas.edit")<th class="text-center">Editar</th>@endcan
		@can("ventas.destroy")<th class="text-center">Eliminar</th>@endcan
	</thead>
	<tbody class="table-sistema"> 
	@if($vendedor->count()==0)
		<tr>
			<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
		</tr>
	@endif
	@foreach($vendedor as $ven)
		<tr>
			<td>{{ $ven->name }}</td>
			<td>{{ $ven->surname }}</td>
			@can("vendedores.show")
			<td class="text-center">
				@if(config('datos.design')=="ICONS")
					<a href="{{ route('vendedores.show',$ven->id) }}" title="Ver">
						<i class="fab fa-sistrix fa-lg"></i>
					</a>
				@else
					<a href="{{ route('vendedores.show',$ven->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
				@endif
			</td>
			@endcan
			@can("vendedores.edit")
			<td class="text-center">
				@if(config('datos.design')=="ICONS")
					<a href="{{ route('vendedores.edit',$ven->id) }}" title="Editar">							
						<i class="far fa-edit fa-lg"></i>
					</a>
				@else
					<a href="{{ route('vendedores.edit',$ven->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
				@endif
			</td>
			@endcan
			@can("vendedores.destroy")
			<td class="text-center">
				{{ Form::open(["route"=>["vendedores.destroy",$ven->id],"method"=>"DELETE"]) }}
				@if(config('datos.design')=="ICONS")
					<i class="fas fa-times-circle fa-lg btn-delete-data" title="Eliminar" onclick="deleteData({{$ven->id}},this,'vendedores_destroy',event)"></i>
				@else
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" onclick="deleteData({{$ven->id}},this,'vendedores_destroy',event)" >Eliminar</button>
				@endif
				{{ Form::close() }}
				
			</td>
			@endcan
		</tr>
	@endforeach
	</tbody>		
</table>
<div class="">
	{{ $vendedor->links("pagination::bootstrap-4") }}
</div>