@extends("layout/layout")

@section("content")

	
		<div class="col">
			<div class="card border-0">
				<div class="card-title">
					<h5 class="float-left">Roles</h5>
					<a href="{{route('roles.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
				</div>
			</div>
			
			<table class="table table-hover">
				<thead class="bg-dark text-white">
					<th>Nombre</th>
					<th>Ver</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</thead>
				@foreach($roles as $role)
				<tr>				
					<td>{{ $role->name }}</td>
					<td><a href="{{route('roles.show',$role->id)}}" class="btn btn-sm btn-outline-info" >Ver</a></td>
					<td><a href="{{route('roles.edit',$role->id) }}" class="btn btn-sm btn-outline-primary">Editar</a></td>
					<td>
						{{ Form::open(["route"=>["roles.destroy",$role->id],"method"=>"DELETE"]) }}
						<button class="btn btn-sm btn-outline-danger">
						Eliminar
						</button>
						{{ Form::close() }}
					</td>				
				</tr>
				@endforeach
			</table>
		</div>				
	
	<div class="row mt-3">
		<div class="col">
			{{ $roles->links("pagination::bootstrap-4")}}
		</div>
	</div>

@endsection