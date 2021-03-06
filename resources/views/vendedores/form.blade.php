<div class="form-group">
	{{ Form::label("name","Nombre") }}
	{{ Form::text("name",null,["class"=> "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("surname","Apellidos") }}
	{{ Form::text("surname",null,["class" => "form-control"]) }}
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
	{{Form::label("id_supervisor","Supervisor")}}
	<!--{{ Form::select("id_supervisor",["id_supervisor"=>"manolo"],null,["placeholder"=>"Selecione..."]) }}-->
	{{ Form::select("id_supervisor",$supervisor->pluck("name","id"),null,["placeholder"=>"Selecione...","class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::submit("Guardar",["class"=>"btn btn-black"]) }}
</div>