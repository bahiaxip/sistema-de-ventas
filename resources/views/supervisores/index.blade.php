@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Supervisores</h5>
				@can("supervisores.create")
				<a href="{{route('supervisores.create') }}" class="btn btn-sm btn-black text-white float-right">Crear</a>
				@endcan
			</div>
		</div>

		<div class="supervisores_table">
			@include("supervisores.table_supervisores")
		</div>
	</div>

@endsection
