@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Clientes</h5>
				@can("clientes.create")
				<a href="{{route('clientes.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>		

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
						<a href="{{ route('clientes.show',$cliente->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
					</td>
					@endcan
					@can("clientes.edit")
					<td class="text-center">
						<a href="{{ route('clientes.edit',$cliente->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("clientes.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["clientes.destroy",$cliente->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
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
	</div>	
	@section("scripts")
	<script>

	</script>
	@endsection
	
	

@endsection
