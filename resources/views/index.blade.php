@extends("layout/layout")

@section("content")

	<!--
	<div class="row">
		<div class="col-auto">
			<div class="list-group">
				<a href="{{route('users.index')}}" class="list-group-item list-group-item-action">Usuarios</a>
				<a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action">Roles</a>
			</div>
			
		</div>
	</div>
	-->

	<!--<div class="row bg-white ">
		<div class="col-12 w-100">
			asdfsdf
			<i class="fas fa-plus-circle fa-lg" style="color:orange "></i>
		</div>
	</div>-->
	
	
		
			
		
			<!--<div class="col-3 bg-white d-flex align-self-center justify-content-center">-->
			<div class="col">
			<div class="card navegador">
				<div class="card-header ">
					<h2 class="text-white text-center">Sistema de Ventas en Laravel</h2>
				@role("admin")
				<div class="row mt-5">
					<div class="col-2   d-flex align-items-center  justify-content-center">
						<a href="{{route('warehouse')}}" class="" style="border:white 1px solid;padding:5px;border-radius:10px;background-color:#FFF">
							<img src="{{asset('ima/almacen_1.png')}}" title="almacen" width="80">
						</a>			
					</div>
				<!--<div class="col-3 pt-5 pb-5 bg-white d-flex align-self-center justify-content-center">-->
				<!--<div class="col-2  bg-dark d-flex align-items-center  justify-content-center">
					<a href="#">
						<img src="{{asset('ima/cajaembalaje.png')}}" title="almacen" width="100">
					</a>
				</div>-->
					<div class="col-2  d-flex align-items-center  justify-content-center">
						<a href="{{url('settings')}}" style="border:white 1px solid;padding:5px;border-radius:10px;background-color:#FFF">
							<img src="{{asset('ima/lista.png')}}" title="Opciones" width="80">
						</a>
					</div>
				</div>
				@endrole
			</div>
			</div>
			</div>
		
	


@endsection