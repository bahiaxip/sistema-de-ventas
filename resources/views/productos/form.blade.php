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
	{{ Form::label("brand","Marca") }}
	{{ Form::text("brand",null,["class" => "form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("price","Precio") }}
	{{ Form::text("price",null,["class" => "form-control"]) }}
</div>
<div class="form-group" lang="es">
	{{ Form::label("description","Descripción") }}
	{{ Form::textarea("description",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("stock","Stock") }}
	{{ Form::text("stock",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("code","Código de barras") }}
	{{ Form::text("code",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::button("Guardar",["class"=>"btn btn-black","onclick"=>"sendForm()"]) }}
</div>
@section("scripts")
	<script>
		$(document).ready(function(){
			$(".select2js").select2({
				tags:true,
				//es necesario añadirle tb el atributo placeholder al elemento
				placeholder: "Seleccione categoría...",				
			})
		})
		//Realizamos el submit mediante button y sendForm() para que el scanner 
		//al pulsar enter automáticamente después de insertar un código, no tenga 
		//efecto, aunque al estar el input code en última posición, mediante submit
		// tb funciona pero para evitar confusión se mantiene de esta forma
		//Tb existe la posibilidad de configurar el scanner para que no genere el 
		//efecto enter al leer un código
		const sendForm=() => {
			document.querySelector("#formProducts").submit();
		}		
	</script>
@endsection

