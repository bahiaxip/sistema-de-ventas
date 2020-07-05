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
		<div class="vendedores_table">
			@include("vendedores.table_vendedores")
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