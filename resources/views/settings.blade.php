@extends("layout.layout")

@section("content")
<div class="col-5 pt-3">
	<a href="#desplegable" data-toggle="collapse" class="btn btn-block btn-black" title="Diseño de botones" onclick="cambiarColor(this)">Seleccionar tipo de botón </a>
	
	<div class="collapse" id="desplegable">

		<div class="nav p-3 bg-white justify-content-center">
			<label class="btn btn-black pr-4 cursor-pointer">
				{{Form::radio("design_index","ICONS",["class"=>"form-control"])}}&nbsp;&nbsp;ICONOS
			</label>
			<li class="" style="margin:auto"><i class="fab fa-sistrix fa-lg"></i></li>
			<li class="" style="margin:auto"><i class="far fa-edit fa-lg"></i></li>
			<li class="" style="margin:auto"><i class="fas fa-times-circle fa-lg btn-delete-data"></i></li>
		</div>
		<div class="nav p-3 bg-white justify-content-center">
			<label class="btn btn-black cursor-pointer">{{Form::radio("design_index","BUTTONS",["class"=>"form-control"])}}&nbsp;&nbsp;BOTONES
			</label>
			<li class="" style="margin:auto"><button class="btn btn-outline-info btn-sm">Ver</button></li>
			<li class="" style="margin:auto"><button class="btn btn-outline-success btn-sm">Editar</button></li>
			<li class="" style="margin:auto"><button class="btn btn-outline-danger btn-sm">Eliminar</button></li>
		</div>
		
		
	</div>
</div>
<div class="col-5 pt-3">
	<a href="#desplegable2" data-toggle="collapse" class="btn btn-block btn-grey" title="Diseño de botones" >Tipo IVA</a>
	
	<div class="collapse" id="desplegable2">
		<div class="nav p-3 bg-white justify-content-center">
			{{Form::label("iva","IVA (por defecto)")}}
			{{Form::number("iva",null,["class"=>"form-control"])}}
		</div>
	</div>
</div>

<div class="col-12">
	
</div>
@endsection