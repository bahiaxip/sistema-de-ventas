@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Categorías</h5>
				@can("categories.create")
				<a href="{{route('categories.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>		

		<table class="table table-bordered">
			<thead class="table-titulo">
				<th>Nombre</th>				
				<th class="text-center">Editar</th>
				<th class="text-center">Eliminar</th>
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
						<a href="{{ route('categories.edit',$cat->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("categories.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["categories.destroy",$cat->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
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
	</div>
@endsection
