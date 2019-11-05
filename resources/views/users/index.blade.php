@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Usuarios</h5>				
			</div>
		</div>
			
			<table class="table ">
				<thead class="table-titulo">
					<th>Nombre</th>
					<th>Ver</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</thead>
				<tbody class="table-sistema">
					@foreach($users as $user)
					<tr>				
						<td>{{ $user->name }}</td>
						<td><a class="btn btn-sm btn-outline-info" href="{{ route('users.show',$user) }}">Ver</a></td>
						<td><a href="{{route('users.edit',$user)}}" class="btn btn-sm btn-outline-primary">Editar</a></td>
						<td>
						{{ Form::open(["route"=>["users.destroy",$user->id],"method"=>"DELETE"]) }}
							<button class="btn btn-sm btn-outline-danger ">Eliminar</button>
						{{Form::close()}}
						</td>				
						
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>				
		<!--<div class="container">
			<div class="row mt-3">-->
				<div class="col-10 offset-2">
					{{ $users->links("pagination::bootstrap-4")}}
				</div>
			<!--</div>
		</div>-->
	</div>
@endsection