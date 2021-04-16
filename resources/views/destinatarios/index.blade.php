@extends("layout/layout")

@section("content")

	<div class="col mt-3">
		<div class="card pl-2 pr-2 pt-2 border-0 navegador">
			<div class="card-header">
				<h5 class="float-left">Destinatarios</h5>
				@can("clientes.create")
				<a href="{{route('destinatarios.create') }}" class="btn btn-sm btn-black float-right">Crear</a>
				@endcan
			</div>
		</div>
		<div class="destinatarios_table ajax-table">
			@include("destinatarios.table_destinatarios")
		</div>		

		
	</div>

@endsection
