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
	{{ Form::select("country",$paises,null,["id"=>"provincia","placeholder"=> "Selecione...","class"=>"form-control"]) }}
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