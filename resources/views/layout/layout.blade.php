<!DOCTYPE HTML>
	<html lang="es">
		<head>
			<meta name="viewport" content="width=device-width,initial-scale=1.0">
			<meta charset="UTF-8">
			<title>Sistema de Gestión de Ventas</title>
			<link href="{{ asset('/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" >
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
									<a href="{{ url('/warehouse') }}" class="nav-link" title="Almacén">Almacén</a>
													
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
									<div class="modal-body">
										<div class="row">
											<div class="col text-center">
												<button  class="btn btn-black" data-dismiss="modal" >Cancelar</button>
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

				//evento botón eliminar registro que muestra ventana confirmación anulado por cambio a ajax
				/*
				$(".btn-delete-data").on("click",function(e) {
					e.preventDefault();
					var btn=$(this);
					$("#modal_delete").modal("show");
					//modo sin ajax, versión ajax en mundaxip
					$("#btn-modal-delete").click(function(e){
						btn.parents("tr").hide();return;
						e.preventDefault();
						$.ajax({
							type:"POST",
							
						})
						//btn.parents("form").submit();	
					})
				});
				*/

				//eliminar registros excepto roles

				//necesaria variable btn y _id para que no se repita 
				var btn="";
				let _id="";
			function deleteData(id,ide,ruta,e){
				e.preventDefault();
				
				$("#modal_delete").modal("show");
					btn=ide;
					_id=id;

					console.log("ide de sol: ",ide);
				$("#btn-modal-delete").on("click",function(e){
					//para que no se repita la petición					
					e.stopImmediatePropagation();					
					console.log("btn: ",btn);
					console.log("ide:  ",ide);
					let parent=btn.parentElement.parentElement.parentElement;

					//let url="{{route('productos.destroy')}}";

					//añadimos productos.destroy como válido 
					// y reemplazamos por el parámetro ruta
					let url="{{ route('productos.destroy') }}";
					url=url.replace(/productos.destroy/g,ruta);
					
					//ocultamos y eliminamos
					console.log("parent: ",parent);//return;
					//console.log(btn);
					parent.style.display="none";
					parent.parentElement.removeChild(parent);

					//ocultamos modal
					$("#modal_delete").modal("hide");
					
					$.ajax({
						type:"POST",
						url:url,
						data:{id:_id,_token:"{{csrf_token()}}" },
						success:function(data){
							$(data.div).html("");
							$(data.div).html(data.dato);
							console.log(data);						
						},
						error:function(){
							console.log("ErRor");
						}
					});
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
			</script>
			<script src="{{ asset("js/select2.js") }}"></script>
			@yield("scripts")


		</body>
		
		
	</html>