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
@if(isset($categorias))	
	<div class="form-group row">
		<div class="col-10 col-lg-3">
			{{ Form::label("categoria","Categoría de Producto") }}
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
			{{ Form::button("Agregar",["class"=>"btn btn-primary","onclick"=>"addProductToList()"])}}
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
	{{ Form::hidden("collection_products",null,["id"=>"collection_products"]) }}
	{{ Form::hidden("datos",null,["id"=>"datos"])}}

	@if(isset($venta_id))
		{{ Form::hidden("venta_id",$venta_id) }}
	@endif

{{ Form::submit("Guardar",["class"=>"btn btn-primary"]) }}

	@section("scripts")
	<script>
		//bloque para edit
@if(isset($factura))
	
	//lista es un array de todos los id selected de productos, es decir,
	//todos los productos de la factura seleccionada que trae la db.
	let productsSelected=listSelected();
	let editedProducts=[];
	let sumaTotal;

	//repasar todo pk solo se necesita id anterior, id del nuevo producto y cantidad 
	function editSelectProductos(id){
		
		
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
			console.log(editedProducts);
		}
			
	}



	//ANULADO
		//En esta parte de Javascript la cantidad de los productos actualizalel //total del producto y el total de factura, para guardarlo en la db se //almacena en un array y al guardar se actualizan, el select en cambio
		//es una petición ajax que actualiza cada vez que editamos un select
		//la petición ajax para el select anulado

		

		/*
		//array de todos los productos de un select con javascript	
		var prod=[];
		var productos=document.getElementById("productos");
		for(var i=0;i<productos.length;i++){
			prod=prod+productos.options[i].text;
			console.log(productos.options[i].text);	
		}
		*/

		
		

		//evento a elemento cantidad en Javascript
		/*
		let inputNumber=document.querySelector(".cantidad");
		inputNumber.oninput= function(){
			console.log(parseInt(this.parentNode.previousElementSibling.innerHTML));	
			console.log(this.value);
			console.log("wow");
		}
		*/
		//evento a elemento cantidad en JQuery
		/*
		$(".cantidad").on("input",function(){
			//console.log($(this).parent().parent().prev().find("input").val());
			let precio=$(this).parent().parent().prev().find("input").val();
			
			
		});
		*/
		//Cantidad Producto es una clase que almacena el id del producto y la cantidad
		//anulada y sustituida por un objeto simple
		/*
		class CantidadProducto{		

			constructor(id,cantidad){
				this.id=id;
				this.cantidad=cantidad;
				
			}		
		};
		*/
		//data no es necesario
		//let data=[];

