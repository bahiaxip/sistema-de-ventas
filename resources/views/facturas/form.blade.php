{{-- comentarios --}}
{{-- <div class="card seccion_productos">
	@include("facturas.ajax-product")
</div>--}}
<div class="row">
	<div class="col text-center">
		<h5>Productos</h5>
	</div>
</div>
{{-- si existe $productos_factura es la sección de edición(edit) --}}
@if(isset($productos_factura))
<div class="row seccion_factura">
	@include("facturas.ajax-edit")
</div>

@endif
{{-- si existe $venta_id es la sección de creación(create) --}}
@if(isset($venta_id))

	<div class="form-group row">
		<div class="col-10 col-lg-3">
			{{ Form::label("categoria","Categoría ") }}
			{{ Form::select("categoria",$categorias,null,["class"=>"form-control"]) }}
		</div>
		<div class="col-10 col-lg-4"> 
			{{ Form::label("producto","Productos") }}
			<select name="producto" id="producto" class="form-control">
				<option value="0">Seleccione producto</option>
				@foreach($productos as $pro)
					<option value="{{$pro->id}}" data-price="{{$pro->price}}" data-code="{{$pro->code}}">{{$pro->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-10 col-lg-2">
			{{ Form::label("cantidad","Cantidad") }}
			{{ Form::number("cantidad",1,["class"=>"form-control"])}}
		</div>
		<div class="col-5 pt-3 col-lg-1 pt-lg-0 align-self-end">
			<!--@{{ Form::submit("Agregar",["class"=>"btn btn-primary","onclick"=>"addProductToList(event)"])}}-->
			{{ Form::button("Agregar",["class"=>"btn btn-black","onclick"=>"addProductToList()"])}}
		</div>
		&nbsp;&nbsp;
		<div class="col-5 mt-3 col-lg-1 pt-lg-0  align-self-end">
			{{ Form::button("Escaner",["class"=>"btn btn-black","id"=>"btn-modal-scanner","data-toggle"=>"modal","data-target"=>"#modal-scanner"])}}				
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
		{{ Form::number("vat",$vat->data,["class"=>"form-control","readonly"=>"readonly"]) }}
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
{{-- Diferenciar si el onclick es para create o para edit, para edit no comprobar lista con testStock() --}}
{{ Form::button("Guardar",["class"=>"btn btn-black","onclick"=>"testStock(this,event)"]) }}

	@section("scripts")
	<script>		
		let productsSelected=listSelected();
		let panelOculto=document.querySelector(".panel_fondo");
//BLOQUE PARA EDIT
			//Recuerde: Śe encuentra en la sección de edición: las opciones agregar y eliminar actualizan la factura automáticamente.
@if(isset($factura))
	//variable que almacena la lista de productos al cargar la página
	var tabla;	
	$(document).ready(function(){
		var datos=0;
		var url="../../loadProduct";
		asignId(datos,url);
		tabla=listaCantidad();		
		console.log(tabla);
	});
	
	function testStock(element,event){
		//edición de factura
		//en caso de haber eliminado un producto o categoría (aunque está desaconsejado)
		//se suma el importe total de todos los productos y se actualiza el neto y el total		
		let listTr=document.querySelector(".list_edit_products").children;
		arrayTr=[].slice.call(listTr);
		//lista de importes de cada producto de la lista
		lista=arrayTr.map( item => {
			return Number(item.children[4].children[0].value);
		})		
		//convertimos a número //anulado (añadido Number al map de lista)
		//let totalNet=lista.map(Number);
		
		//suma de todos los totales de la lista convertido a entero
		let net=lista.reduce((a,b)=>a+b).toFixed(2);

		//IVA convertido a entero
		let vat=parseInt(document.querySelector("#vat").value);	
		//redondeo de operación matemática con Math.round
		//(100+iva)/100 retorna el resultado con IVA aplicado (aplicando primero la suma)
		let totalSum=(net*(100+vat)/100);		
		//asignamos los valores a los campos
		document.querySelector("#net").value=net;
		document.querySelector("#total").value=totalSum.toFixed(2);
		//enviar formulario
		element.parentNode.submit();
	}
	//simplificamos: un evento sirve para el create y para el edit
	/*
	$("#categoria").on("change",function(){
		if($(this).val!=0){
			var datos=$(this).val();
			let rootUrl="{{asset('/')}}";
			var url=rootUrl+"/loadProduct";
			asignId(datos,url);
		}
	});
	*/
	
	let	editedProducts=[],
		sumaTotal;

	//añadir productos en facturas.edit	
	function editAddProductFactura(id,e){
		//validamos los campos de cantidad y producto
		let cantidad=document.querySelector("#cantidadAdd");
		let product=document.querySelector("#producto");
		if(!validacionProducto(product,cantidad))
					return;		
		//incluimos la opción de no descontar el stock mediante un modal
		$("#modal-stock-edit").modal("show");
		//si pulsamos Aceptar continuamos si no detenemos
		$("#btn-modal-stock-edit").one("click",function(e){
			e.preventDefault();
			//mostrar loading...			
			mostrarPanelOculto(panelOculto);
			//comprobar stock		
			var url="../../addProduct";			
			//ocultamos el div de info-factura (create.blade y edit.blade)				
			document.querySelector(".info-factura").style.display="none";
			var idProducto=$("#producto").val();
			var idFactura=id;
			let cantidadVal=cantidad.value;
			console.log(cantidadVal);
			let check;
			if(document.querySelector("#checkbox-stock-edit").checked){
				check="true";
			}else{
				check="false";
			}			
			//se añade el producto y se actualiza la lista
			$.ajax({
				type:"POST",
				url:url,
				data:{producto:idProducto,factura:idFactura,cantidad:cantidadVal,checkBox:check,_token:"{{ csrf_token() }}"},
				success: function(data){
					$("#modal-stock-edit").modal("hide");
					if(data=="!STOCK"){						
						sendMessage("El producto no dispone de suficiente stock disponible");
						return;
					}
					$("#categoria").val(0);
					$("#producto").val(0);
					$("#cantidadAdd").val(1);
					$(".list_edit_products").html("");
					$(".list_edit_products").html(data.dato);
					$("#net").val(data.suma.toFixed(2));
					
					let total=data.suma*((100+parseInt($("#vat").val()))/100);
					$("#total").val(total.toFixed(2));
					productsSelected=listSelected();
					//actualizamos la variable global tabla
					tabla=listaCantidad();				
				},
				complete:function(){
					//ocultar loading...
					ocultarPanelOculto(panelOculto);
				},
				error:function(){
					console.log("ErRor");
				}
			});
		})
	}

	//evento del input cantidad de un producto	
	$(".seccion_factura").on("input",".cantidad",function(){		
		let form=this;		
		let inputCantidad=$(this).val();
		let inputTouch=$(this);
		if($(this).val()<=0){
			alert("la cantidad mínima es 1");
			//obtenemos el anterior resultado con los datos de price y total
			//del mismo producto
			let parentsTd=$(this).parents("td");
			let price=parseInt(parentsTd.prev().find("input").val());
			let totalProduct=parseInt(parentsTd.next().find("input").val());
			let prevAmount=totalProduct/price;
			//asignamos el valor al campo cantidad				
			$(this).val(prevAmount);
			return;
		}
		//realizamos la comprobación de stock y actualizamos la db.
		//obtenemos el valor del ID Producto para el método cantidadDeProducto (al final)		
		let id=parseInt($(this).parents("tr").find("input").first().val());
		let name=$(this).parents("td").prev().prev().first().find("option:selected").html();		
		//valor de precio asociado al producto seleccionado
		let precio=$(this).parent().prev().find("input").val();		
		//valor de cantidad
		let cantidad = parseInt($(this).val());
		//total del producto			
		let total=(parseFloat(precio)*cantidad).toFixed(2);		
		let cantidadInicial;
		//mediante tabla obtenemos la cantidad inicial al cargar la página
		tabla.forEach((element) => {
			if(element.id==id){
				cantidadInicial=element.cantidad;
			}
		})				
		//petición AJAX de comprobación de stock
		//mostrar loading...			
		mostrarPanelOculto(panelOculto);
		var keyStock="false";
		var promise=$.ajax({
			type:"POST",
			url:"../../test_stock_edit",
			data:{id:id,cantidad_final:cantidad,cantidad_inicial:cantidadInicial,_token:"{{csrf_token()}}"},
			success:function(data){
				//console.log(data);return;
				if(data=="true"){

					//sendMsg("El producto se ha actualizado satisfactoriamente");
				}
				else if(data=="false"){
					sendMsg("El producto no dispone de suficiente stock disponible");
					
					let tr=[].slice.call(document.querySelector(".list_edit_products").children);
					tr.forEach(element => {
						if(element.children[0].children[0].value==id){
							element.children[3].children[0].value=cantidadInicial;
						}
					})					
					keyStock="true";					
				}else{
					sendMsg("Ha ocurrido un error en la petición ajax");
				}					
				tabla=listaCantidad();
			},
			complete:function(){
				ocultarPanelOculto(panelOculto);	
			},
			error:function(){
				ocultarPanelOculto(panelOculto);
				console.log("Error en la petición AJAX");
			}
			
		});
				
		promise.then(function(){		
			if(keyStock!="true"){
				mostrarPanelOculto(panelOculto);
				//actualizamos el total del producto multiplicado por la cantidad
				inputTouch.parent().next().find("input").val(total);			
				//almacenamos neto con el método sumaFinal()
				let neto=sumaFinal();
				//actualizamos el neto
				$("#net").val(neto.toFixed(2));
				//convertimos iva a entero
				let iva=parseInt($("#vat").val());
				//total con iva y redondeado
				//anulamos redondeo
				//let totalSum=Math.round(neto*((100+iva)/100));
				let totalSum=(neto*((100+iva)/100)).toFixed(2);
				$("#total").val(totalSum);				
				let state= $("#state").val();
				let order_buy=$("#order_buy").val();
				let office_guide=$("#office_guide").val();
				let id_factura={{$factura->id}};
				let url2 = "../../update_edit";
				let data2 = {idFactura:id_factura,id:id,cantidad:cantidad,neto:neto,iva:iva,totalSum:totalSum,state:state,orderBuy:order_buy,officeGuide:office_guide,_token:"{{csrf_token()}}"};
				var promise2=$.ajax({				
					type:"POST",
					url:url2,
					data:data2,
					success:function(data){
						console.log(data);
					},
					complete:function(){
						ocultarPanelOculto(panelOculto);
					},
					error:function(){
						console.log("Error en la petición AJAX");			
					}
				})				
				promise2;
			}
		});		
	});
	
	//evento del input iva
	$("input[name=vat]").on("input",function(){
		//almacenamos neto,iva y total con método loadTotal()
		let neto=$("#net").val();
		let iva=parseInt($("#vat").val());
		loadTotal(".list_edit_products");		
	});
	/*anulado
	$("input[type=submit]").on("click",function(e){
		e.preventDefault();
		$("form").submit();

	});
	*/
	//sumaFinal es la suma de todos los input total de los productos
	function sumaFinal(){
		let total=[];
		//array de los input total de cada producto
		total=[].slice.call(document.querySelectorAll(".total"));
		//array de valores de todos input total
		let newTotal=total.map(function(item){		
			return item.value;
		});		
		let suma=newTotal.map(Number);		
		return suma.reduce((a,b)=>a+b);	
	}
	//Eliminar productos (de uno en uno) en edición de factura mediante ajax
	//Añadir si se devuelve o no el stock del producto eliminado
	function deleteProd(el,e){
		e.preventDefault();
		//mostramos modal
		$("#modal_delete").modal("show");
		//evento btn aceptar del modal
		$("#btn-modal-delete").one("click",function(e){
			e.preventDefault();
			//ocultamos modal
			$("#modal_delete").modal("hide");
			//ocultamos fila y eliminamos tr
			let parentTr=el.parentNode.parentNode;

			parentTr.style.display="none";			
			parentTr.parentNode.removeChild(parentTr);
			//console.log("parentTr");return;
			//asignamos data id en el primer td el valor total del producto			
			let producto_id=el.parentNode.parentNode.firstElementChild.firstElementChild.getAttribute("data-id");
			//almacenamos el id de la factura
			let factura_id={{$factura->id}};
			//petición ajax
			//
			let check="false";
			if(document.querySelector("#checkbox-delete-register").checked)
				check="true";
			//console.log("data");return;
			mostrarPanelOculto(panelOculto);
			var promise = $.ajax({
				type:"POST",
				data:{producto:producto_id,factura:factura_id,checkBox:check,_token:"{{csrf_token()}}"},
				url:"{{route('destroyProdFactura')}}"
			})
			.done(function(data){
				//console.log(data);
				updateNetTotal(data.net,data.total);
				productsSelected=listSelected();
				//actualizamos tabla (variable global)
				tabla=listaCantidad();
				ocultarPanelOculto(panelOculto);
			});
			//actualizar campo neto y total de la factura
			const updateNetTotal= (net,total)=> {
				document.querySelector("#net").value=net.toFixed(2);
				document.querySelector("#total").value=total.toFixed(2);
			}
		});
	}

@endif

//BLOQUE PARA CREATE

@if(isset($venta_id))
	const testStock=(element,e) => {
		e.preventDefault();//prescindible		
		let productos=document.querySelector(".list_products").children;		
		if (productos.length == 0){
			sendMessage("No se ha seleccionado ningún producto");
		}
		var lista=[].slice.call(productos);		
		if(lista.length == 0)
			return;
		var data=[];
		lista.map((tr) => {			
			data.push({
				id:tr.childNodes[0].childNodes[0].value,
				amount:tr.childNodes[3].childNodes[0].value
			});
		});		
		$.ajax({
			type:"POST",
			data:{data:data,_token:"{{csrf_token()}}"},
			url:"../test_stock",
			success: function(data){				
				if(data["data"]=="true"){					
					element.parentNode.submit();					
				}
				else if(data["data"]=="false"){
					if(data["name"].length == 1){
						sendMessage("El producto "+data["name"]+" no tiene suficiente stock disponible");
					}else{
						sendMessage("Los productos "+data["name"]+" no tienen suficiente stock disponible");
					}					
					
					return;					
				}else{					
					sendMessage("Se ha producido un error, o el producto añadido no existe");					
					return;
				}				
			},
			error:function(){
				sendMessage("Error de datos al crear la factura");
				console.log("Error petición Ajax: testStock()")
			}	
		})		
	}
	//simplificamos: un evento sirve para el create y para el edit
	//evento categoría que actualiza el select de productos que se encuentra a justo al lado.
	/*
	$("#categoria").on("change",function(){		
			var datos=$(this).val();			
			let rootUrl="{{asset('/')}}";			
			asignId(datos,rootUrl+"loadProduct");			
	});
	*/

	let listProducts=[];			
	let datos=[];
	//addProductToList añade productos a la nueva factura
	function addProductToList(e){		
		//producto nuevo a insertar
		let product=document.querySelector("#producto");
		//cantidad nueva a insertar
		let cantidad=document.querySelector("#cantidad");
		//lista de productos
		let list_products=document.querySelector(".list_products");		
		//validación de producto y cantidad	
		if(!validacionProducto(product,cantidad))
			return;
		//se oculta mensaje por si validacionProducto hubiera dado un resultado 
		//negativo anteriormente
		document.querySelector(".info-factura").style.display="none";
		//productRepe obtiene resultado si el producto ya se encuentra en la lista
		addListProd(product,cantidad,list_products);
	}
	//buildProduct crea un objeto con el id,nombre,precio,cantidad y precio total
	const buildProduct = (product) => {
		let Product={};
		let productIndex=product.options[product.selectedIndex];
		Product.id=parseInt(product.value);
		Product.name=productIndex.text;
		Product.price=parseFloat(productIndex.getAttribute("data-price")).toFixed(2);
		console.log("productIndex: ",Product.price);
		Product.amount=parseInt(cantidad.value);
		Product.total=(Product.price*Product.amount).toFixed(2);
		return Product;
	}
	//buildRow crea un elemento tr con 5 elementos td con el objeto pasado
	const buildRow = (dato) =>{
		let tr=document.createElement("tr"),
			td=document.createElement("td"),
			td2=document.createElement("td"),
			td3=document.createElement("td"),
			td4=document.createElement("td"),
			td5=document.createElement("td");
			$("<input/>").attr({type:"number",name:"id",class:"form-control",readonly:"readonly",value:dato.id}).appendTo(td);			
			$("<input/>").attr({type:"text",name:"name",class:"form-control",readonly:"readonly",value:dato.name}).appendTo(td2);			
			$("<input/>").attr({type:"text",name:"price",class:"form-control",readonly:"readonly",value:dato.price}).appendTo(td3);			
			$("<input/>").attr({type:"text",name:"amount",class:"form-control",readonly:"readonly",value:dato.amount}).appendTo(td4);			
			$("<input/>").attr({type:"text",name:"total",class:"form-control",readonly:"readonly",value:dato.total}).appendTo(td5);			
			tr.append(td,td2,td3,td4,td5);
			return tr;
	} 
	//añade el producto a la lista o aumenta o disminuye su cantidad si ya se
	//encuentra en la lista
	const addListProd= (product,amount,listProducts) => {
		let productMatch=[];
		productMatch=datos.filter(item => item.id==product.value);
		//si productMatch contiene algun elemento, quiere decir que 
		//el producto ya se encuentra en la lista de productos
		if(productMatch.length>0){
			productMatch[0].amount=productMatch[0].amount+parseInt(cantidad.value);
			//list es un array de los elementos tr de la lista (de productos)
			let listTr=[].slice.call(listProducts.children);
			//lista es un array que filtra el elemento tr que contiene el mismo id
			//que el producto a agregar 
			let listaTr=listTr.filter((item)=>{					
				return item.children[0].firstElementChild.value==product.value;
			});
			//lista lo convertimos a un array con los td del elemento de la lista
			//que coincide con el que se quiere agregar
			listaTd=[].slice.call(listaTr[0].children);
			listaTd[3].firstElementChild.value=parseInt(listaTd[3].firstElementChild.value)+parseInt(amount.value);
			let total=parseFloat(listaTd[2].firstElementChild.value)*listaTd[3].firstElementChild.value;
			listaTd[4].firstElementChild.value=total.toFixed(2);
		}else{			
			let Dato=buildProduct(product);
			console.log(Dato);		
			datos.push(Dato);			
			listProducts.append(buildRow(Dato));
		}
		//reseteamos el formulario de productos
		document.querySelector("#categoria").value=0;
		product.value=0;
		cantidad.value=1;
		//actualizamos neto y total		
		let sum=suma(".list_products");		
		document.querySelector("#net").value=sum;			
		loadTotal(".list_products");
		//añadimos el objeto al input	
		document.querySelector("#datos").value=JSON.stringify(datos);
	}

	//ventana modal-scanner en creación de factura
	$("#modal-scanner").on("shown.bs.modal",function(){	
	let scan=$("#input-scanner");
	$("#input-scanner").trigger("focus");
	$("#input-scanner").one("change",function(ev){
		$("#modal-scanner").modal("hide");
		//console.log($("#input-scanner").val());
		if(scan.val()!=""){
			//no se realiza consulta con ajax, es solo javascript
			let product=document.querySelector("#producto");			
			//creamos array para obtener el value
			options=[].slice.call(product.options);
			let search=options.filter( item => {
				return item.getAttribute("data-code")==scan.val();
			})
			if(search.length>0){
				product.value=search[0].value;
			}else{
				product.value=0;
				console.log("no existe ese producto");
			}
			$("#input-scanner").val("");
		}else{
			console.log("No se ha introducido ningún código");
		}		
	})
})

@endif

//MÉTODOS COMPATIBLES CON LAS 2 VISTAS

	$("#categoria").on("change",function(){		
		var datos=$(this).val();			
		let rootUrl="{{asset('/')}}";			
		asignId(datos,rootUrl+"loadProduct");			
	});

	const asignId = (datos,url) =>{
		$.ajax({
			type:"GET",
			data: {data: datos},
			url:url,					
			success: function(data){					
				$("select[name='producto'").html("");
				$("select[name='producto'").html(data.datos);					
			},
			error: function(data){
				console.log("Error en assignId, datos: ",data);
			}
		})
	}	
	//método sendMessage utilizado en la sección create	
	const sendMessage = (message) => {
		let divInfoBody = document.querySelector(".info-factura-body");
		let divInfo = document.querySelector(".info-factura");
		divInfoBody.innerHTML=message;
		divInfo.style.display="block";
		window.scroll({
			top:0
		})
	}
	//método que envía mensaje utilizado en la sección edit
	const sendMsg= (message) => {
		let divInfo= document.querySelector(".info-factura"),
			divInfoBody=document.querySelector(".info-factura-body");
		divInfoBody.innerHTML=message;
		divInfo.style.display="block";
		window.scroll({
			top:0
		})
	}		
	//realiza la suma del total de todos los productos de la tabla
	function suma(div){
		let list_products=document.querySelector(div);		
		//convertimos a array los hijos (tr) de la tabla list_products
		let tr=[].slice.call(list_products.children);
		//obtenemos todos los total de todos los productos
		let totalProducts=tr.map((item)=>{			
			return parseFloat(item.children[4].firstElementChild.value);
		});
		//realizamos la suma a los elementos del array
		let suma=totalProducts.reduce((a,b)=>(a+b));
		return suma.toFixed(2);
	}
		
	//actualiza el campo importe total	 
	function loadTotal(div){
		let sum=suma(div);
		console.log(sum);
		let vat=parseInt(document.querySelector("#vat").value);
		//document.querySelector("#total").value=Math.round(sum*((100+vat)/100));
		let resultTotal=sum*((100+vat)/100);
		console.log(resultTotal.toFixed(2));
		document.querySelector("#total").value=resultTotal.toFixed(2);
	}

	//validación del select producto y campo cantidad al agregar un nuevo producto, ya sea en la creación o en la edición
	function validacionProducto(product,cantidad){
		if(!product||product.value==null||product.value==0){
			//alert("debe seleccionar un producto");
			sendMsg("debe seleccionar un producto");
			return;
		}
		else if(cantidad.value <= 0){
			//alert("la cantidad no puede ser menor a 1");
			sendMsg("la cantidad no puede ser menor a 1");
			return;
		}
		else{
			return true;	
		}
	}
	//método listSelected recorre los registros de productos del select y devuelve 
	//un array de los id de dichos productos.
	//(al haber desactivado el campo select con el atributo disabled se podría 
	//haber sustituido el select por un input con el atibuto read-only pero lo 
	//mantenemos así para no rehacer todo de nuevo.)
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
		//método que devuelve un array de objetos de los id de los productos
		//de la factura y sus cantidades.{id:id-producto,cantidad:cantidad-producto}
	let listaCantidad = () => {
		let tablaEdit = document.querySelectorAll(".tabla-edit");
		//return tablaEdit[0];
		let lista = [].slice.call(tablaEdit);		
		let m=[{}];
		let productId = lista.map((tr) => {			
			let tr0= tr.children[0];
			let tr3 = tr.children[3];			
			return {id:tr0.firstElementChild.value,cantidad:tr3.firstElementChild.value};
		})
		return productId;
	}

	//mostrar panel oculto
	const mostrarPanelOculto = (panel) => {

		panel.style.visibility="visible";
		//panel.style.width="100%";
		//panel.style.height="100%";
		//panel.style.left="0";
		console.log("ei");
	}
	const ocultarPanelOculto = (panel) => {
		panel.style.visibility="hidden";
		//panel.style.width="0%";
		//panel.style.height="0%";
		//panel.style.left="-100";	
	}
	</script>
	@endsection