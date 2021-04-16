@extends("layout/layout")

@section("content")
<div class="row ">
	<div class="col">
		<table class="table mt-3 table-bordered table-hover">
			<thead class="thead-dark">
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>E-Mail</th>
				<th>Teléfono</th>
				<th>Supervisor</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Eliminar</th>
			</thead>

			@foreach($vendedor as $ven)
			<tr class="">
				<td>{{ $ven->nombre }}</td>
				<td>{{ $ven->apellidos }}</td>
				<td>{{ $ven->correo }}</td>
				<td>{{ $ven->telefono }}</td>
				<td>{{ $ven->id_supervisor }}</td>
				<td class="text-center">
					<a href="{{ route('vendedores.edit','2') }} " title="Editar" class="btn btn-success btn-sm text-white ">Editar</a>
				</td>
				<td class="text-center">
					<a href="{{ route('vendedores.destroy','2') }}" title="Eliminar" class="btn btn-danger btn-sm text-white " >Eliminar</a>
				</td>
			</tr>
			@endforeach
						
		</table>
		<div class="">
			{{ $vendedor->links("pagination::bootstrap-4") }}
		</div>
	</div>
	
</div>
@endsection
