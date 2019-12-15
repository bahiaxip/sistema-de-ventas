<div class="container">
	
	<div class="form-group row">
		<div class="col-10 col-lg-3">
			{{ Form::label("categoria","Categoría") }}
			{{ Form::select("categoria",$categorias,null,["class"=>"form-control"]) }}
		</div>
		<div class="col-10 col-lg-5"> 
			{{ Form::label("producto","Productos") }}
			{{ Form::select("producto",$add_productos,null,["class"=>"form-control"]) }}
		</div>
		<div class="col-10 col-lg-2">
			{{ Form::label("cantidadAdd","Cantidad") }}
			{{ Form::number("cantidadAdd",1,["class"=> "form-control"]) }}
		</div>
		<div class="col-10 mt-3 col-lg-2  align-self-end" >
			{{ Form::button("Agregar",["class"=>"btn btn-black","onclick"=>"editAddProductFactura($factura->id,event)"])}}
		</div>
	</div>
	
</div>

<table class="table  col col-md-12">
	<thead class="table-titulo" >
		<tr>
			<th>ID Producto</th>
			<th>Nombre</th>				
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Total</th>
			<th>Eliminar</th>
		</tr>
	</thead>
	<tbody class="list_edit_products ">
		@include("facturas.ajax-edit-table")
	</tbody>
</table>