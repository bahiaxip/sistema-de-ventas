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
		<div class="col">
			<div class="card navegador">
				<div class="card-header ">
					<h2 class="text-white text-center">Sistema de Ventas en Laravel</h2>
				
					<div class="row mt-5 pt-3 pb-5">
						<div class="col-6  d-flex align-items-center  justify-content-center">
							<a href="{{route('warehouse')}}" class="" style="border:white 1px solid;padding:5px;border-radius:10px;background-color:#FFF">
								<img src="{{asset('ima/almacen_1.png')}}" title="Almacén" width="80">
							</a>			
						</div>

						<div class="col-6  d-flex align-items-center  justify-content-center">
							<a href="{{url('settings')}}" style="border:white 1px solid;padding:5px;border-radius:10px;background-color:#FFF">
								<img src="{{asset('ima/lista.png')}}" title="Opciones" width="80">
							</a>
						</div>
					</div>
				
				</div>
			</div>
		</div>
@endsection