<div class="form-group row">
	<div class="col">
		{{ Form::label("name","Nombre") }}
		{{ Form::text("name",null,["class"=>"form-control"]) }}
	</div>
</div>
<div class="form-group row">
	<div class="col">
		{{ Form::label("slug", "URL amigable") }}
		{{ Form::text("slug",null,["class"=>"form-control"]) }}
	</div>
</div>
<div class="form-group row">
	<div class="col">
		{{ Form::label("description","Descripción") }}
		{{ Form::text("description",null,["class"=> "form-control"]) }}
	</div>
</div>
<h5>Permiso Especial</h5>
<br>
<div class="form-group row">
	<div class="col">
		
		<label>{{ Form::radio("special","all-access") }}&nbsp;&nbsp;Acceso Total</label>
		&nbsp;&nbsp;&nbsp;
		<label>{{ Form::radio("special","no-access") }}&nbsp;&nbsp;Ningún Acceso</label>
	</div>
</div>
<h5>Lista de Permisos</h5>
<br>
<div class="form-group row">
	<div class="col">
		<ul class="list-unstyled">
		@foreach($permissions as $permission)
			<li>
				<label >
					{{ Form::checkbox("permissions[]",$permission->id,null) }}
					{{ $permission->name }}
					<em>({{ $permission->description ?: "Sin descripción" }})</em>
				</label>
			</li>
		@endforeach
		</ul>
	</div>
</div>
<div class="form-group row">
	<div class="col">
		{{ Form::submit("Guardar",["class"=> "btn btn-sm btn-black"]) }}
	</div>
</div>
@section("scripts")
<script src="{{ asset('vendors/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
<script>
    $(document).ready(function()
    {
        $("#name, #slug").stringToSlug({//#name y #slug (campos donde recoger)
            callback: function(text){
                $("#slug").val(text);//#slug (campo donde mostrar)
            }
        })
    });
</script>
@endsection