<?php
namespace App\Classes;

class Paises{

	//todos los países
	public $all=array("Afganistán","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Arabia Saudita","Argelia","Argentina","Armenia","Australia","Austria","Azerbaiyán","Bahamas","Bangladés","Barbados","Baréin","Bélgica","Belice","Benín","Bielorrusia","Birmania","Bolivia","Bosnia y Herzegovina","Botsuana","Brasil","Brunéi","Bulgaria","Burkina Faso","Burundi","Bután","Cabo Verde","Camboya","Camerún","Canadá","Catar","Chad","Chile","China","Chipre","Ciudad del Vaticano","Colombia","Comoras","Corea del Norte","Corea del Sur","Costa de Marfil","Costa Rica","Croacia","Cuba","Dinamarca","Dominica","Ecuador","Egipto","El Salvador","Emiratos Árabes Unidos","Eritrea","Eslovaquia","Eslovenia","España","Estados Unidos","Estonia","Etiopía","Filipinas","Finlandia","Fiyi","Francia","Gabón","Gambia","Georgia","Ghana","Granada","Grecia","Guatemala","Guyana","Guinea","Guinea ecuatorial","Guinea-Bisáu","Haití","Honduras","Hungría","India","Indonesia","Irak","Irán","Irlanda","Islandia","Islas Marshall","Islas Salomón","Israel","Italia","Jamaica","Japón","Jordania","Kazajistán","Kenia","Kirguistán","Kiribati","Kuwait","Laos","Lesoto","Letonia","Líbano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Madagascar","Malasia","Malaui","Maldivas","Malí","Malta","Marruecos","Mauricio","Mauritania","México","Micronesia","Moldavia","Mónaco","Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal","Nicaragua","Níger","Nigeria","Noruega","Nueva Zelanda","Omán","Países Bajos","Pakistán","Palaos","Panamá","Papúa Nueva Guinea","Paraguay","Perú","Polonia","Portugal","Reino Unido","República Centroafricana","República Checa","República de Macedonia","República del Congo","República Democrática del Congo","República Dominicana","República Sudafricana","Ruanda","Rumanía","Rusia","Samoa","San Cristóbal y Nieves","San Marino","San Vicente y las Granadinas","Santa Lucía","Santo Tomé y Príncipe","Senegal","Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka","Suazilandia","Sudán","Sudán del Sur","Suecia","Suiza","Surinam","Tailandia","Tanzania","Tayikistán","Timor Oriental","Togo","Tonga","Trinidad y Tobago","Túnez","Turkmenistán","Turquía","Tuvalu","Ucrania","Uganda","Uruguay","Uzbekistán","Vanuatu","Venezuela","Vietnam","Yemen","Yibuti","Zambia","Zimbabue");

		//países de la UE
	public $ue=["Alemania","Austria","Bélgica","Bulgaria","Chipre","Croacia","Dinamarca","Eslovaquia","Eslovenia","España","Estonia","Finlandia","Francia","Grecia","Hungría","Irlanda","Italia","Letonia","Lituania","Luxemburgo","Malta","Paises Bajos","Polonia","Portugal","Reino Unido","Repúblic Checa","Rumanía","Suecia"];

		//provincias españolas menos Ceuta y Melilla(no son provincias
		// pero si ciudades autónomas)
	public $provincias=array("Álava", "Albacete", "Alicante", "Almería", "Asturias", "Ávila", "Badajoz", "Barcelona", "Burgos", "Cáceres", "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca", "Gerona", "Granada", "Guadalajara", "Guipúzcoa", "Huelva", "Huesca", "Islas Baleares", "Jaén", "La Coruña", "La Rioja", "Las Palmas", "León", "Lérida", "Lugo", "Madrid", "Málaga", "Murcia", "Navarra", "Orense", "Palencia", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Vizcaya", "Zamora", "Zaragoza");

		//Array principal
    /*
    $andalucia = array(
        //Arrays de cada provincia con sus tres pueblos
        "Almería" => array ("Roquetas de Mar","Mojácar","Cabo de Gata"),
        "Granada" => array ("Almuñécar","La Zubia","Salobreña"),
        "Jaén" => array ("Úbeda","Baeza","Linares"),
        "Córdoba" => array ("Pozoblanco","Lucena","Fernán-Núñez"),
        "Sevilla" => array ("Osuna","La Roda de Andalucía","Mairena del Aljarafe"),
        "Málaga" => array ("Torremolinos","Vélez-Málaga","Marbella"),
        "Huelva" => array ("Río Tinto","Lepe","Isla Cristina"),
        "Cádiz" => array ("El Puerto de Santa María","Chiclana de la Frontera","Algeciras"),
        );
    */
    //Como es bidimensional, necesitamos dos foreach para mostrar
    /*foreach ($andalucia as $comunidad => $provincia) {
        foreach ($provincia as $capital => $pueblo) {
            echo "El municipio de ".$pueblo." pertenece a la provincia de ".$comunidad."<br>";
        }
    }*/
}

?>