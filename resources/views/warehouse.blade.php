@extends("layout/layout")

@section("content")


<!--
<div class="col col-xl-10 formstyle">
	<div class="form-group row">
		<div class="col-10 col-lg-3">
			{{ Form::label("categoria","Categoría") }}
			{{ Form::select("categoria",$categorias,null,["class"=>"form-control"])}}

		</div>
		<div class="col-10 col-lg-5"> 
			{{ Form::label("producto","Productos") }}
			{{ Form::select("producto",$productos,null,["class"=>"form-control"])}}
		</div>
		<div class="col-10 col-lg-2">
			{{ Form::label("cantidadAdd","Cantidad") }}
			{{ Form::number("cantidadAdd",1,["class"=> "form-control"]) }}
		</div>
		<div class="col-10 mt-3 col-lg-2  align-self-end" >
			{{ Form::button("Seleccionar",["class"=>"btn btn-black"])}}
		</div>
	</div>
</div>
-->

<div class="row text-white align-self-start justify-content-center">
	
		{{Form::open(["route"=>"select_product_warehouse","id"=>"form_add_warehouse"])}}
		<div class="form-group row ml-2  ">
			<div class="col-12 col-lg-3 col-xl-3">
				{{ Form::label("categoria","Categoría") }}
				{{ Form::select("categoria",$categorias,null,["class"=>"form-control"])}}
			</div>
			<div class="col-12 col-lg-5 col-xl-5"> 
				{{ Form::label("producto","Productos") }}
				{{ Form::select("producto",$productos,null,["class"=>"form-control"])}}
			</div>
			<div class="col-6 mt-3 col-lg-2 col-xl-2  align-self-end">
				{{ Form::button("Seleccionar",["class"=>"btn btn-black","onclick"=>"selectProductWarehouse(event)"])}}
			</div>
			<div class="col-6 mt-3 col-lg-2 col-xl-2  align-self-end">
				{{ Form::button("Escaner",["class"=>"btn btn-black","id"=>"btn-modal-scanner","data-toggle"=>"modal","data-target"=>"#modal-scanner"])}}				
			</div>
			<div class="col-12 selectProduct pt-2">
		
			</div>
		</div>
		{{Form::close()}}
</div>


<div class="col-12">
	
</div>
@endsection

@section("scripts")
<script>
	//seleccionar categoría
$("#categoria").on("change",function(){
		if($(this).val!=0){
			var datos=$(this).val();
			var url="{{asset('/loadProduct')}}";
			//console.log(url);return;
			$.ajax({
				type:"GET",
				data: {data: datos},
				url:url,
				//dataType:"json",
				success: function(data){
					
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
//seleccionar producto (al pulsar el botón Seleccionar)
//function selectProductWarehouse(ide,e){
function selectProductWarehouse(e){
	e.preventDefault();
	//let form=ide.parentElement.parentElement.parentElement;	
	let productoId=document.querySelector("#producto").value;
	let url="select_product_warehouse";
	$.ajax({
		type:"POST",
		url:url,
		data:{id:productoId,_token:"{{csrf_token()}}"},
		success:function(data){
			//console.log(data);
			document.querySelector(".selectProduct").innerHTML=data;
		},
		error:function(){
			console.log("ErRor");
		}
	});
	//form.submit();
}
//Añadir producto incluido en HomeController método add_warehouse(request)
function addWarehouse(ide,e){
	e.preventDefault();	
	let cantidad=document.querySelector("#amount").value;
	let id=document.querySelector("#product_id").value;
	$.ajax({
		type:"POST",
		url:"add_stock",
		data:{id:id,amount:cantidad,_token:"{{csrf_token()}}"},
		success:function(data){
			document.querySelector("#stock").innerHTML=data;
			document.querySelector("#amount").value="1";
			//añadir un mensaje de producto añadido
		},
		error:function(){
			console.log("ErRor");
		}
	})
};

//ventana modal del escaner

$("#modal-scanner").on("shown.bs.modal",function(){	
	let scan=$("#input-scanner");
	$("#input-scanner").trigger("focus");
	$("#input-scanner").one("change",function(ev){
		$("#modal-scanner").modal("hide");

		//console.log($("#input-scanner").val());
		if(scan.val()!=""){
			//consulta con ajax
			$.ajax({
				type:"POST",
				url:"test_code",
				data:{code:scan.val(),_token:"{{csrf_token()}}"},
				success:function(data){
					if(data!="false"){
						//actualizar campos y eliminar el código del input; descontar el stock al añadir producto en factura
						//necesario crear array de id y cantidad y al guardar realizar un filter y detectar si hay cambios en el array
						//si los hay actualizar el stock de ese id.
						document.querySelector(".selectProduct").innerHTML=data;
						document.querySelector("#input-scanner").value="";
					}else{
						alert("No es un código válido");
						document.querySelector("#input-scanner").value="";
						document.querySelector(".selectProduct").innerHTML="";
					}
					document.querySelector("#producto").value=0;

				},
				error:function(){
					console.log("Error enviando barcode de producto");
				}

			})
		}else{
			console.log("No se ha introducido ningún código");
		}		
	})
})

/*$("#btn-modal-scanner").on("click",function(e){
	e.preventDefault();
	$("#modal-scanner").on("shown.bs.modal",function(){
		console.log("bien");
	})
	//$("#modal-scanner").modal("show");
	$("#input-scanner").change();
	$("#input-scanner").one("change",function(ev){
		$("#modal-scanner").modal("hide");
		console.log($("#input-scanner").val());
		//consulta con ajax
		$.ajax({
			type:"POST",
			url:"select_product",

		})
	})
})
*/

	
</script>
@endsection