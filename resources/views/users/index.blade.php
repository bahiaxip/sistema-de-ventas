@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Usuarios</h5>				
			</div>
		</div>
		<div class="user_table">
			@include("users.table_users")
		</div>
			
	</div>				
		
	<div class="col-10 offset-2">
		{{ $users->links("pagination::bootstrap-4")}}
	</div>		
<!--</div>-->
@endsection