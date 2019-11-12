<table class="table table-bordered ">
			<thead class="table-titulo">
				<th>Nombre</th>
				<th>Apellidos</th>				
				@can("clientes.show")<th class="text-center">Ver</th>@endcan
				@can("clientes.edit")<th class="text-center">Editar</th>@endcan
				@can("clientes.destroy")<th class="text-center">Eliminar</th>@endcan
			</thead>

			<tbody class="table-sistema">
			@if($clientes->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($clientes as $cliente)			
				<tr class="">
					<td>{{ $cliente->name }}</td>
					<td>{{ $cliente->surname }}</td>
					@can("clientes.show")					
					<td class="text-center">
						@if(config('datos.design')=="true")
							<a href="{{ route('clientes.show',$cliente->id) }}" title="Ver">
								<i class="fab fa-sistrix fa-lg"></i>
							</a>				
						@else
							<a href="{{ route('clientes.show',$cliente->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
						@endif
					</td>
					@endcan
					@can("clientes.edit")
					<td class="text-center">
						@if(config('datos.design')=="true")
							<a href="{{ route('clientes.edit',$cliente->id) }}" title="Editar">							
								<i class="far fa-edit fa-lg"></i>
							</a>
						@else						
							<a href="{{ route('clientes.edit',$cliente->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
						@endif
					</td>
					@endcan
					@can("clientes.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["clientes.destroy",$cliente->id],"method"=>"DELETE"]) }}
						@if(config('datos.design')=="true")
							<i class="fas fa-times-circle fa-lg btn-delete-data" title="Eliminar" onclick="deleteData({{$cliente->id}},this,'clientes_destroy',event)"></i>
						@else
							<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" onclick="deleteData({{$cliente->id}},this,'clientes_destroy',event)">Eliminar</button>
						@endif
						{{ Form::close() }}					
					</td>
					@endcan
				</tr>
			@endforeach
			</tbody>		
		</table>
		<div class="">
			{{ $clientes->links("pagination::bootstrap-4") }}
		</div>