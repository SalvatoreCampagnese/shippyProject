<?php
// Initialize class Airport
class Airport
{
    public $id;
    public $name;
    public $code;
    public $lat;
    public $lng;
}

// Function that creates airport based on input values
function createAirport($id, $name, $code, $lat, $lng){
     $newAirport = new Airport();
     $newAirport->id = $id;
     $newAirport->name = $name;
     $newAirport->code = $code;
     $newAirport->lat = $lat;
     $newAirport->lng = $lng; 
     return $newAirport;
}

// Just creating some airports
$romeAirport = createAirport(1, 'Roma Fiumicino', 'FCO', '41.8003', '12.2389');
$naplesAirport = createAirport(2, 'Napoli', 'NAP', '40.8844', '14.2908');
$veniceAirport = createAirport(3, 'Venezia', 'VCE', '45.5053', '12.3519');
$milanAirport = createAirport(4, 'Milano Malpensa', 'MXP', '45.63', '8.72306');
$bolognaAirport = createAirport(5, 'Guglielmo Marconi', 'BLQ', '44.5308', '11.2969');

// I create an array so that I can iterate them easily
$airports = [
	$romeAirport,
	$naplesAirport,
	$veniceAirport,
	$milanAirport,
	$bolognaAirport
	
];
?>