@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Supervisores</h5>
				<a href="{{route('supervisores.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
			</div>
		</div>

		<table class="table table-bordered table-hover">
			<thead class="thead-dark">
				<th>Nombre</th>
				<th>Apellidos</th>				
				<th class="text-center">Ver</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Eliminar</th>
			</thead>
			@if($supervisor->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($supervisor as $sup)
			<tr class="">
				<td>{{ $sup->name }}</td>
				<td>{{ $sup->surname }}</td>
				
				<td class="text-center">
					<a href="{{ route('supervisores.show',$sup->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
				</td>
				<td class="text-center">
					<a href="{{ route('supervisores.edit',$sup->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
				</td>
				<td class="text-center">
					{{ Form::open(["route"=>["supervisores.destroy",$sup->id],"method"=>"DELETE"]) }}
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
					{{ Form::close() }}
					
				</td>
			</tr>
			@endforeach
						
		</table>
		<div class="">
			{{ $supervisor->links("pagination::bootstrap-4") }}
		</div>
	</div>
	
	

@endsection
