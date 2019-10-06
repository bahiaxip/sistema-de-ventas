<div class="form-group">
	{{ Form::label("nif","N.I.F.") }}
	{{ Form::text("nif",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("name","Nombre") }}
	{{ Form::text("name",null,["class"=> "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("surname","Apellidos") }}
	{{ Form::text("surname",null,["class" => "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("address","Dirección") }}
	{{ Form::text("address",null,["class"=>"form-control"]) }}
</div>
<div class="form-group pais">
	{{ Form::label("country","País") }}
	{{ Form::select("country",$paises,null,["id"=>"pais","placeholder"=> "Selecione...","class"=>"form-control"]) }}
</div>
<div class="form-group provincia">
	{{ Form::label("province","Provincia") }}
	{{ Form::select("province",$provincias,null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("postal_code","Código Postal") }}
	{{ Form::text("postal_code",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	<label>Logo</label>
	<div class="custom-file">

	  <input id="" name="logo" type="file" class="custom-file-input" >
	  <label id="logo" class="custom-file-label" for="logo" data-browse="Seleccione...">Subir imagen</label>
	</div>
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
	//añadimos el nombre del archivo al input file (personalizado de bootstrap)
	//cuando se ha seleccionado un archivo 
	$(".custom-file-input").on("change",function(){
		//split divide el array por los caracteres \ (se escriben 2 pk el  //primero solo sirve para escapar)
		//pop() elimina el último elemento del array original y devuelve el
		//elemento eliminado si se almacena en una variable
		var fileName=$(this).val().split("\\").pop(); 
		//siblings apunta al hermano o a los hermanos del elemento
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
@endsection