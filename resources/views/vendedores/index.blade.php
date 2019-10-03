@extends("layout/layout")

@section("content")

	<div class="col-10 mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0">
			<div class="card-title">
				<h5 class="float-left">Vendedores</h5>
				<a href="{{route('vendedores.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
			</div>
		</div>
		<div class="form-group">
			{{ Form::label("supervisor","Supervisor") }}
			{{ Form::select("supervisor",$supervisor->pluck("name","id"),$val,["id"=>"select_supervisor","placeholder"=>"Seleccione..."] ) }}
			
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
	@section("scripts")
	<script>

		/*$(document).ready(function(){
			let href=window.location.href;			
			let final=href.lastIndexOf("?value");
			if(final!=-1){
				let ultimo=href.charAt(final+7);
				$("#select_supervisor").val(ultimo);
				console.log(ultimo);
			}
		});*/
	$("#select_supervisor").change(function(){
		let id=$('#select_supervisor').val();
		let href=window.location.href;
		console.log(id);
		console.log(href);		
		let final=href.lastIndexOf("?value");
		let ruta;
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
