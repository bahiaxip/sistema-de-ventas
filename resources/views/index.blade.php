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
		<div class="col" >
			<div class="card home">
				<div class="card-header ">
					<div class="title" >
						<h2 class="text-center c_orange" >Sistema de Ventas en Laravel</h2>
					</div>
					@can("productos.edit")
					<div class="row mt-5 pt-3 pb-5">
						<div class="col-6  d-flex align-items-center  justify-content-center">
							
							<a href="{{route('warehouse')}}" class="">
								<button type="button" class=" text-white btn btn_gris">
									Almacén
								</button>							
								<!--<img src="{{asset('ima/almacen_1.png')}}" title="Almacén" width="80">-->
							</a>
						
						</div>					
						<div class="col-6  d-flex align-items-center  justify-content-center">
							<!--<a href="{{url('settings')}}" style="border:white 1px solid;padding:5px;border-radius:10px;background-color:#FFF">-->
								<!--<img src="{{asset('ima/lista.png')}}" title="Opciones" width="80">-->
								<a href="{{url('settings')}}">
									<button type="button" class="btn btn_gris text-white">
										Opciones
									</button>
							</a>
						</div>
					</div>
					@endcan
				</div>
			</div>
		</div>
@endsection