//repasar pk solo se necesita id anterior, id del nuevo producto y cantidad 

		//evento del input cantidad de un producto	
		$(".seccion_factura").on("input",".cantidad",function(){			
			//obtenemos el valor del ID Producto para el método cantidadDeProducto (al final)			
			let id=parseInt($(this).parents("tr").find("input").first().val());
//no necesario			//almacenamos el nombre
			let name=$(this).parents("td").prev().prev().first().find("option:selected").html();
			
			//valor de precio asociado al producto seleccionado
			let precio=$(this).parent().parent().prev().find("input").val();
			//valor de cantidad
			let cantidad = parseInt($(this).val());
			//total del producto			
			let total=precio*cantidad;
			//actualizamos el total del producto multiplicado por la cantidad
			$(this).parent().parent().next().find("input").val(total);
			//almacenamos neto con el método sumaFinal()
			let neto=sumaFinal();
			//actualizamos el neto
			$("#net").val(neto);
			//convertimos iva a entero
			let iva=parseInt($("#vat").val());
			//total con iva y redondeado
			let totalSum=Math.round(neto*((100+iva)/100));

			$("#total").val(totalSum);

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
				console.log(lastTest);
			}else{
				//si no existe se añade un nuevo Dato al array editedProducts
				let Dato={};
				Dato.id=id;
				Dato.newId=id;				
				Dato.amount=cantidad;
				editedProducts.push(Dato);
				$("#datos").val(JSON.stringify(editedProducts));				
			}
		});

		//evento del input iva
		$("input[name=vat]").on("input",function(){
			//almacenamos neto,iva y total con método loadTotal()
			let neto=$("#net").val();
			let iva=parseInt($("#vat").val());
			let totalSum =loadTotal(neto,iva);
			$("#total").val(totalSum);
		});
		

		
		$("input[type=submit]").on("click",function(e){
			e.preventDefault();
//new Set para eliminar duplicados

				//con ...new Set(array) eliminamos los duplicados
				//en este caso al ser objeto necesitamos añadir el método map
				//para buscar una propiedad con entero(id)
				
				//con este otro método elimina los duplicados y mantiene el primero pero solo devuelve un array de los enteros
				
		//let sinRepetidos=[...new Set(data.map(x=>x.id))];
				
				
				//con este Array.from, new Set y doble map obtenemos el array //de objetos eliminando los duplicados y devuelve el array con //las 2 propiedades del objeto

				//otra opción es que se puede pasar todos los datos y en php //eliminar los duplicados con array_unique
				
				//let listaSinDuplicados=Array.from(new Set(data.map(x=>x.id)))
				//	.map(id=>{
				//	return {
				//		id:id,
				//		cantidad: data.find(x=>x.id===id).cantidad
				//	};
				//});

				//convertimos a string el array de objetos 
				//let list=JSON.stringify(listaSinDuplicados);
				
				//asignamos data como valor del input hidden
				//$("#data_cantidad").val(list);
		});
		

		//lista es un array de todos los id selected de productos, es decir,
		//todos los productos de la factura seleccionada que trae la db.
		let lista=listSelected();
		//let sumaTotal;
		//almacena en un array los value de los productos que se encuentran 
		//seleccionados  para poder comprobar si ya existe en la lista la 
		//nueva selección y evitar campos duplicados
		
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
			//console.log(mapeo);
			//rellenamos el array prod recorriendo el array lista y pasándole 
			//el array mapeo indicando la posición, de esta forma obtenemos un //array con los value de todos los elementos con atributo selected  
			for(var i=0;i<lista.length;i++){
				prod.push(lista[i].options[mapeo[i]].value);
			}
			return prod;
		}
		
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
				//datos.parent().nextAll().slice(2,2).find("input").val(total);
				//datos.parent().next().next().find("input").val(parseInt(price));
				//datos.parent().next().next().find("input").val();
			}
			//document.querySelectorAll(".productos");
			let list=$(".list_edit_products ");
			let listaw=list.map((item)=>{
				return item;
			})

			console.log(listaw);
			/*
			//anulado necesario modificar para que no guarde al modificar el select
			//es decir solo modificar en el lado del cliente hasta que guarde
			else{			
				$.ajax({
					type:"GET",			
					data:{producto:pro_id,nuevoProducto:producto_id,factura:<?php echo $factura->id; ?>},
					url:url,
					//dataType:"json",
					success:function(data){
						$(".seccion_factura").html(data);
						//actualizamos sumaTotal con el método sumaFinal que 
						//suma todos los total de los productos
						sumaTotal=sumaFinal();
						//asignamos el campo de importe neto
						$("#net").val(sumaTotal);
						//convertimos a entero el valor de iva
						let iva=parseInt($("#vat").val());
						//obtenemos el total con el iva aplicado
						let total=Math.round(sumaTotal*((100+iva)/100));
						//asignamos el valor total de la factura
						$("#total").val(total);


						//añadimos otra petición ajax por seguridad
						//ya que el resultado final de la factura se ejecuta
						//en javascript en la vista y si no se guarda manualmente
						//podría dar error en los resultados de las facturas

						$.ajax({						
							type:"GET",
							data:{id:{{$factura->id}},net:$("#net").val(),vat:$("#vat").val(),total:$("#total").val(),state:$("#state:checked").val(),order_buy:$("#order_buy").val(),office_guide:$("#office_guide").val()},
							url:"<?php echo route('storeResult');?>",
							success:function(dat){
								console.log(dat);
							},
							error:function(){
								console.log("ERROR");
							}
						});

					},
					error:function(){
						console.log("ERror");
					}

				});
				//actualizamos lista al editar un select
				lista=listSelected();
				
				
				

			}
			*/

			
		}
		
		/*
		$(".delete_prod").on("click",function(e){
			e.preventDefault();
			//ocultamos fila		
			$(this).parents("tr").hide();
			let producto_id=$(this).parents("tr").find("input").first().val();
			let factura_id={{$factura->id}};
			$.ajax({
				type:"POST",
				data:{producto:producto_id,factura:factura_id,_token:"{{csrf_token()}}"},
				url:"{{route('destroyProdFactura')}}",
				success:function(data){
					console.log(data);
				},
				error:function(){
					console.log("ErRor");
				}
			});
		});
		*/
