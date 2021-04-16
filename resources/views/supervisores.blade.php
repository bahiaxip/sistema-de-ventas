@extends("layout/layout")

@section("content")
<div class="row">
	<div class="col">
		<table class="table mt-3 table-bordered table-hover">
			<thead class="thead-dark">
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Teléfono</th>
				<th>E-Mail</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Eliminar</th>
			</thead>
		@foreach($supervisor as $sup)
			<tr>
				<td>{{ $sup->name }}</td>
				<td>{{ $sup->surname }}</td>
				<td>{{ $sup->phone }}</td>
				<td>{{ $sup->email }}</td>
				<td class="text-center">
					<a href="{{ route('supervisores.edit','2') }}" title="Editar" class="btn btn-sm btn-success">
						Editar
					</a>
				</td>
				<td class="text-center">
					<a href="{{ route('supervisores.destroy','2') }}" title="Eliminar" class="btn btn-sm btn-danger text-white">
						Eliminar
					</a>
				</td>
			</tr>
		@endforeach
		</table>
		<div class="">
			{{ $supervisor->links("pagination::bootstrap-4") }}
		</div>
		
	</div>
</div>
@endsection