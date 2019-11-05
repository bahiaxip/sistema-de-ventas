@extends("layout/layout")

@section("content")
	<div class="col col-xl-10 formstyle">
		@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>                                        
                @endforeach
            </ul>
        </div>
        @endif
		{{ Form::open(["route"=> "facturas.store"])}}
		<!-- booleano para campo IVA -->
			@include("facturas.form",["iva"=>true])
		{{ Form::close()}}
	</div>
	
@endsection