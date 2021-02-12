<?php
// Initialize class Flight
class Flight
{
    public $code_departure;
    public $code_arrival;
    public $price;
}

// Function that creates flight based on input values
function createFlight($codeDeparture, $codeArrival, $price){
     $newFlight = new Flight();
     $newFlight->code_departure = $codeDeparture;
     $newFlight->code_arrival = $codeArrival;
     $newFlight->price = $price; 
     return $newFlight;
}

// Just creating some flights
$flightFcoToBlq = createFlight('FCO', 'BLQ', 1000);
$flightNapToVce = createFlight('NAP', 'VCE', 10);
$flightFcoToVce = createFlight('FCO', 'VCE', 10);
$flightMxpToBlq = createFlight('MXP', 'BLQ', 320);
$flightFcoToMxp = createFlight('FCO', 'MXP', 100);
$flightVceToBlq = createFlight('VCE', 'BLQ', 75);

// I create an array so that I can iterate them easily
$flights = [
    $flightFcoToBlq,
    $flightNapToVce,
    $flightFcoToVce,
    $flightMxpToBlq,
    $flightFcoToMxp,
    $flightVceToBlq
];
?>