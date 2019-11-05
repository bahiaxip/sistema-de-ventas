{{-- <div class="card seccion_productos">
	@include("facturas.ajax-product")
</div>--}}
<div class="row">
	<div class="col text-center">
		<h5>Productos</h5>
	</div>
</div>
@if(isset($productos_factura))
<div class="row seccion_factura">

	@include("facturas.ajax-edit")
</div>
@endif
@if(isset($venta_id))
	<div class="form-group row">
		<div class="col-10 col-lg-3">
			{{ Form::label("categoria","Categoría ") }}
			{{ Form::select("categoria",$categorias,null,["class"=>"form-control"]) }}
		</div>
		<div class="col-10 col-lg-5"> 
			{{ Form::label("producto","Productos") }}
			<select name="producto" id="producto" class="form-control">
				<option value="0">Seleccione producto</option>
				@foreach($productos as $pro)
					<option value="{{$pro->id}}" data-price="{{$pro->price}}">{{$pro->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-10 col-lg-2">
			{{ Form::label("cantidad","Cantidad") }}
			{{ Form::number("cantidad",1,["class"=>"form-control"])}}
		</div>
		<div class="col-10 col-lg-2 align-self-end">
			<!--@{{ Form::submit("Agregar",["class"=>"btn btn-primary","onclick"=>"addProductToList(event)"])}}-->
			{{ Form::button("Agregar",["class"=>"btn btn-black","onclick"=>"addProductToList()"])}}
		</div>
		
	</div>
	@include("facturas.ajax-product-create")

@endif
<div class="form-group">
	{{ Form::label("net","Importe Neto") }}
	{{ Form::number("net",null,["class"=>"form-control","readonly"=>"readonly"]) }}
</div>

<div class="form-group">
	{{ Form::label("vat","IVA") }}
	<?php 
	if($iva==false){		
		?>
		{{ Form::number("vat",null,["class"=>"form-control"]) }}
		<?php
	}else {
		?>
		{{ Form::number("vat",config("iva"),["class"=>"form-control","readonly"=>"readonly"]) }}
		<?php
	}
	?>
</div>
<div class="form-group">
	{{ Form::label("total","Importe Total") }}
	{{ Form::number("total",null,["class"=>"form-control","readonly"=>"readonly"]) }}
</div>
<div class="form-group">
	{{ Form::label("state","Estado de pago") }}
</div>
<div class="form-group">
	<label>{{ Form::radio("state","PAYED",["class"=>"form-control"]) }}Pago efectuado</label>
	<label>{{ Form::radio("state","DUE",["class"=>"form-control"]) }}Pago pendiente</label>
</div>
<div class="form-group">
	{{ Form::label("order_buy","Orden de compra") }}
	{{ Form::text("order_buy",null,["class"=>"form-control"]) }}
</div>
<div class="form-group">
	{{ Form::label("office_guide","Guía de oficina") }}
	{{ Form::text("office_guide",null,["class"=>"form-control"]) }}
</div>	
	{{ Form::hidden("datos",null,["id"=>"datos"])}}

	@if(isset($venta_id))
		{{ Form::hidden("venta_id",$venta_id) }}
	@endif

{{ Form::submit("Guardar",["class"=>"btn btn-black"]) }}

	@section("scripts")
	<script>
		//listSelected es un array de todos los id selected de productos, es decir,
		//todos los productos de la factura seleccionada que trae la db.
		let productsSelected=listSelected();
		//bloque para edit
@if(isset($factura))
		

	$("#categoria").on("change",function(){
		if($(this).val!=0){
			var datos=$(this).val();
			var url="../../loadProduct";
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



	
	
	let	editedProducts=[],
		sumaTotal;

	
	//método evento de cambio producto en facturas.edit-facturas.ajax-edit-table
	function editSelectProductos(id){
		
		console.log(productsSelected);
		//convertimos el elemento que viene parámetro a identificador de 
		//tipo JQuery
		let datos=$(id);

		//almacenamos el valor de ID Producto (anterior)
		let proId=datos.parent().prev().find("input:first").val();
		//almacenamos el ID del nuevo producto (nuevo)
		let newProId=datos.val();
		//productsSelected es el resultado del método listSelected()
		//filtramos por si ya existe ese nuevo producto en la lista productsSelected
		let test=productsSelected.filter(res=>res==newProId);
		//si test trae algún resultado es que ya existe ese producto en la lista
		if(test.length > 0){
			alert("ya existe ese producto en la lista");
			//mediante el ID Producto actualizamos y volvemos al valor de productos que anterior y detenemos
			datos.val(proId);
			return;
		}else{
			//si no trae resultado modificamos los datos del registro y añadimos los 
			//los datos del registro para después poder guardarlos en la db
			
			//modficamos el id
			let id=datos.val();
			datos.parent().prev().children().val(id);
//no necesario			//almacenamos el nombre 
			//let newProduct=datos.children("option:selected").html();

			//modificamos el precio 
			let price=datos.children("option:selected").attr("data-price");
			datos.parent().next().children("input").val(price);
			//reseteamos la cantidad a 1
			let inputCantidad=datos.parent().nextAll().slice(1,2).find("input");
			inputCantidad.val(1);
			//modificamos el total del producto
			//no es necesario añadir la cantidad puesto que reseteamos a 1, por //tanto, la multiplicación * 1 es la misma, aun así lo añadimos
			let total=parseInt(price)*parseInt(inputCantidad.val());
			datos.parent().nextAll().slice(2,3).find("input").val(total);
			//creamos el objeto y asignamos los datos necesarios para 
			//actualizar todos los productos de la factura en Detalle_factura
			//que han sido modificados. Si se modifica el mismo producto varias veces, actualizará la db las mismas veces(esto se podría optimizar).
			let Dato={};
			Dato.id=proId;
			Dato.newId=newProId;
			Dato.amount=inputCantidad.val();			
			//actualizamos el array editedProducts que después se enviará
			//al dar al botón guardar
			editedProducts.push(Dato);
			$("#datos").val(JSON.stringify(editedProducts));
			loadNet(".list_edit_products");
			loadTotal(".list_edit_products");
			//actualizamos productsSelected que devuelve todos los productos selected
			productsSelected=listSelected();
			console.log(productsSelected);
			
		}
			
	}
	//añadir productos en facturas.edit
	function editAddProductFactura(id,e){
		
		e.preventDefault();
		//console.log(id);return;
		var url="../../addProduct";
		let cantidad=document.querySelector("#cantidadAdd");
		let product=document.querySelector("#producto");
		if(!validacionProducto(product,cantidad))
				return;
		var idProducto=$("#producto").val();
		var idFactura=id;
		let cantidadVal=cantidad.value;
		
		//console.log(cantidad);return;
		//console.log("llega");return;
		//console.log("sum es: "+$(".suma").html());return;
		//console.log(idProducto);return;
		$.ajax({
			type:"POST",
			url:url,
			data:{producto:idProducto,factura:idFactura,cantidad:cantidadVal,_token:"{{ csrf_token() }}"},
			success: function(data){
				//console.log(data);
				$("#categoria").val(0);
				$("#producto").val(0);
				$("#cantidadAdd").val(1);
				$(".list_edit_products").html("");
				$(".list_edit_products").html(data.dato);
				$("#net").val(data.suma);
				let total=data.suma*((100+parseInt($("#vat").val()))/100);
				$("#total").val(Math.round(total));
				productsSelected=listSelected();
				//console.log(productsSelected);				
			},
			error:function(){
				console.log("ErRor");
			}
		});
	}



	



		//evento del input cantidad de un producto	
		$(".seccion_factura").on("input",".cantidad",function(){
			//si en alguno de los productos de la tabla se indica una cantidad
			//de 0 o menor a 0 se establece la última opción válida.
			if($(this).val()<=0){
				alert("la cantidad mínima es 1");

				//obtenemos el anterior resultado con los datos de price y total
				let parentsTd=$(this).parents("td");
				let price=parseInt(parentsTd.prev().find("input").val());
				let totalProduct=parseInt(parentsTd.next().find("input").val());
				let prevAmount=totalProduct/price;
				//asignamos el valor al campo cantidad				
				$(this).val(prevAmount);
				return;
			}

			//obtenemos el valor del ID Producto para el método cantidadDeProducto (al final)			
			let id=parseInt($(this).parents("tr").find("input").first().val());
//no necesario			//almacenamos el nombre
			let name=$(this).parents("td").prev().prev().first().find("option:selected").html();
			
			//valor de precio asociado al producto seleccionado
			let precio=parseInt($(this).parent().prev().find("input").val());
			
			//valor de cantidad
			let cantidad = parseInt($(this).val());
			//total del producto			
			let total=precio*cantidad;

			//actualizamos el total del producto multiplicado por la cantidad
			$(this).parent().next().find("input").val(total);
			//almacenamos neto con el método sumaFinal()
			let neto=sumaFinal();
			//actualizamos el neto
			$("#net").val(neto);
			//convertimos iva a entero
			let iva=parseInt($("#vat").val());
			//total con iva y redondeado
			let totalSum=Math.round(neto*((100+iva)/100));
			$("#total").val(totalSum);

		//añadimos los datos mediante un objeto que pasamos al input hidden datos

			//validamos si añadimos un elemento al array de objetos editedProducts
			//o actualizamos el último elemento del array test

			//test es un array filtrado del array editedProducts del elemento o los elementos del mismo producto del que estamos modificando la cantidad si existen
			let test=editedProducts.filter((item)=>{
				return item.newId==id;
			});
			//si existe test es que el producto ya se encuentra en el array y
			//actualizamos directamente el array editedProducts
			if(test.length > 0){
				//obtenemos el último elemento del array test y actualizamos
				//su cantidad
				let lastTest=test.pop();
				lastTest.amount=cantidad;				
			}else{
				//si no existe se añade un nuevo Dato al array editedProducts
				let Dato={};
				Dato.id=id;
				Dato.newId=id;				
				Dato.amount=cantidad;
				editedProducts.push(Dato);
			}
			//insertamos datos en input hidden
			$("#datos").val(JSON.stringify(editedProducts));
		});

		//evento del input iva
		$("input[name=vat]").on("input",function(){

			//almacenamos neto,iva y total con método loadTotal()
			let neto=parseInt($("#net").val());
			let iva=parseInt($("#vat").val());
			loadTotal(".list_edit_products");
			//let totalSum =loadTotal(neto,iva);
			
			//$("#total").val(totalSum);
		});
		

		
		$("input[type=submit]").on("click",function(e){
			e.preventDefault();
			$("form").submit();

		});
		

		//lista es un array de todos los id selected de productos, es decir,
		//todos los productos de la factura seleccionada que trae la db.
		let lista=listSelected();
		//let sumaTotal;
		//almacena en un array los value de los productos que se encuentran 
		//seleccionados  para poder comprobar si ya existe en la lista la 
		//nueva selección y evitar campos duplicados
		
		
		
		//sumaFinal es la suma de todos los input total de los productos
		function sumaFinal(){
			let total=[];
			//array de los input total de cada producto
			total=[].slice.call(document.querySelectorAll(".total"));
			//array de valores de todos input total
			let newTotal=total.map(function(item){		
				return item.value;
			});
			
			//convertimos el array de string a números
			let suma=newTotal.map(Number);	
			//realizamos la suma con el método reduce (abreviada en tipo flecha) //que permite realizar operaciones con los parámetros
			return suma.reduce((a,b)=>a+b);	
		}


		

		//editSelectProductos actualiza la db y recarga la tabla con la nueva //opción seleccionada, si se ha editado la cantidad de algún producto
		//y no se ha guardado no se tendrá en cuenta y volverán a tener la cantidad
		//que tenían
		function editSelectProductosBack(id){
			let editedProducts=[];
			//volvemos el array data (donde se almacenan los cambios de cantidad) a //vacío
			data=[];
			//var url="../../editProduct";
			//convertimos el elemento que viene parámetro a identificador de //tipo JQuery
			let datos=$(id);					
			//almacenamos el valor de ID Producto
			var pro_id=datos.parent().prev().find("input:first").val();
			//almacenamos el valor del nuevo producto
			let producto_id=datos.val();
		//lista contiene el método listSelected()
			//filtramos por si ya existe ese nuevo producto en la lista
			let test=lista.filter(res=>res==producto_id);
			if(test.length > 0){
				alert("ya existe ese producto en la lista");				
				//mediante el ID Producto actualizamos y volvemos al valor de productos que estaba y detenemos
				datos.val(pro_id);
				return;
			}else{
				console.log();
				//modficamos el id
				let id=datos.val();
				datos.parent().prev().children().val(id);
				//modificamos el precio 
				let price=datos.children("option:selected").attr("data-price");
				datos.parent().next().children("input").val(price);
				//reseteamos la cantidad a 1
				let inputCantidad=datos.parent().nextAll().slice(1,2).find("input");
				inputCantidad.val(1);
				//modificamos el total del producto
				//no es necesario añadir la cantidad puesto que reseteamos a 1, por //tanto, la multiplicación * 1 es la misma, aun así lo añadimos
				let total=parseInt(price)*parseInt(inputCantidad.val());
				datos.parent().nextAll().slice(2,3).find("input").val(total);				
			}			
			let list=$(".list_edit_products ");
			let listaw=list.map((item)=>{
				return item;
			})

			console.log(listaw);
		}

		function deleteProd(el,e){

			e.preventDefault();
			//mostramos modal
			$("#modal_delete").modal("show");
			//evento btn aceptar del modal
			$("#btn-modal-delete").one("click",function(e){
				e.preventDefault();
				//ocultamos modal
				$("#modal_delete").modal("hide");
				//ocultamos fila y eliminamos
				let parentTr=el.parentNode.parentNode				
				parentTr.style.display="none";
				//es necesario eliminar para el array productsSelected
				parentTr.parentNode.removeChild(parentTr);
				//almacenamos cantidad para la segunda petición AJAX
				//let cantidad;
				//se ha asignado un atributo data-id al primer td 
				//por si cambia el value al modificar el select y se 
				//quiere eliminar, elimine el que está almacenado y no
				//los que se hayan cambiado sin guardar. 
				let producto_id=el.parentNode.parentNode.firstElementChild.firstElementChild.getAttribute("data-id");
				
				//console.log(producto_id);

				let factura_id={{$factura->id}};

				//console.log(factura_id);return;
				var promise = $.ajax({
					type:"POST",
					data:{producto:producto_id,factura:factura_id,_token:"{{csrf_token()}}"},
					url:"{{route('destroyProdFactura')}}"
				})
				.done(function(data){
					$("#net").val(data.net);
					$("#total").val(data.total);
					productsSelected=listSelected();
					console.log(productsSelected);
					//actualizar factura y venta
				});
				//anulado

				//promise.then(function(){
				//	productsSelected=listSelected();
				//	console.log(productsSelected);
				//})
				//anulamos promesa.then no necesaria, suficiente con 1 petición,
				//en lugar de 2 peticiones (la primera para mostrar los datos
				//de los productos y la segunda para almacenar la suma en la db,
				//he optado por realizar la operación de suma e iva en php aunque //existe riesgo de que puedan variar de las de JS con el redondeo)

			});
		}
		
		//sustituir por onclick debido al include ajax-edit-table
		/*
		$(".delete_prod").on("click",function(e){

			let btn=$(this);
			
			$("#modal_delete").modal("show");
			//método one para que se vaya duplicando la llamada
			$("#btn-modal-delete").one("click",function(e){
				e.preventDefault();
				$("#modal_delete").modal("hide");
				//ocultamos fila		
				btn.parents("tr").hide();
				let cantidad;
				let producto_id=btn.parents("tr").find("input").first().val();
				console.log("producto_id: ",producto_id);
				let factura_id={{$factura->id}};
				var promise = $.ajax({
					type:"POST",
					data:{producto:producto_id,factura:factura_id,_token:"{{csrf_token()}}"},
					url:"{{route('destroyProdFactura')}}"
				})	
				.done(function(data){
					cantidad=data;
					console.log(data);
					
				});
				
				promise.then(function(){

					$.ajax({
						type:"POST",
						data:{producto:producto_id,factura:factura_id,cantidad:cantidad,_token:"{{ csrf_token() }}"},
						url:"{{ route('reloadFactura') }}"
					})
					.done(function(data){
						//console.log(data);
						//actualizamos campos net y total de la vista
						$("#net").val(data.net);
						$("#total").val(data.total);						
					})
				});
				
				
				//después de eliminar un producto es necesario actualizar la factura
			});
		});
		*/
@endif
//bloque para create
@if(isset($venta_id))
		//evento categorías de productos
		$("#categoria").on("change",function(){
			//if($(this).val()!=0){
				//petición ajax que clasifica el select productos mediante categorías
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
			/*
			}
			else{
				console.log($(this).val());
				//alert("hola");return;
				
			}
			*/
		});
		//evento en el select productos
		//cada vez que seleccionamos un nuevo producto cantidad se resetea a 1.
		$("#producto").on("change",function(){
			//resetCantidad()
		});

//crea objetos y después añade los datos en la tabla
		let listProducts=[];			
		let datos=[];
		function addProductToList(e){
			//producto nuevo a insertar
			let product=document.querySelector("#producto");
			//cantidad nueva a insertar
			let cantidad=document.querySelector("#cantidad");
			//tbody de la tabla
			let list_products=document.querySelector(".list_products");

			//ejemplo de validación con expresiones regulares (anulado)			
			//expresión
			//let chars=new RegExp('^[A-Z]+$','i');
			//^indica que el patrón debe iniciar dentro de los corchetes
			//[A-Z] indica los caracteres permitidos
			// + indica que los caracteres en los corchetes se puede repetir
			// $ indica que el patrón finaliza con los caracteres de los corchetes
			// i indica que es (case-insensitive), no diferencia minúsculas y
			//mayúsculas
			//validar con expresiones regulares
			/*
			if(!chars.test(producto.value)){
				alert("no es una palabra permitida");
			}
			*/

			//validación de producto y cantidad	
			if(!validacionProducto(product,cantidad))
				return;
			
			
			
			//creamos un array que filtra si existe algún producto repetido en el //array de objetos y si existe devuelve el objeto
			let productRepe=datos.filter(item=>item.id==product.value);

			//si productRepe trae resultado se modifica la cantidad del objeto y del //registro de la tabla
			if(productRepe.length > 0){
				//modificamos el objeto sumando la propiedad cantidad que ya tiene //más la nueva cantidad
				productRepe[0].amount=productRepe[0].amount+parseInt(cantidad.value);
				//convertimos a array la colección de hijos(tr) de la tabla //list_products				
				let list=[].slice.call(list_products.children);				
				//filtramos todos los tr del array convertido y el que coincida el
				//primer td (que corresponde con el id del producto) con el id del 
				//nuevo producto agregado
				let lista=list.filter((item)=>{					
					return item.children[0].firstElementChild.value==product.value;
				});				
				//convertimos a array la colección de td del elemento tr que coincide
				lista=[].slice.call(lista[0].children);				
				//actualizamos el valor cantidad del td sumando la cantidad del //nuevo producto 				
				lista[3].firstElementChild.value=parseInt(lista[3].firstElementChild.value)+parseInt(cantidad.value);
				// actualizamos el total del producto
				//lista[4].innerHTML=parseInt(lista[2].innerHTML)*parseInt(lista[3].innerHTML);
				lista[4].firstElementChild.value=parseInt(lista[2].firstElementChild.value)*productRepe[0].amount;

//repasar si es necesario el precio el nombre y el total				
			//si no se crea el nuevo elemento y se añade 
			}else{
				//creamos objeto con los datos del form de productos
				let Dato={},
				//elemento option que se encuentra seleccionado
				productIndex=product.options[product.selectedIndex];
				
				Dato.id=parseInt(product.value);
				Dato.name=productIndex.text;
				Dato.price=parseInt(productIndex.getAttribute("data-price"));
				Dato.amount=parseInt(cantidad.value);
				Dato.total=Dato.price*Dato.amount;

				//añadimos el objeto al array datos
				datos.push(Dato);
				//podemos pasarlo a blanco y pasar el array o añadirlo uno a uno.
				/*
				//opción 1: vaciarlo y pasar array
							//vaciamos la tabla
							list_products.innerHTML="";
							//convertimos a array la colección hijos de listProducts
							datos.map((item)=>{
								//creamos y añadimos el nuevo registro de producto a la tabla
							let td=document.createElement("td");
							td.innerHTML=item.id
							let td2=document.createElement("td");			
							td2.innerHTML=item.name;
							let td3=document.createElement("td");
							td3.innerHTML=item.price;
							let td4=document.createElement("td");
							td4.innerHTML=item.amount;
							let td5=document.createElement("td");
							td5.innerHTML="hola";
							let tr=document.createElement("tr");
							tr.append(td,td2,td3,td4,td5);
							//añadimos al elemento listProducts un elemento tr que contiene 5 //elementos td donde cada td contiene sus datos correspondientes
							list_products.append(tr);
							//reseteamos cantidad a 1			
							//resetCantidad();
							//cargamos el valor de importe neto
							//loadNet();
							//cargamos el valor de importe total
							//loadTotal();

							});
							*/
				//opción 2: añadir uno a uno
				let td=document.createElement("td");				
				//con JQuery
				$("<input/>").attr({type:"number",name:"id",class:"form-control",readonly:"readonly",value:Dato.id}).appendTo(td);				
				//con Javascript
				/*
				let input=document.createElement("input");
				input.type="number";
				input.className="form-control";
				input.value=Dato.id;				
				td.append(input);
				*/				
				let td2=document.createElement("td");
				$("<input/>").attr({type:"text",name:"name",class:"form-control",readonly:"readonly",value:Dato.name}).appendTo(td2);
				let td3=document.createElement("td");
				$("<input/>").attr({type:"text",name:"price",class:"form-control",readonly:"readonly",value:Dato.price}).appendTo(td3);
				let td4=document.createElement("td");
				$("<input/>").attr({type:"text",name:"amount",class:"form-control",readonly:"readonly",value:Dato.amount}).appendTo(td4);
				let td5=document.createElement("td");
				$("<input/>").attr({type:"text",name:"total",class:"form-control",readonly:"readonly",value:Dato.total}).appendTo(td5);		
				let tr=document.createElement("tr");
				tr.append(td,td2,td3,td4,td5);
				list_products.append(tr);
			}			
			//reseteamos el formulario de productos
			document.querySelector("#categoria").value=0;
			product.value=0;
			resetCantidad();
			//actualizamos neto y total
			loadNet(".list_products");			
			loadTotal(".list_products");
			//añadimos el objeto al input
			//document.querySelector("#collection_products").value=JSON.stringify(datos);
			document.querySelector("#datos").value=JSON.stringify(datos);
		}


@endif

//MÉTODOS COMPATIBLES CON LAS 2 VISTAS

	//método que aplica el iva al precio indicado
	/*
	function loadTotal(netVal,ivaVal){
		let sumTotal=Math.round(netVal*((100+ivaVal)/100));
		return sumTotal;
	}
	*/

	//resetea a 1 el campo cantidad de agregar producto
	function resetCantidad(){
		document.querySelector("#cantidad").value=1;
	}
		
	//realiza la suma del total de todos los productos de la tabla
	function suma(div){

		let list_products=document.querySelector(div);
		//convertimos a array los hijos (tr) de la tabla list_products
		let tr=[].slice.call(list_products.children);
		//obtenemos todos los total de todos los productos
		let totalProducts=tr.map((item)=>{			
			return parseInt(item.children[4].firstElementChild.value);
		});
		//realizamos la suma a los elementos del array
		let suma=totalProducts.reduce((a,b)=>(a+b));
		return suma;
	}
		
	//actualiza el campo importe neto
	function loadNet(div){
		let sum=suma(div);
		document.querySelector("#net").value=sum;
	}
		
	//actualiza el campo importe total
	 
	function loadTotal(div){
		let sum=suma(div);
		let vat=parseInt(document.querySelector("#vat").value);
		document.querySelector("#total").value=Math.round(sum*((100+vat)/100));
	}

	//validación de producto y cantidad
	function validacionProducto(product,cantidad){
		if(!product||product.value==null||product.value==0){
			alert("debe seleccionar un producto");
			return;
		}
		else if(cantidad.value <= 0){
			alert("la cantidad no puede ser menor a 1");
			return;
		}
		else{
		return true;	
		}
	}

	function listSelected(){

			var prod=[];
			//NodeList del select productos
			let products=document.querySelectorAll(".productos");

			//convertimos el NodeList a array
			let lista=[].slice.call(products);
			
			//creamos un array mapeo que contiene la posición de los option selected
			let mapeo=lista.map(function(select){
				return select.options.selectedIndex;
			});			
			//rellenamos el array prod recorriendo el array lista y pasándole 
			//el array mapeo indicando la posición, de esta forma obtenemos un //array con los value de todos los elementos con atributo selected  
			for(var i=0;i<lista.length;i++){
				prod.push(lista[i].options[mapeo[i]].value);
			}
			return prod;
		}
		
	</script>
	@endsection


