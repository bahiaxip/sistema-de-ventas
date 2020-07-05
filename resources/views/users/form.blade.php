	
<div class="form-group row " >
	<div class="col col-auto">
		{{ Form::label("name", "Nombre") }}
		{{ Form::text("name",null,["class"=>"form-control"]) }}
	</div>
</div>
<div class="form-group row">
	<div class="col col-auto">
		<h3>Lista de Roles</h3>
	</div>
</div>
<div class="form-group row">
	<div class="col col-auto">
		<ul class="list-unstyled">
		@foreach($roles as $role)
			<li>	
				<label>
					{{ Form::checkbox("roles[]",$role->id,null) }}
					{{ $role->name }}
					<em>{{ $role->description ?: "N/A" }}</em>
				</label>
			</li>
		@endforeach
		</ul>
	</div>	
</div>
<div class="form-group row">
	<div class="col col-auto">
		{{Form::submit("Guardar",["class"=> "btn btn-sm btn-black"])}}
	</div>
</div>
		
