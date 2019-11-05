@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Supervisores</h5>
				@can("supervisores.create")
				<a href="{{route('supervisores.create') }}" class="btn btn-sm btn-black text-white float-right">Crear</a>
				@endcan
			</div>
		</div>

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
						<a href="{{ route('supervisores.show',$sup->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
					</td>
					@endcan
					@can("supervisores.edit")
					<td class="text-center">
						<a href="{{ route('supervisores.edit',$sup->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("supervisores.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["supervisores.destroy",$sup->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
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
	</div>
	
	

@endsection
