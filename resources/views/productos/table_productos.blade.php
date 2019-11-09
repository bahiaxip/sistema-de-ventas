<table class="table table-bordered">
			<thead class="table-titulo">
				<th>Nombre</th>
				<th>Categoría</th>
				@can("productos.show")<th class="text-center">Ver</th>@endcan
				@can("productos.edit")<th class="text-center">Editar</th>@endcan
				@can("productos.destroy")<th class="text-center">Eliminar</th>@endcan
			</thead>
			<tbody class="table-sistema">
			@if($productos->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($productos as $pro)
				<tr class="">
					<td>{{ $pro->name }}</td>
					<td>{{ $pro->category->name }}</td>
					@can("productos.show")			
					<td class="text-center">
						<a href="{{ route('productos.show',$pro->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
					</td>
					@endcan
					@can("productos.edit")
					<td class="text-center">
						<a href="{{ route('productos.edit',$pro->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("productos.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["productos.destroy",$pro->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm " onclick="deleteData({{$pro->id}},this,'productos_destroy',event)">Eliminar</button>
						{{ Form::close() }}					
					</td>
					@endcan
				</tr>
			@endforeach
			</tbody>			
		</table>
		<div class="">
			{{ $productos->links("pagination::bootstrap-4") }}
		</div>