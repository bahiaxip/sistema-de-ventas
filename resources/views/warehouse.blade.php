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
			<div class="col-12 mt-3 col-lg-4 col-xl-4  align-self-end">
				{{ Form::button("Seleccionar",["class"=>"btn btn-black","onclick"=>"selectProductWarehouse(this,event)"])}}
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
function selectProductWarehouse(ide,e){
	e.preventDefault();
	let form=ide.parentElement.parentElement.parentElement;
	let productoId=document.querySelector("#producto").value;
	let url="select_product_warehouse";
	$.ajax({
		type:"POST",
		url:url,
		data:{id:productoId,_token:"{{csrf_token()}}"},
		success:function(data){
			console.log(data);
			document.querySelector(".selectProduct").innerHTML=data;
		},
		error:function(){
			console.log("ErRor");
		}
	});
	//form.submit();
}

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
		},
		error:function(){
			console.log("ErRor");
		}
	})
}
	
</script>
@endsection