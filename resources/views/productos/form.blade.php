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
<div class="form-group" lang="es">
	{{ Form::label("description","Descripción") }}
	{{ Form::textarea("description",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("stock","Stock") }}
	{{ Form::text("stock",null,["class"=>"form-control"]) }}
</div>

<div class="form-group">
	{{ Form::submit("Guardar",["class"=>"btn btn-black"]) }}
</div>
@section("scripts")
	<script>
		$(document).ready(function(){
			$(".select2js").select2({
				tags:true,
				//es necesario añadirle tb el atributo placeholder al elemento
				placeholder: "Seleccione categoría...",
				/*
				"language":{
						"searching":function(){
							return "Buscando...";
						},
						"noResults":function(){
						return "No hay resultados";				
						},
						"errorLoading":function(){
							return "Los resultados no han podido ser cargados";
						},
						"loadingMore":function(){
							return "Cargando más resultados";
						}
				},

				//sin escapeMarkup puede dar algún tipo de error
				escapeMarkup: function(markup){
					return markup;
				}
				*/
				//language:"es",
				//en caso de múltiple
				//tokenSeparators:[","]
			})
		})
		// opciones select2 respuesta
		/*  
		errorLoading: function () {
            return "The results could not be loaded."
        }, inputTooLong: function (e) {
            var t = e.input.length - e.maximum, n = "Please delete " + t + " character";
            return t != 1 && (n += "s"), n
        }, inputTooShort: function (e) {
            var t = e.minimum - e.input.length, n = "Please enter " + t + " or more characters";
            return n
        }, loadingMore: function () {
            return "Loading more results…"
        }, maximumSelected: function (e) {
            var t = "You can only select " + e.maximum + " item";
            return e.maximum != 1 && (t += "s"), t
        }, noResults: function () {
            return "No results found"
        }, searching: function () {
            return "Searching…"
        }, removeAllItems: function () {
            return "Remove all items"
        }
        */
	</script>
@endsection

