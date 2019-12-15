<table class="table table-bordered ">
	<thead class="table-titulo ">
		<th>Nombre</th>
		<th>Apellidos</th>				
		@can("ventas.show")<th class="text-center">Ver</th>@endcan
		@can("ventas.edit")<th class="text-center">Editar</th>@endcan
		@can("ventas.destroy")<th class="text-center">Eliminar</th>@endcan
	</thead>
	<tbody class="table-sistema">
	@if($supervisor->count()==0)
		<tr>
			<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
		</tr>
	@endif
	@foreach($supervisor as $sup)
		<tr class="">
			<td>{{ $sup->name }}</td>
			<td>{{ $sup->surname }}</td>
			@can("supervisores.show")
			<td class="text-center">
			@if(config('datos.design')=="ICONS")
				<a href="{{ route('supervisores.show',$sup->id) }}" title="Ver">
					<i class="fab fa-sistrix fa-lg"></i>
				</a>				
			@else
				<a href="{{ route('supervisores.show',$sup->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
			@endif
			</td>
			@endcan
			@can("supervisores.edit")
			<td class="text-center">
			@if(config('datos.design')=="ICONS")
				<a href="{{ route('supervisores.edit',$sup->id) }}" title="Editar">							
					<i class="far fa-edit fa-lg"></i>
				</a>
			@else
				<a href="{{ route('supervisores.edit',$sup->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
			@endif
			</td>
			@endcan
			@can("supervisores.destroy")
			<td class="text-center">
				{{ Form::open(["route"=>["supervisores.destroy",$sup->id],"method"=>"DELETE"]) }}
				@if(config('datos.design')=="ICONS")
					<i class="fas fa-times-circle fa-lg btn-delete-data" title="Eliminar" onclick="deleteData({{$sup->id}},this,'supervisores_destroy',event)"></i>
				@else
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" onclick="deleteData({{$sup->id}},this,'supervisores_destroy',event)" >Eliminar</button>
				@endif
				{{ Form::close() }}
				
			</td>
			@endcan
		</tr>
	@endforeach
	</tbody>		
</table>
<div class="">
	{{ $supervisor->links("pagination::bootstrap-4") }}
</div>