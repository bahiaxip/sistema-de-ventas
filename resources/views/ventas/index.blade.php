@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Ventas</h5>
				@can("ventas.create")
				<a href="{{route('ventas.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>		

		<table class="table table-bordered ">
			<thead class="table-titulo">
				<th>Venta</th>
				<th>Cliente</th>
				<th>Vendedor</th>				
				@can("ventas.show")<th class="text-center">Ver</th>@endcan
				@can("ventas.show")<th class="text-center">Editar</th>@endcan
				@can("ventas.show")<th class="text-center">Eliminar</th>@endcan
			</thead>
			<tbody class="table-sistema">		
			@if($ventas->count()==0)			
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($ventas as $venta)
				<tr class="">
					<td>{{ $venta->id }}</td>
					<td>{{ $venta->cliente->name}} {{$venta->cliente->surname }}</td>
					<td>{{ $venta->vendedor->name }}</td>
					@can("ventas.show")
					<td class="text-center">
						<a href="{{ route('ventas.show',$venta->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
					</td>
					@endcan
					@can("ventas.show")
					<td class="text-center">
						<a href="{{ route('ventas.edit',$venta->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("ventas.show")
					<td class="text-center">
						{{ Form::open(["route"=>["ventas.destroy",$venta->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
						{{ Form::close() }}					
					</td>
					@endcan
				</tr>
			@endforeach
			</tbody>	
		</table>
		<div class="">
			{{ $ventas->links("pagination::bootstrap-4") }}
		</div>
	</div>

@endsection
