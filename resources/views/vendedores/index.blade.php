@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header fondo-gris  border-0">				
				<h5 class="float-left">Vendedores</h5>
				@can("vendedores.create")
				<a href="{{route('vendedores.create') }}" class="btn btn-sm btn-black text-white float-right">Crear</a>
				@endcan				
			</div>
			<div class="card-body ">
			{{ Form::label("supervisor","Supervisor") }}
			{{ Form::select("supervisor",$supervisor->pluck("name","id"),$val,["id"=>"select_supervisor","placeholder"=>"Seleccione..."] ) }}
			</div>
		</div>

		<table class="table table-bordered ">
			<thead class="table-titulo">
				<th>Nombre</th>
				<th>Apellidos</th>				
				@can("ventas.show")<th class="text-center">Ver</th>@endcan
				@can("ventas.edit")<th class="text-center">Editar</th>@endcan
				@can("ventas.destroy")<th class="text-center">Eliminar</th>@endcan
			</thead>
			<tbody class="table-sistema"> 
			@if($vendedor->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($vendedor as $ven)
				<tr>
					<td>{{ $ven->name }}</td>
					<td>{{ $ven->surname }}</td>
					@can("vendedores.show")
					<td class="text-center">
						<a href="{{ route('vendedores.show',$ven->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
					</td>
					@endcan
					@can("vendedores.edit")
					<td class="text-center">
						<a href="{{ route('vendedores.edit',$ven->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
					</td>
					@endcan
					@can("vendedores.destroy")
					<td class="text-center">
						{{ Form::open(["route"=>["vendedores.destroy",$ven->id],"method"=>"DELETE"]) }}
						<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
						{{ Form::close() }}
						
					</td>
					@endcan
				</tr>
			@endforeach
			</tbody>		
		</table>
		<div class="">
			{{ $vendedor->links("pagination::bootstrap-4") }}
		</div>
	</div>
	@section("scripts")
	<script>

		//método para select de vendedores/index
		//detecta un cambio en el select y le elimina el parámetro si existe
		//para volver a añadir otro parámetro y que no se concantenen varios parámetros en la ruta
	$("#select_supervisor").change(function(){
		//id es opción elegida del select
		let id=$('#select_supervisor').val();
		//ruta actual
		let href=window.location.href;
		//console.log(id);
		//console.log(href);
		//comprobamos si se añadió parámetro 
		let final=href.lastIndexOf("?value");
		let ruta;
		//si existe el ?value,es decir,es distinto a -1 se extrae la ruta
		//si es igual a -1, es decir, no existe parámetro se  mantiene la ruta
		if(final!=-1){
			console.log(href.lastIndexOf("?value"));
			ruta=href.substr(0,final);
		}else{
			ruta=window.location.href;
		}				
		window.location=ruta+"?value="+id;
		
	});

	</script>
	@endsection
	
	

@endsection
