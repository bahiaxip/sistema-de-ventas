@extends("layout.layout")

@section("content")
	<div class="col mt-3">
		<div class="card border-0 ">
			<div  class="card-header text-center pt-3 fondo-gris text-white ">
				<h5><strong>Detalle de supervisor</strong></h5>
			</div>
			<div class="card-body " style="background:initial !important">
				<div class="row  div-show">
					<div class="col-12 text-center col-md-2 text-md-left ">
						<span class="badge badge-secondary p-2 span-show">
							Nombre:
						</span>						
					</div>
					<div class="col-12 text-center col-md-4 pt-2 text-md-left">	
						<span>
							{{ $supervisor->name }}
						</span>
					</div>
				
					<div class="col-12 text-center col-md-2 text-md-left ">
						<span class="badge badge-secondary p-2 span-show">
							Apellidos:
						</span>
					</div>
					<div class="col-12 text-center col-md-4 p-2 text-md-left" >
						<span>
							{{ $supervisor->surname }}
						</span>
					</div>
				</div>
				<div class="row  pt-2 div-show">
					<div class="col-12 text-center col-md-2 text-md-left">
						<span class="badge badge-secondary p-2 span-show" >
							E-Mail:
						</span>
					</div>					
					<div class="col-12 col-md-10 pt-2 ">
						<span>
							{{ $supervisor->email }}

						</span>
					</div>

					<div class="col-12 text-center col-md-2 text-md-left pt-3">
						<span class="badge badge-secondary p-2 span-show">
							Teléfono:
						</span>
					</div>
					<div class="col-12 text-center col-md-4 pt-4 text-md-left ">
						<span >
							{{ $supervisor->phone }}
						</span>
					</div>
				</div>
			</div>
			<table class="table">

			</table>
			
		</div>
	</div>
@endsection