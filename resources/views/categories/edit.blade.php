@extends("layout/layout")

@section("content")

<div class="col-auto col-lg-10">
	@if(count($errors))
		<div class="alert alert-success">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>                                        
                @endforeach
            </ul>
        </div>
    @endif

	{{ Form::model($category,["route"=>["categories.update",$category->id],"method"=> "PUT"]) }}
	@include("categories.form")
	{{ Form::close() }}
</div>

@endsection