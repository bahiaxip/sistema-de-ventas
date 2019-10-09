<div class="form-group">
	{{ Form::label("name","Nombre") }}
	{{ Form::text("name",null,["class"=> "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("category_id","Categoría")}}
	{{ Form::select("category_id",$category,null,["class"=>"form-control select2js","placeholder"=>"Seleccione categoría"]) }}
</div>
<div class="form-group">
	{{ Form::label("product_model","Modelo") }}
	{{ Form::text("product_model",null,["class" => "form-control"]) }}
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
@section("scripts")
	<script>
		$(document).ready(function(){
			$(".select2js").select2({
				tags:true,
				tokenSeparators:[","]
			})
		})
	</script>
@endsection

