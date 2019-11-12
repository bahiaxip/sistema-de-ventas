@extends("layout/layout")

@section("content")
	<div class="col col-xl-10 formstyle">
		@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @if($errors->has("net"))
				<li>{{$errors->first("net")}}</li>
				@elseif($errors->has("iva"))
            	<li>{{$errors->first("iva")}}</li>
				@elseif($errors->has("total"))
            	<li>{{$errors->first("total")}}</li>
            	@elseif($errors->has("state"))
            	<li>{{$errors->first("state")}}</li>
            	@elseif($errors->has("order_buy"))
            	<li>{{$errors->first("order_buy")}}</li>
            	@elseif($errors->has("office_guide"))
            	<li>{{$errors->first("office_guide")}}</li>
            	@endif
                <!--@foreach($errors->get("net") as $error)
                <li>{{ $error }}</li>                                        
                @endforeach-->

            </ul>
        </div>
        @endif
		{{ Form::open(["route"=> "facturas.store"])}}
		<!-- booleano para campo IVA -->
			@include("facturas.form",["iva"=>true])
		{{ Form::close()}}
	</div>
	
@endsection