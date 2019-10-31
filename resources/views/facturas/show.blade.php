@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<a href="{{URL::previous()}}">Volver Atrás</a>
		<div class="card border-0 bg-dark text-white">

			<div class="card-title text-center pt-2">
				<h5><strong>Resumen de factura</strong></h5>
			</div>
		</div>
		
		<div class="form-group row mt-3">				
			<div class="col-10 col-md-4 offset-2">
				<p><strong>ID-Factura:</strong> &nbsp;{{ $factura->id }}</p>
				<p><strong>Importe Neto:</strong> &nbsp;<span id="neto">{{number_format($factura->net,0,",",".")}}</span>€</p>
				<p><strong>IVA:</strong> &nbsp;<span id="iva">{{ $factura->vat }}</span></p>
			<p><strong>Total:</strong> &nbsp;<span id="total"> {{number_format($factura->total,0,",",".")}} </span>€</p>
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
			<a href="#collapse1" data-toggle="collapse" class="btn btn-block btn-primary">Agregar Productos</a>
		</div>
	</div>
	
	<div id="collapse1" class="collapse ">
		{{ Form::open(["onsubmit"=>"addProductToFactura('$factura->id ',event)"]) }}
		<div class="form-group row">
			<div class="col-10 col-lg-3">
				{{ Form::label("categoria","Categoría de Producto") }}
				{{ Form::select("categoria",$categorias,null,["class"=>"form-control","placeholder"=>"Seleccione categoría"]) }}
			</div>
			<div class="col-10 col-lg-5"> 
				{{ Form::label("producto","Productos") }}
				{{ Form::select("producto",$productos,null,["class"=>"form-control","placeholder"=>"Seleccione un producto"]) }}
			</div>
			<div class="col-10 col-lg-2">
				{{ Form::label("cantidad","Cantidad") }}
				{{ Form::number("cantidad",1,["class"=> "form-control"]) }}
			</div>
			<div class="col-10 col-lg-2 align-self-end">
				{{ Form::submit("Agregar",["class"=>"btn btn-primary"])}}
			</div>
			
		</div>
		{{ Form::close() }}
		
		
		<div class="card seccion_productos">
			@include("facturas.ajax-product")			
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
						$("select[name='producto'").html(data.dato);
						//console.log(data.options);
					},
					error: function(){
						console.log("Error");
					}

				})
			}
		});
		function addProductToFactura(id,e){
			e.preventDefault();
			var url="../addProduct";
			var idProducto= $("#producto").val();
			var idFactura=id;
			var cantidad=$("#cantidad").val();
			console.log("sum es: "+$(".suma").html());
			console.log(idProducto);
			$.ajax({
				type:"POST",
				data:{producto:idProducto,factura:idFactura,cantidad:cantidad,_token:"{{ csrf_token() }}"},
				url:url,
				//dataType:"json",
				//contentType:"application/json",
				success:function(data){	
					//console.log(data);				
					$("#categoria").val("0");					
					document.getElementById("producto").value="0";
					$("#cantidad").val("1");
					$(".seccion_productos").html("");
					$(".seccion_productos").html(data.dato);
					console.log(data.suma);
					//cambiamos el neto y el total ya que aunque la
					//db está actualizada la vista no se actualiza.
					$("#neto").html(data.suma.toLocaleString());
					let iva=(parseInt($("#iva").html()));
					let sumaTotal=Math.round(data.suma*((100+iva)/100));
					$("#total").html(sumaTotal.toLocaleString("es-ES"));
				},
				error:function(){
					console.log("ERror")
				}
			});
			//console.log("bien0");
		}


	</script>
@endsection