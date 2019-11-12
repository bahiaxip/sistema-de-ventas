@extends("layout/layout")

@section("content")

	
		<div class="col mt-3">
			<div class="card  pl-2 pr-2 pt-2 border-0 navegador">
				<div class="card-header">
					<h5 class="float-left">Roles</h5>
					<a href="{{route('roles.create') }}" class="btn btn-sm btn-primary float-right btn-black">Crear</a>
				</div>
			</div>
			
			<table class="table text-white table-roles">
				<thead class="thead-dark text-white">
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
						<button class="btn btn-sm btn-outline-danger" onclick="deleteDataRole(this,event)">
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