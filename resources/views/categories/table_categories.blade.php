<table class="table table-bordered">
	<thead class="table-titulo">
		<th>Nombre</th>	
		@can("categories.edit")			
			<th class="text-center">Editar</th>
		@endcan
		@can("categories.destroy")
			<th class="text-center">Eliminar</th>
		@endcan
	</thead>
	<tbody class="table-sistema">
	@if($categories->count()==0)
		<tr>
			<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
		</tr>
	@endif
	@foreach($categories as $cat)
		<tr class="">
			<td>{{ $cat->name }}</td>
			@can("categories.edit")
			<td class="text-center">
			@if(config('datos.design')=="true")
				<a href="{{ route('categories.edit',$cat->id) }}" title="Editar">
					<i class="far fa-edit fa-lg"></i>
				</a>
			@else
				<a href="{{ route('categories.edit',$cat->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
			@endif
			</td>
			@endcan
			@can("categories.destroy")
			<td class="text-center">
				{{ Form::open(["route"=>["categories.destroy",$cat->id],"method"=>"DELETE"]) }}
				@if(config('datos.design')=="true")
					<i class="fas fa-times-circle fa-lg btn-delete-data" title="Eliminar" onclick="deleteData({{$cat->id}},this,'categories_destroy',event)"></i>
				@else
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" onclick="deleteData({{$cat->id}},this,'categories_destroy',event)">Eliminar</button>
				@endif
				{{ Form::close() }}					
			</td>
			@endcan
		</tr>
	@endforeach
	</tbody>			
</table>
<div class="">
	{{ $categories->links("pagination::bootstrap-4") }}
</div>