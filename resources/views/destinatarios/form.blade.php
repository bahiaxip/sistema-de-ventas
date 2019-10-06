<div class="form-group">
	{{ Form::label("name","Nombre") }}
	{{ Form::text("name",null,["class"=> "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("surname","Apellidos") }}
	{{ Form::text("surname",null,["class" => "form-control"]) }}
</div>
<div class="form-group pais">
	{{ Form::label("country","País") }}
	{{ Form::select("country",$paises,null,["id"=>"pais","placeholder"=> "Selecione un país","class"=>"form-control"]) }}
</div>
<div class="form-group provincia">
	{{ Form::label("province","Provincia") }}
	{{ Form::select("province",$provincias,null,["class"=>"form-control prov_select","placeholder"=>"Seleccione una provincia"]) }}
</div>
<div class="form-group">
	{{ Form::label("city","Ciudad") }}
	{{ Form::text("city",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("address","Dirección") }}
	{{ Form::text("address",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("postal_code","Código Postal") }}
	{{ Form::text("postal_code",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("email","E-Mail") }}
	{{ Form::text("email",null,["class" => "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("phone","Teléfono") }}
	{{ Form::text("phone",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("fax","Fax") }}
	{{ Form::text("fax",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("cellphone","Móvil") }}
	{{ Form::text("cellphone",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::submit("Guardar",["class"=>"btn btn-primary"]) }}
</div>

@section("scripts")
<script>
	//eventos que permiten mostrar o ocultar el select province.

	//Si se selecciona España se muestra el select province, ya que es //el único del que tenemos provincias añadidas. Si se selecciona 
	//cualquier país y anteriormente se tenía España se elimina la provincia
var provincia=$("#pais").val();

	if(provincia != "España"){
		$(".provincia").hide();
	}
	
	


$(".pais").on("change",function(){

	if($("#pais").val()=="España"){

		$(".provincia").show();

	}else{

		$(".provincia").hide();

			if(provincia=="España"){
				$(".prov_select").val("");	
			}
	}
	//se actualiza provincia por si se vuelve a subir un archivo 
	//sin recargar la página
	provincia=$("#pais").val();

});
</script>
@endsection