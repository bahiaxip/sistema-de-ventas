<?php

namespace App\Exports;

use App\Factura;
use App\Detalle_factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Collection;
//necesario para trait Exportable (que permite el método download)
use Maatwebsite\Excel\Concerns\Exportable;

//class FacturasExport implements FromCollection,WithHeadings {
//class FacturasExport implements FromCollection {
class FacturasExport implements FromView {

	//use Exportable;
	public $id;
	protected $productos;

	public function __construct($productos_factura=null){
		$this->productos=$productos_factura;
	}

	//constructor creado para pasar el $id
	/*
	public function __construct($id_factura){
		$this->id=$id_factura;

	}
	*/
	//el método headings permite añadir algunos o todos los títulos de la 
	//tabla necesaria interface WithHeadings	
	/*
	public function headings(): array
	{
		
		return [
			"Id",
			"Nombre",
			"Email",
		];
	}*/
	
	
	public function view(): View
	{
		//$productos_factura=Detalle_factura::where("id_factura",2)->get();
		$productos_factura=$this->productos;
		return view("facturas.ajax-product",compact("productos_factura"));
	}
	

	//podemos pasar la colección pero debe ser con all
	/*
	public function collection(){
		//$facturas=Factura::where("id",$this->id)->get();
		$factura=Detalle_factura::where("id_factura",2)->get();
		//$factura=Detalle_factura::all();
		//$factura=$this->productos;
		
		return $factura;
	}
	*/
	
}