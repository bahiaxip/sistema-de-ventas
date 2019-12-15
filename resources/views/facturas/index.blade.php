@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Facturas de Venta {{ $venta->id }} asociadas a {{$venta->cliente->name}} </h5>
				@can("ventas.create")
				<a href="{{route('facturas.create','venta='.$venta->id) }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>		

		<table class="table table-bordered">
			<thead class="table-titulo">
				<th>Importe Neto</th>
				<th>IVA</th>				
				@can("ventas.show")<th class="text-center">Ver</th>@endcan
				@can("ventas.edit")<th class="text-center">Editar</th>@endcan
				@can("ventas.destroy")<th class="text-center">Eliminar</th>@endcan
			</thead>
			<tbody class="table-sistema">
			@if($facturas->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($facturas as $factura)
				<tr class="">
					<td>{{ $factura->net}}</td>
					<td>{{ $factura->vat }}</td>
					@can("ventas.show")				
					<td class="text-center">
						<a href="{{ route('facturas.show',$factura->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
					</td>
					@endcan
					@can("ventas.edit")
					<td class="text-center">
						<a href="{{ route('facturas.edit',$factura->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("ventas.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["facturas.destroy",$factura->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
						{{ Form::close() }}
					</td>
					@endcan
				</tr>
			@endforeach
			</tbody>		
		</table>
		<div class="">
			{{ $facturas->links("pagination::bootstrap-4") }}
		</div>
		
	</div>

@endsection
