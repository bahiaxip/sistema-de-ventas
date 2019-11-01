@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Productos</h5>
				@can("productos.create")
				<a href="{{route('productos.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
				@endcan
			</div>
		</div>		

		<table class="table table-bordered table-hover">
			<thead class="thead-dark">
				<th>Nombre</th>
				<th>Categoría</th>
				@can("productos.show")<th class="text-center">Ver</th>@endcan
				@can("productos.edit")<th class="text-center">Editar</th>@endcan
				@can("productos.destroy")<th class="text-center">Eliminar</th>@endcan
			</thead>
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
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
					{{ Form::close() }}					
				</td>
				@endcan
			</tr>
			@endforeach
						
		</table>
		<div class="">
			{{ $productos->links("pagination::bootstrap-4") }}
		</div>
	</div>

@endsection
