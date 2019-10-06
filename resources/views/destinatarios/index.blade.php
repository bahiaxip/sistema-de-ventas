@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Destinatarios</h5>
				<a href="{{route('destinatarios.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
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
			@if($destinatarios->count()==0)
				<tr>
					<td class="text-center" colspan="5"><strong>No existen resultados</strong></td>
				</tr>
			@endif
			@foreach($destinatarios as $dest)
			<tr class="">
				<td>{{ $dest->name }}</td>
				<td>{{ $dest->surname }}</td>
				
				<td class="text-center">
					<a href="{{ route('destinatarios.show',$dest->id) }}" title="Ver" class="btn btn-outline-info btn-sm">Ver</a>
				</td>
				<td class="text-center">
					<a href="{{ route('destinatarios.edit',$dest->id) }}" title="Editar" class="btn btn-outline-success btn-sm">Editar</a>
				</td>
				<td class="text-center">
					{{ Form::open(["route"=>["destinatarios.destroy",$dest->id],"method"=>"DELETE"]) }}
					<button title="Eliminar" class="btn btn-outline-danger btn-sm btn-delete-data" >Eliminar</button>
					{{ Form::close() }}
					
				</td>
			</tr>
			@endforeach
						
		</table>
		<div class="">
			{{ $destinatarios->links("pagination::bootstrap-4") }}
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
