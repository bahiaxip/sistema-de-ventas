@extends("layout/layout")

@section("content")
	<div class="row">
		<div class="col-12 col-md-auto">
			<div class="card">
				<div class="card-title">
					<p class=" bg-dark text-white text-center p-2">Rol</p>
				</div>
				<div class="card-body">
					<p><strong>Nombre:</strong>&nbsp;&nbsp;{{ $role->name}}</p>
					<p><strong>Slug:</strong>&nbsp;&nbsp;{{$role->slug}}</p>
					<p><strong>Descripción:</strong>&nbsp;&nbsp;{{$role->description}}</p>
				</div>
			</div>
		</div>
	</div>	
@endsection