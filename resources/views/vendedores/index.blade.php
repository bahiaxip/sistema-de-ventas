@extends("layout/layout")

@section("content")

	<div class="col-10 mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Vendedores</h5>
				<a href="{{route('vendedores.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
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

			@foreach($vendedor as $ven)
			<tr class="">
				<td>{{ $ven->name }}</td>
				<td>{{ $ven->surname }}</td>
				
				<td class="text-center">
					<a href="{{ route('vendedores.show',$ven->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
				</td>
				<td class="text-center">
					<a href="{{ route('vendedores.edit',$ven->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
				</td>
				<td class="text-center">
					{{ Form::open(["route"=>["vendedores.destroy",$ven->id],"method"=>"DELETE"]) }}
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
					{{ Form::close() }}
					
				</td>
			</tr>
			@endforeach
						
		</table>
		<div class="">
			{{ $vendedor->links("pagination::bootstrap-4") }}
		</div>
	</div>
	
	

@endsection
