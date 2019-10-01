@extends("layout/layout")

@section("content")

	<div class="row">		
		<div class="col-12 col-md-6">
			<div class="card">
				<div class="card-text">
					<p class=" bg-dark text-white p-2 text-center">Nombre</p>
				</div>
				<div class="card-body">
					<h4 class="text-center">{{$user->name }}</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12 col-md-6">
			<div class="card">
				<div class="card-text">
					<p class="bg-dark text-white p-2 text-center">Email</p>
				</div>
				<div class="card-body">
					<h4 class="text-center">{{$user->email}}</h4>
				</div>
				
			</div>
		</div>
	</div>

@endsection