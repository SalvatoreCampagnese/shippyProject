<?php
// I include airport and flight's class (these files also initializes some airports and flights to use and show to users)
require_once('./classes/airportClass.php');
require_once('./classes/flightClass.php');

class bestChoice {
    public $isDirect;
    public $flight;
    public $totalPrice;
}

function getLowestPrice($airportOne, $airportTwo){
    global $flights;
    $mostEconomicChoice = null;
    $lowestPrice = PHP_INT_MAX; // I define the variable at maximum possible so that I can compare with others
    // I consider that I have at least one flight and one airport (so I do not need to check the length of values)
	foreach ($flights as $flight) {
        if($flight->code_departure === $airportOne && $flight->code_arrival === $airportTwo){
            // If the flight is a direct choice and price is less than the lowest I take it 
            if($flight->price <= $lowestPrice){ // I use less or equal cause this is a direct fly so I think that it would be better than one with stepovers
                $lowestPrice = $flight->price;
                $mostEconomicChoice = new bestChoice();
                $mostEconomicChoice->isDirect = true;
                $mostEconomicChoice->flight = $flight;
                $mostEconomicChoice->totalPrice = $lowestPrice;
            }
        }else if($flight->code_departure === $airportOne){
        	foreach ($flights as $flightStepOver) {
        	    if($flightStepOver->code_departure === $flight->code_arrival && $flightStepOver->code_arrival === $airportTwo){
            	    $object = new \stdClass; 
            	    $object->firstFlight = $flight;
            	    $object->secondFlight = $flightStepOver;
            	    if(($flight->price + $flightStepOver->price) < $lowestPrice){
                        $lowestPrice = $flight->price + $flightStepOver->price;
                        $mostEconomicChoice = new bestChoice();
                        $mostEconomicChoice->isDirect = false;
                        $mostEconomicChoice->flight = $object;
                        $mostEconomicChoice->totalPrice = $lowestPrice;
            	    }
        	    }
        	}
        }
    }
    return $mostEconomicChoice;
}
if(isset($_POST) && isset($_POST['reset'])){
    unset($_POST);
}else if(isset($_POST) && isset($_POST['departure']) && isset($_POST['arrival'])){
    $bestChoice = getLowestPrice($_POST['departure'], $_POST['arrival']);
}
?>
<html>
    <head>
        <title>perfectFlight</title>
        <link rel="stylesheet" href="./assets/css/styles.css">
    </head>
    <body>
        <?php
        // If user already setted departure and arrival
        // Show him the info's retrieved
        if(isset($_POST) && isset($_POST['departure']) && isset($_POST['arrival'])){
            ?>
            <form action="#" method="POST">
            <?php
            if($bestChoice && $bestChoice->isDirect){
                print("Volo diretto<br/>");
                print_r($bestChoice->flight->code_departure." to ".$bestChoice->flight->code_arrival."<br/>");
                print_r("Prezzo totale: ".$bestChoice->totalPrice."€");
            }else if($bestChoice){
                print_r("Volo con uno scalo<br/>");
                print_r($bestChoice->flight->firstFlight->code_departure.' A '.$bestChoice->flight->firstFlight->code_arrival."<br>");
                print_r($bestChoice->flight->secondFlight->code_departure.' A '.$bestChoice->flight->secondFlight->code_arrival."<br>");
                print_r("Prezzo totale: ".$bestChoice->totalPrice." €");
            }else{
                print_r("Nessun volo trovato");
            }
            ?>
            <input type="hidden" name="reset" value="true">
            <button type="submit">Nuova ricerca</button>
            </form>
        <?php
        }else{
            // If the user has not setted departure and arrival
            // I'm going to show him the form
            ?>
            <form action="#" method="POST">
                <p>Aereoporto partenza:</p>
                <select name="departure">
                    <?php
                        foreach($airports as $airport){
                            print_r("<option value='".$airport->code."'>".$airport->name."</option>");
                        }
                    ?>
                </select><br/>
                <p>Aereoporto destinazione:</p>
                <select name="arrival">
                    <?php
                        foreach($airports as $airport){
                            print_r("<option value='".$airport->code."'>".$airport->name."</option>");
                        }
                    ?>
                </select>
                <button type="submit">Ricerca!</button>
            </form>
            <?php
        }
        ?>
    </body>
</html>