<div class="form-group">
	{{ Form::label("name","Nombre") }}
	{{ Form::text("name",null,["class"=> "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("model","Modelo") }}
	{{ Form::text("model",null,["class" => "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("price","Precio") }}
	{{ Form::text("price",null,["class" => "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("description","Descripción") }}
	{{ Form::textarea("description",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("stock","Stock") }}
	{{ Form::text("stock",null,["class"=>"form-control"]) }}
</div>

<div class="form-group">
	{{ Form::submit("Guardar",["class"=>"btn btn-primary"]) }}
</div>

