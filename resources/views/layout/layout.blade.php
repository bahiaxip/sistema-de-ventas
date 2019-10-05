<!DOCTYPE HTML>
	<html lang="es">
		<head>
			<meta name="viewport" content="width=device-width,initial-scale=1.0">
			<meta charset="UTF-8">
			<title>Sistema de Gestión de Ventas</title>
			<link href="{{ asset('/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" >
			<link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css">
			<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
			<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
			

		</head>
		
		<body>
			<div class="container">
				<div class="row mb-3">
					<div class="col">
						<header >
							<nav class="nav justify-content-center bg-primary p-1 ">
								<a href="{{ url('/') }}" class="nav-link text-white">Inicio</a>

								
								
								@can("users.index")
								<a href="{{route('users.index')}}" class="nav-link text-white">Usuarios</a>
								@endcan
								@can("roles.index")
								<a href="{{route('roles.index')}}" class="nav-link text-white">Roles</a>
								@endcan								
							@if (Route::has('login'))
				                    @auth			                    
				                        <a href="#" class="nav-link text-white dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}</a>

				                        <ul class="dropdown-menu menu-user ">			                                
			                                <li class="nav-link ">
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
				                        <a href="{{ route('register') }}" class="nav-link text-white">Register</a>
				                    @endauth
				                
		            			@endif
		            		
								
							</nav>
							
						</header>
						<div class="modal fade" id="modal_delete" >
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header ">
										<div class="modal-title ">
											<p>Desea eliminar el registro?</p>
										</div>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col">
												<button  class="btn btn-outline-primary" data-dismiss="modal" >Cancelar</button>
												<button id="btn-modal-delete" class="btn btn-outline-primary">
													Eliminar
												</button>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						

						<div class="row">
							<div class="col-auto col-lg-2 h-100">
								<nav class="fm-nav bg-dark nav flex-column">

									<a href="{{ route('supervisores.index') }}" class="nav-link text-white" >Supervisores</a>
									<a href="{{ route('vendedores.index') }}" class="nav-link text-white">Vendedores</a>
									<a href="{{route('clientes.index')}}" class="nav-link text-white">Clientes</a>
									<a href="#" class="nav-link text-white">Destinatarios</a>
									<a href="#" class="nav-link text-white">Productos</a>
									<a href="#" class="nav-link text-white">Ventas</a>
									<a href="#" class="nav-link text-white">Facturas</a>
								</nav>								
							</div>
							

							@yield("content")
						</div>
						
					</div>
				</div>

				
			</div>

			<script>
				$(".provincia").hide();
				$(".btn-delete-data").on("click",function(e) {
					e.preventDefault();
					var btn=$(this);
					$("#modal_delete").modal("show");
					//modo sin ajax, versión ajax en mundaxip
					$("#btn-modal-delete").click(function(e){
						e.preventDefault();
						btn.parents("form").submit();	
					})
				});
				$(".pais").on("change",function(){
					if($("#provincia").val()=="España"){
						$(".provincia").show();
					}else{
						$(".provincia").hide();
					}

				});
				
			</script>
			@yield("scripts")


		</body>
		
		
	</html>