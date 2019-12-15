@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Categorías</h5>
				@can("categories.create")
				<a href="{{route('categories.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>		
		<div class="category_table">
			@include("categories.table_categories")
		</div>
	</div>
@endsection
