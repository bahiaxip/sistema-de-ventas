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
			<td >{{ $user->name }}</td>
			<td>
				@if(config('datos.design')=="true")
				<a href="{{ route('users.show',$user->id) }}" title="Ver">
					<i class="fab fa-sistrix fa-lg"></i>
				</a>				
			@else
				<a class="btn btn-sm btn-outline-info" href="{{ route('users.show',$user->id) }}">Ver</a>
			@endif
			</td>
			<td class="text-center">
			@if(config('datos.design')=="true")
				<a href="{{ route('users.edit',$user->id) }}" title="Editar">							
					<i class="far fa-edit fa-lg"></i>
				</a>
			@else
				<a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-outline-primary">Editar</a>
			@endif
			</td>
			<td>
			{{ Form::open(["route"=>["users.destroy",$user->id],"method"=>"DELETE"]) }}
			@if(config('datos.design')=="true")
				<i class="fas fa-times-circle fa-lg btn-delete-data" title="Eliminar" onclick="deleteData({{$user->id}},this,'users_destroy',event)"></i>
			@else
				<button class="btn btn-sm btn-outline-danger " onclick="deleteData({{$user->id}},this,'users_destroy',event)">Eliminar</button>
			@endif
			{{Form::close()}}
			</td>				
			
		</tr>
		@endforeach
	</tbody>
</table>