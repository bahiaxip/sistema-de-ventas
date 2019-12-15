@extends("layout.layout")

@section("content")



<div class="col-12 col-md-6 col-lg-5 pt-3 align-self-start">	
	{{Form::open(["route"=>"settings.update","method"=>"PUT"])}}
	<a href="#desplegable" data-toggle="collapse" class="btn btn-block btn-black" title="Diseño de botones" onclick="cambiarColor(this)">Seleccionar tipo de botón </a>
	
	<div class="collapse" id="desplegable">
		
		<div class="nav p-3 bg-white justify-content-center">
			<label class="btn btn-black pr-4 cursor-pointer">
				{{Form::radio("design_index","ICONS",(old("design_index",$design_index->data)=="ICONS") ? "checked":"")}}&nbsp;&nbsp;ICONOS
			</label>
			<li class="" style="margin:auto"><i class="fab fa-sistrix fa-lg"></i></li>
			<li class="" style="margin:auto"><i class="far fa-edit fa-lg"></i></li>
			<li class="" style="margin:auto"><i class="fas fa-times-circle fa-lg btn-delete-data"></i></li>
		</div>
		<div class="nav p-3 bg-white justify-content-center">
			<label class="btn btn-black cursor-pointer">
				{{Form::radio("design_index","BUTTONS",(old("design_index",$design_index->data)=="BUTTONS") ? "checked":"")}}&nbsp;&nbsp;BOTONES
			</label>
			<li class="" style="margin:auto"><button class="btn btn-outline-info btn-sm">Ver</button></li>
			<li class="" style="margin:auto"><button class="btn btn-outline-success btn-sm">Editar</button></li>
			<li class="" style="margin:auto"><button class="btn btn-outline-danger btn-sm">Eliminar</button></li>
		</div>
	</div>
	@if(count($errors->get("design_index")))
	<div class="alert alert-success mt-3">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>                                        
            @endforeach
        </ul>
    </div>
@endif
	<div class="d-none d-lg-block pt-3" >
		{{Form::submit("Guardar",["class"=>"btn btn-black"])}}
	</div>
</div>
@role("admin")
<div class="col-12 col-md-6 col-lg-5 pt-3 align-self-start">	
	<a href="#desplegable2" data-toggle="collapse" class="btn btn-block btn-black" title="Diseño de botones" onclick="cambiarColor(this)" >Tipo IVA</a>
	
	<div class="collapse" id="desplegable2">
		<div class="nav p-3 bg-white justify-content-center">
			{{Form::label("vat","IVA (por defecto)")}}
			{{Form::number("vat",$vat->data,["class"=>"form-control"])}}
		</div>
	</div>
@if(count($errors->get("vat")))
	<div class="alert alert-success mt-3">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>                                        
            @endforeach
        </ul>
    </div>
@endif
</div>
@endrole
<div class="col-12 text-center col-sm-12 d-lg-none  pt-3 align-self-start"> 
{{Form::submit("Guardar",["class"=>"btn btn-black"])}}
</div>


{{Form::close()}}
<div class="col-12">
	
</div>

@endsection