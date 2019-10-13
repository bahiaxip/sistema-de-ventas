@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<a href="{{URL::previous()}}">Volver Atrás</a>
		<div class="card border-0 bg-dark text-white">

			<div class="card-title text-center pt-2">
				<h5><strong>Detalle de factura</strong></h5>
			</div>
		</div>
		<div class="form-group row mt-3">				
			<div class="col-10 col-md-4 offset-2">
				<p><strong>Factura:</strong> &nbsp;{{ $factura->id }}</p>
				<p><strong>Importe Neto:</strong> &nbsp;{{ $factura->net}}</p>
				<p><strong>IVA:</strong> &nbsp;{{ $factura->vat }}</p>
			<p><strong>Total:</strong> &nbsp; {{number_format($factura->total,0,",",".")}} €</p>
			</div>
			<div class="col-10 col-md-4 offset-2">
				<p><strong>Estado:</strong> &nbsp;{{$factura->state}}</p>
				<p><strong>Orden de compra:</strong> &nbsp;{{$factura->order_buy}}</p>
				<p><strong>Guía de oficina:</strong> &nbsp; {{$factura->office_guide}} </p>					
			</div>				
		</div>

		<div class="form-group row justify-content-center">
			<div class="col-10 col-md-5">					
				<button class="btn btn-block btn-primary">Ver Factura Completa</button>
			</div>
		</div>

		<div class="form-group row justify-content-center ">
			<div class="col-10 col-md-5">					
			<a href="#collapse1" data-toggle="collapse" class="btn btn-block  btn-primary">Agregar Productos</a>
		</div>
	</div>
	
	<div id="collapse1" class="collapse ">
		{{ Form::open() }}
		<div class="form-group row">
			<div class="col-10 col-md-3">
				{{ Form::label("categoria","Categoría de Producto") }}
				{{ Form::select("categoria",$categorias,null,["class"=>"form-control","placeholder"=>"Seleccione categoría"]) }}
			</div>
			<div class="col-10 col-md-7"> 
				{{ Form::label("producto","Productos") }}
				{{ Form::select("producto",$productos,null,["class"=>"form-control","placeholder"=>"Seleccione un producto"]) }}
			</div>
			<div class="col-10 col-md-2 align-self-end">
				{{ Form::submit("Agregar",["class"=>"btn btn-primary"])}}
			</div>
			
		</div>
		{{ Form::close() }}
		<div class="card">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Producto</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>hola</td>
						<td>adios</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section("scripts")
	<script>
		$("#categoria").on("change",function(){
			if($(this).val!=0){
				var datos=$(this).val();
				var url="../loadProduct";
				$.ajax({
					type:"GET",
					data: {data: datos},
					url:url,
					//dataType:"json",
					success: function(data){
						//console.log(data);
						$("select[name='producto'").html("");
						$("select[name='producto'").html(data.datos);
						//console.log(data.options);
					},
					error: function(){
						console.log("Error");
					}

				})
			}
		});
	</script>
@endsection