@endif
//bloque para create
@if(isset($categorias))
		$("#categoria").on("change",function(){
			//if($(this).val()!=0){

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

		//cada vez que seleccionamos un nuevo producto cantidad se resetea a 1.
		$("#producto").on("change",function(){
			//resetCantidad()
		});

//método para create
/*
este método sería quizás más eficiente si en lugar de insertar tr en la tabla
y después extraer de los tr un array de objetos, al revés, es decir, crear un array de objetos y después insertar los tr en la tabla listProducts
*/
/*
		let listProducts=[];			

		function addProductToList(e){
			//producto nuevo a insertar
			let product=document.querySelector("#producto");
			//cantidad nueva a insertar
			let cantidad=document.querySelector("#cantidad");
			
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
			
			//if(!chars.test(producto.value)){
			//	alert("no es una palabra permitida");
			//}
			

			//validaciones		
			if(!product||product.value==null||product.value==0){
				alert("no existe producto");
				return;
			}
			if(cantidad.value<=0){
				alert("la cantidad no puede ser 0");
				return;
			}
			
			let tr=document.createElement("tr"),
				td=document.createElement("td"),
				//elemento option que se encuentra seleccionado				
				productIndex=product.options[product.selectedIndex],
				//el producto.value es el id del producto seleccionado para agregar
				id=producto.value;
				
				
				//tbody de la tabla
			listProducts=document.querySelector(".list_products");
			//convertimos a array la colección hijos de listProducts
			listTr=[].slice.call(listProducts.children);
			//creamos array filtrando los elementos tr para saber si existe el //mismo id del producto seleccionado en la tabla. Este filter //devuelve un array con el tr del producto que ya existe en la tabla y que su id coincide con el id del producto a insertar
			let TdId=listTr.filter((item)=>{
				return parseInt(item.firstElementChild.innerHTML)==id;
			});
			//SI EXISTE REPETIDO
			//si TdId contiene algún resultado, quiere decir que intentamos insertar un producto que ya existe en la tabla
			if(TdId.length > 0){
				//obtenemos el campo cantidad del producto que ya existe en la //tabla convertido a entero
				let cantidadProductoRepe=parseInt(TdId[0].children[3].innerHTML);
				//realizamos la suma de cantidad insertado más el producto ya 
				//existente en la tabla y actualizamos el campo
				let suma=cantidadProductoRepe+parseInt(cantidad.value);
				TdId[0].children[3].innerHTML=suma;
				//actualizamos el campo TotalProducto del producto repetido
				TdId[0].children[4].innerHTML=parseInt(TdId[0].children[2].innerHTML)*suma;
				resetCantidad();
				loadNet();
				loadTotal();				
				return;
			}

			//creamos y añadimos el nuevo registro de producto a la tabla
			td.innerHTML=id
			let td2=document.createElement("td");
			
			td2.innerHTML=productIndex.text;

			let td3=document.createElement("td");

			td3.innerHTML=productIndex.getAttribute("data-price");
			let td4=document.createElement("td");
			td4.innerHTML=cantidad.value;
			let td5=document.createElement("td");
			td5.innerHTML=productIndex.getAttribute("data-price")*cantidad.value;
			tr.append(td,td2,td3,td4,td5);
			
			//añadimos al elemento listProducts un elemento tr que contiene 5 //elementos td donde cada td contiene sus datos correspondientes
			listProducts.append(tr);
			//reseteamos cantidad a 1			
			resetCantidad();
			//cargamos el valor de importe neto
			loadNet();
			//cargamos el valor de importe total
			loadTotal();			
				/*
				convertimos a array la colección de todos los hijos(tr) de la tabla listProducts, un tr equivale a un registro completo que contiene 5 td:
				el primer td contiene el id del producto,
				el segundo td contiene el nombre del producto,
				el tercer td contiene el precio del producto,
				el cuarto td contiene la cantidad de productos,
				el quinto td contiene el total del precio * la cantidad de productos) 
				*/

			//let list=[].slice.call(listProducts.children);
				/*			
				con el método listDatos obtenemos la colección de hijos de cada tr (cada tr contiene 5 td) y creamos una colección de objetos donde cada objeto equivale a un registro tr y sus 5 propiedades contiene los
				valores de cada td.
				*/

			//let result=JSON.stringify(listDatos(list));
			//document.querySelector("#colection_products").value=result;
			//console.log("result: ",result);return;
			
				//jquery
				/*
				let tr=$("<tr></tr>").append($("<td></td>").html($"list_products"));
				$(".list_products").html(tr);
				console.log("tr");

				*/
		//}
//este método es igual al anterior pero creando objetos y 
//después asignando los datos en la tabla
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

			//VALIDACIONES		
			if(!product||product.value==null||product.value==0){
				alert("no existe producto");
				return;
			}
			if(cantidad.value<=0){
				alert("la cantidad no puede ser 0");
				return;
			}
			
			//creamos un array que filtra si existe algún producto repetido en el //array de objetos y si existe devuelve el objeto
			let productRepe=datos.filter(item=>item.id==product.value);
			//si productRepe trae resultado se modifica la cantidad del objeto y del //registro de la tabla
			if(productRepe.length > 0){
				//modificamos el objeto sumando la propiedad cantidad que ya tiene //más la nueva cantidad
				productRepe[0].amount=productRepe[0].amount+parseInt(cantidad.value);
				//convertimos a array la colección de hijos(tr) de la tabla //list_products				
				let list=[].slice.call(list_products.children);
				console.log(list);
				//filtramos todos los tr del array convertido y el que coincida el
				//primer td (que corresponde con el id del producto) con el id del 
				//nuevo producto agregado
				let lista=list.filter((item)=>{
					return item.children[0].innerHTML==product.value;
				})
				//convertimos a array la colección de td del elemento tr que coincide
				lista=[].slice.call(lista[0].children);
				//actualizamos el valor cantidad del td sumando la cantidad del //nuevo producto 
				lista[3].innerHTML=parseInt(lista[3].innerHTML)+parseInt(cantidad.value);
				// actualizamos el total del producto
				//lista[4].innerHTML=parseInt(lista[2].innerHTML)*parseInt(lista[3].innerHTML);
				lista[4].innerHTML=parseInt(lista[2].innerHTML)*productRepe[0].amount;

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
				td.innerHTML=Dato.id
				let td2=document.createElement("td");			
				td2.innerHTML=Dato.name;
				let td3=document.createElement("td");
				td3.innerHTML=Dato.price;
				let td4=document.createElement("td");
				td4.innerHTML=Dato.amount;
				let td5=document.createElement("td");
				td5.innerHTML=Dato.total;
				let tr=document.createElement("tr");
				tr.append(td,td2,td3,td4,td5);
				list_products.append(tr);

				
			}
			resetCantidad();
			loadNet();
			loadTotal();

			//solo queda añadir el objeto al input
			document.querySelector("#collection_products").value=JSON.stringify(datos);
			console.log(datos);
			return;
			
				



			
			
						
			/*
			convertimos a array la colección de todos los hijos(tr) de la tabla listProducts, un tr equivale a un registro completo que contiene 5 td:
			el primer td contiene el id del producto,
			el segundo td contiene el nombre del producto,
			el tercer td contiene el precio del producto,
			el cuarto td contiene la cantidad de productos,
			el quinto td contiene el total del precio * la cantidad de productos) 
			*/
			//let list=[].slice.call(listProducts.children);
			/*			
			con el método listDatos obtenemos la colección de hijos de cada tr (cada tr contiene 5 td) y creamos una colección de objetos donde cada objeto equivale a un registro tr y sus 5 propiedades contiene los
			valores de cada td.
			*/

			//let result=JSON.stringify(listDatos(list));
			//document.querySelector("#colection_products").value=result;
			//console.log("result: ",result);return;
			
			//jquery
			/*
			let tr=$("<tr></tr>").append($("<td></td>").html($"list_products"));
			$(".list_products").html(tr);
			console.log("tr");

			*/
		//}
		
		
		
		/*
		//listDatos
		function listDatos(lista){			
			let nuevoDato=lista.map(tr=>tr.children).map(item=>{
				return {
				id:item[0].innerHTML,
				product:item[1].innerHTML,
				price:item[2].innerHTML,
				amount:item[3].innerHTML,
				totalProduct:item[4].innerHTML
				}
			});

			return nuevoDato;
		*/
		}
@endif

//MÉTODOS COMPATIBLES CON LAS 2 VISTAS

	//método que aplica el iva al precio indicado
	function loadTotal(netVal,ivaVal){
		let sumTotal=Math.round(netVal*((100+ivaVal)/100));
		return sumTotal;
	}


	//resetea a 1 el campo cantidad de agregar producto
	function resetCantidad(){
		document.querySelector("#cantidad").value=1;
	}
		
	//realiza la suma del total de todos los productos de la tabla
	function suma(){			
		let list_products=document.querySelector(".list_products");
		//convertimos a array los hijos (tr) de la tabla list_products
		let tr=[].slice.call(list_products.children);
		//obtenemos todos los total de todos los productos
		let totalProducts=tr.map((item)=>{			
			return parseInt(item.children[4].innerHTML);
		});
		//realizamos la suma a los elementos del array
		let suma=totalProducts.reduce((a,b)=>(a+b));
		return suma;
	}
		
	//actualiza el campo importe neto
	function loadNet(){
		let sum=suma();
		document.querySelector("#net").value=sum;
	}
		
	//actualiza el campo importe total 
	function loadTotal(){
		let sum=suma();
		let vat=parseInt(document.querySelector("#vat").value);
		document.querySelector("#total").value=Math.round(sum*((100+vat)/100));
	}
		
	</script>
	@endsection


