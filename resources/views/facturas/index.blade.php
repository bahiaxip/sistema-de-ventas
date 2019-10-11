@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Facturas</h5>
				<a href="{{route('ventas.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
			</div>
		</div>		

		<table class="table table-bordered table-hover">
			<thead class="thead-dark">
				<th>Importe Neto</th>
				<th>IVA</th>				
				<th class="text-center">Ver</th>
				<th class="text-center">Editar</th>
				<th class="text-center">Eliminar</th>
			</thead>
			@if($ventas->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($ventas as $venta)
			<tr class="">
				<td>{{ $venta->cliente->name}} {{$venta->cliente->surname }}</td>
				<td>{{ $venta->vendedor->name }}</td>				
				<td class="text-center">
					<a href="{{ route('ventas.show',$venta->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
				</td>
				<td class="text-center">
					<a href="{{ route('ventas.edit',$venta->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
				</td>
				<td class="text-center">
					{{ Form::open(["route"=>["ventas.destroy",$venta->id],"method"=>"DELETE"]) }}
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
					{{ Form::close() }}
					
				</td>
			</tr>
			@endforeach
						
		</table>
		<div class="">
			{{ $ventas->links("pagination::bootstrap-4") }}
		</div>
	</div>

@endsection
