@extends("layout.layout")

@section("content")
<div class="col mt-3">
	<div class="card border-0">
		<div class="card-header text-center pt-3 fondo-gris text-white">
			<h5><strong>Resumen de factura</strong></h5>
		</div>
		<div class="card-body">
			<div class="row div-show">
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show">
						ID Factura:
					</span>
				</div>
				<div class="col-12 text-center col-md-4 pt-2">
					<span>
						{{$factura->id}}
					</span>
				</div>
				
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show">
						Estado:
					</span>
				</div>
				<div class="col-12 text-center col-md-4 pt-2">
					<span>
						{{$factura->state}}
					</span>
				</div>
			
			</div>
			<div class="row div-show pt-3">
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show">
						Importe Neto:
					</span>
				</div>
				<div class="col-12 text-center col-md-4  pt-2">
					<span id="neto">
						{{number_format($factura->net,2,",",".")}}
						{{-- $factura->net --}}
						</span>€
				</div>
			@if($factura->order_buy!=null)				
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show">
						Nº Pedido:
					</span>
				</div>
				<div class="col-12 text-center col-md-4  pt-2">
					<span>
						{{$factura->order_buy}}
					</span>
				</div>				
			@endif
			</div>
			<div class="row div-show pt-3">
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show">
						IVA:
					</span>
				</div>
				<div class="col-12 text-center col-md-4  pt-2">
					<span id="iva">
						{{$factura->vat}}
					</span>%
				</div>
			@if($factura->office_guide!=null)				
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show">
						Guía de oficina:
					</span>
				</div>
				<div class="col-12 text-center col-md-4  pt-2">
					<span>
						{{$factura->office_guide}}
					</span>
				</div>
			
			@endif
			</div>
			<div class="row div-show pt-3">
				<div class="col-12 text-center col-md-2 ">
					<span class="badge p-2 span-show" >
						Importe Total:
					</span>
				</div>
				<div class="col-12 text-center col-md-4  pt-2">
					<span id="total">
						{{number_format($factura->total,2,",",".")}}
						{{-- $factura->total --}}
					</span>€
				</div>
			</div>
		</div>
		
		<div class="form-group row justify-content-center pt-2 ">
			<!--<a href="{{URL::previous()}}" class="btn btn-sm btn-primary">Volver Atrás</a>-->
			<div>
				<a class="btn btn-black" href ="{{route('exportar',$factura->id)}}" title="Descargar en Excel">Excel</a>
				<a class="btn btn-black" href ="{{route('exportarPDF',$factura->id)}}" title="Descargar en PDF">PDF</a>
				<button id="btn-modal-factura" class="btn btn-black">Enviar Correo</button>
			</div>
			<div class="col-10 col-md-5">

			<a href="#collapse1" data-toggle="collapse" class="btn btn-block btn-black btn-ver_factura" title="Ver factura completa" onclick="cambiarTexto()">Ver factura completa</a>
		</div>
	</div>

	<div id="collapse1" class="collapse ">
		
		<div class="card seccion_productos">
			@include("facturas.ajax-product")			
		</div>
	</div>
	<div class="modal fade" id="modal-mail-factura">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title">
						Indique el correo de destino
					</div>

				</div>
				<div class="modal-body">
					<div class="row">
						{{ Form::open(["route"=>"exportarEmail","id"=>"sendEmail"]) }}
						@if($factura->venta->destinatario->email==$factura->venta->cliente->email)
							{{ Form::select("email",[$factura->venta->destinatario->email],null,["class"=>"form-control select2","id"=>"selectEmail"])}}
						@else
							{{ Form::select("email",[$factura->venta->destinatario->email,$factura->venta->cliente->email],null,["class"=>"form-control select2","id"=>"selectEmail"])}}
						@endif
						{{Form::hidden("hiddenEmail",null,["id"=>"hiddenEmail"])}}
						{{Form::hidden("id_factura",$factura->id)}}
						{{ Form::close() }}
					</div>
					<div class="row pt-3">
						<div class="col">
							<button class="btn btn-outline-success" data-dismiss="modal" >Cancelar</button>
							<button id="btn-mail-factura" class="btn btn-outline-danger">
								Enviar
							</button>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section("scripts")
	<script>
			//select para modal (enviar correo)
		$(document).ready(function(){
			$(".select2").select2({
				tags:true
			})
		});
		//modal enviar correo
		$("#btn-modal-factura").on("click",function(e){
			e.preventDefault();
			$("#modal-mail-factura").modal("show");
			$("#btn-mail-factura").on("click",function(){
				//console.log("llega",document.querySelector("#selectEmail"));		
				let select=document.querySelector("#selectEmail"),		
					val=select.options[select.options.selectedIndex].innerHTML,
					hidden=document.querySelector("#hiddenEmail"),
					Dato={};
					hidden.value=val;
				document.querySelector("#sendEmail").submit();
			});
		})
		
		//cambiar texto en boton ver factura completa
		function cambiarTexto(){
			let btn=document.querySelector(".btn-ver_factura");
			if(btn.innerHTML=="Ver factura completa"){
				btn.title="Ocultar factura";
				btn.innerHTML="Ocultar factura";	
			}else{
				btn.title="Ver factura completa";
				btn.innerHTML="Ver factura completa";	
			}
		}
		//selección de productos según categoría
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
	</script>
@endsection