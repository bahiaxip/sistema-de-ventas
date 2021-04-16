<!DOCTYPE HTML>
	<html lang="es">
	{{-- alerta de eliminar cliente,destinatario, vendedor, venta, producto se elminan todos los registros relacionados con ellos y en ventas informar que no se devuelven los stocks y k para ello, hacerlo factura por factura y en facturas checkbox con marcado de devolver el stock por defecto --}}
		<head>
			<meta name="viewport" content="width=device-width,initial-scale=1.0">
			<meta charset="UTF-8">
			<title>Sistema de Gestión de Ventas</title>
			<link href="{{ asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" >
			<link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css">
			<link href="{{ asset("css/select2.css") }}" rel="stylesheet">
			<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
			<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
			<!--<script src="https://kit.fontawesome.com/421f702280.js" crossorigin="anonymous"></script>-->
			<link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
			<style>
			
			</style>
		</head>
		<body>
			<!-- panel oculto -->
			<div id="panel_oculto" class="panel_fondo">
				<center style="padding-top:20%">
					<img src="{{asset('ajax-loader.gif')}}" >
				</center>
			</div>
			<div id="fondo_menu">
			</div>
			<div id="latleft_oculto" class="barra_lateral  ">
	            <ul id="list_barra">
	            	
					@can("ventas.index")
	                <li>
						<a href="{{route('ventas.index')}}" class="nav-link">Ventas</a>								
	                </li>
	                @endcan
	                @can("categories.index")
	                <li >
	                    <a href="{{route('categories.index')}}" class="nav-link">Categorías</a>								
	                </li>
	                @endcan
	                @can("productos.index")
	                <li>
						<a href="{{route('productos.index')}}" class="nav-link">Productos</a>						
	                </li>
	                @endcan
					@can("clientes.index")
					<li>
						<a href="{{route('clientes.index')}}" class="nav-link">Clientes</a>
					</li>
					@endcan
					@can("destinatarios.index")
	                <li>
						<a href="{{route('destinatarios.index')}}" class="nav-link">Destinatarios</a>
					</li>
					@endcan
	                @can("vendedores.index")
					<li>
						<a href="{{ route('vendedores.index') }}" class="nav-link">Vendedores</a>
					</li>
					@endcan
	                @can("supervisores.index")
					<li>
						<a href="{{ route('supervisores.index') }}" class="nav-link" >Supervisores</a>
					</li>
					@endcan

					@role("admin")
					<li>
						<a href="{{route('users.index')}}" class="nav-link">Usuarios</a>
					</li>
					@endrole
					@role("admin")
					<li>
						<a href="{{route('roles.index')}}" class="nav-link">Roles</a>
					</li>
					@endrole		
	            </ul>
	        </div>
			<div class="container">
				<div class="row mb-3">
					<div class="col">
						<header >
							<nav class="p-1 navegador layout">
								<a  class="nav-link d-lg-none" style="float:left;color: #FFF;cursor:pointer" id="botonmenu">
									<i class="fas fa-bars fa-lg" ></i>
								</a>
								<div class="nav justify-content-center" >
									<a href="{{ url('/') }}" class="nav-link" title="Inicio">Inicio</a>
									@can("ventas.create")
									<a href="{{ route('ventas.create') }}" class="nav-link d-none d-sm-block" title="Crear venta"><i class="fas fa-plus-circle"></i>Venta</a>
									@endcan
									@can("clientes.create")
									<a href="{{ route('clientes.create') }}" class="nav-link d-none d-sm-block" title="Crear cliente"><i class="fas fa-plus-circle"></i>Cliente</a>
									@endcan
									@can("productos.edit")
									<a href="{{ url('/warehouse') }}" class="nav-link" title="Almacén">Almacén</a>
									@endcan
								@if (Route::has('login'))
				                    @auth			                    
				                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="{{Auth::user()->name}}">{{Auth::user()->name}}</a>
				                        <ul class="dropdown-menu menu-user submenu-user">
			                                <li class="nav-link">
			                                    <a href="{{ route('logout') }}" 
			                                        onclick="event.preventDefault();
			                                                 document.getElementById('logout-form').submit();">
			                                        Cerrar Sesión
			                                    </a>                                    
			                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
			                                        {{ csrf_field() }}
			                                    </form>
			                                </li>
                            			</ul>
				                    @else
				                        <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
				                        <a href="{{ route('register') }}" class="nav-link text-white">Registro</a>
				                    @endauth
				                
		            			@endif		            		
								</div>
							</nav>
						</header>						
						<div class="modal fade" id="modal_delete" >
							<div class="modal-dialog modal-sm">
								<div class="modal-content navegador">
									<div class="modal-header ">
										<div class="modal-title ">
											<p>Seguro que desea eliminar el registro?</p>
										</div>
										
									</div>
									<div class="row ml-4 checkbox-stock-hidden">
											<label>{{Form::checkbox("checkbox","false",false,["id"=>"checkbox-delete-register"])}} &nbsp;&nbsp;No devolver el stock</label>
										</div>
									<div class="modal-body">

										<div class="row">
											<div class="col text-center">
												<button id="btn-modal-deletecancel"  class="btn btn-black" data-dismiss="modal" >Cancelar</button>
													&nbsp;&nbsp;
												<button id="btn-modal-delete" class="btn btn-black">
													Eliminar
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						{{-- modal scanner --}}
						<div class="modal fade" id="modal-scanner">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<div class="modal-title">
											Escanear producto
										</div>				
									</div>
									<div class="modal-body">
										<div class="row">
											{{ Form::text("elquesea",null,["class"=>"form-control","id"=>"input-scanner"]) }}
										</div>
									</div>
								</div>
							</div>
						</div>					

						<div class="row ">
							<div class="col-auto col-lg-2 h-100 d-none d-lg-flex ">
								<nav class="fm-nav menu nav flex-column">
								@can("ventas.index")
									<a href="{{route('ventas.index')}}" class="nav-link">Ventas</a>
								@endcan
								@can("categories.index")
									<a href="{{route('categories.index')}}" class="nav-link">Categorías</a>
								@endcan
								@can("productos.index")
									<a href="{{route('productos.index')}}" class="nav-link">Productos</a>
								@endcan
								@can("clientes.index")
									<a href="{{route('clientes.index')}}" class="nav-link">Clientes</a>
								@endcan
								@can("destinatarios.index")
									<a href="{{route('destinatarios.index')}}" class="nav-link">Destinatarios</a>
								@endcan
								@can("vendedores.index")
									<a href="{{ route('vendedores.index') }}" class="nav-link">Vendedores</a>
								@endcan
								@can("supervisores.index")
									<a href="{{ route('supervisores.index') }}" class="nav-link" >Supervisores</a>
								@endcan
								@can("users.index")
								<li>	
									<a href="{{route('users.index')}}" class="nav-link">Usuarios</a>
								</li>
								@endcan
								@can("roles.index")
								<li>
									<a href="{{route('roles.index')}}" class="nav-link">Roles</a>
								</li>
								@endcan				
								</nav>								
							</div>
							@yield("content")

						</div>						
					</div>
				</div>				
			</div>
			<script>
				
				//necesaria variable btn y _id para que no se repita 
				var btn="";
				let _id="";
				//interruptor key_delete para comprobar si es el segundo texto de aviso
				//del modal(de precaución de borrado del registro)
				let key_delete="false";		 
			function deleteData(id,ide,ruta,e){
				
				e.preventDefault();
				//ocultamos checkbox
				$(".checkbox-stock-hidden").hide();
				//enviar segundo mensaje de aviso antes de eliminar registro
				$("#btn-modal-delete").parents(".navegador").find("p").html("Seguro que desea eliminar el registro?");
				//let mssg=sendMsgDelete(ruta);
				//console.log("this: ",$(this));
				$("#modal_delete").modal("show");
					btn=ide;
					_id=id;
					//console.log("ide de sol: ",ide);
				//mostrar diálogo
				$("#btn-modal-delete").on("click",function(e){
					//para que no se repita la petición					
					e.stopImmediatePropagation();
					let mssg=sendMsgDelete(ruta);					
					if(key_delete=="false"){
						//comprobar si la ruta es facturas_destroy y añadir el checkbox
						$(this).parents(".navegador").find("p").html(mssg);		
						key_delete="true";						
					}else{
						let parent=btn.parentElement.parentElement.parentElement;
						//añadimos productos.destroy como válido 
						// y reemplazamos por el parámetro ruta
						let url="{{ route('productos.destroy') }}";
						url=url.replace(/productos.destroy/g,ruta);	
						//ocultamos y eliminamos						
						parent.style.display="none";
						parent.parentElement.removeChild(parent);
						//ocultamos modal
						$("#modal_delete").modal("hide");
						key_delete="false";
						//check solo se usa en la eliminación de facturas para
						//comprobar si el checkbox (de devolución de stock) está marcado
						let check="false";
						if(document.querySelector("#checkbox-delete-register").checked)
							check="true";
						$.ajax({
							type:"POST",
							url:url,
							data:{id:_id,checkBox:check,_token:"{{csrf_token()}}" },
							success:function(data){								
								$(data.div).html("");
								$(data.div).html(data.dato);
								console.log(data);						
							},
							error:function(){
								console.log("ErRor");
							}
						});
					}				
				});
				//botón Cancelar de eliminar registro cambia el interruptor
				//key_delete, para así forzar siempre el segundo diálogo
				$("#btn-modal-deletecancel").on("click",function(e){
					key_delete="false";
				});

			}
			function deleteDataRole(ide,e){
				e.preventDefault();
				$("#modal_delete").modal("show");
				btn=ide;
				$("#btn-modal-delete").on("click",function(e){					
					btn.parentElement.submit();
				});
				return;
			}

			//menu lateral para pantallas más pequeñas
            $(function()
            {
               var boton=$("#botonmenu");
               var fondo_enlace=$("#fondo_menu");               
               boton.on("click",function(e)
               {
                   fondo_enlace.toggleClass("active");
                   $("#latleft_oculto").toggleClass("active");
                   e.preventDefault();
               })
               
               fondo_enlace.on("click",function(e)
               {
                   fondo_enlace.toggleClass("active");
                   $("#latleft_oculto").toggleClass("active");
                   e.preventDefault();
               });
            });

            //cambiar color del desplegable de settings
            function cambiarColor(id){
            	let search=id.className.search("btn-black");
            	if(search!=-1){
            		id.classList.remove("btn-black");
            		id.classList.add("btn-grey");
            	}else{
            		id.classList.remove("btn-grey");
            		id.classList.add("btn-black");
            	}
            }
            //segundo mensaje de confirmación de eliminación de registro
            //que varía según el tipo de registro a eliminar
            const sendMsgDelete= (ruta) => {
            	let subruta;
            	let msg;
				switch (ruta){										
					case "clientes_destroy":
					case "destinatarios_destroy":					
						subruta=ruta.replace("s_destroy","");
						subruta="ese "+subruta;
						msg="msg1";
						break;
					case "supervisores_destroy":
					case "vendedores_destroy":
						subruta=ruta.replace("es_destroy","");
						subruta="ese "+subruta;
						msg="msg1";
						break;
					case "ventas_destroy":
						subruta=ruta.replace("s_destroy","");
						subruta="esa "+subruta;
						msg="msg2";
						break;
					case "facturas_destroy":
						subruta=ruta.replace("s_destroy","");
						subruta="esa "+subruta;
						msg="msg3";
						//mostramos checkbox						
						$(".checkbox-stock-hidden").show();
						break;
					//Se desaconseja la eliminación de productos y categorías ya que 
					//crea un desajuste en el importe al eliminar el producto, aunque //se soluciona actualizando la factura guardando la factura desde 
					//la edición
					case "productos_destroy":
					subruta=ruta.replace("s_destroy","");
						subruta="ese "+subruta;
						msg="msg4";
						break;
					case "categories_destroy":					
						subruta="esa  categoría";
						msg="msg4";
						break;
					/*
					case "users_destroy":
						subruta="ese "+subruta;
						msg="msg5";
						*/
					default:
						subruta="ese usuario";
						msg="default";
						break;
				}
				switch(msg){
					//msg1: vendedor,destinatario,cliente,supervisor
					case "msg1":
						msg="Se eliminarán todas las ventas y facturas del sistema, relacionadas con "+ subruta+". Seguro que desea continuar?";
						break;
					//msg2: ventas
					case "msg2":					
						msg="Si desea devolver el stock de los productos es necesario eliminar antes las facturas. Seguro que desea continuar?";
						break;
					//msg3: facturas
					case "msg3":
						msg="Seguro que desea eliminar la factura?";
						break;
					//msg4: categorías, productos
					case "msg4":
						msg="Se desaconseja totalmente la eliminación de categorías y productos, ya que, elimina los productos de las facturas, además origina un desajuste en el importe de las mismas. Seguro que desea continuar?";						
						break;
					case "msg5":
						msg=""
						break;
					default:
						msg="El usuario y los roles asignados serán eliminados. Seguro que desea continuar?";
						break;
				}
				return msg;
            }
			</script>
			<script src="{{ asset("js/select2.js") }}"></script>
			@yield("scripts")
		</body>
	</html>