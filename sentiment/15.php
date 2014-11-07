<?php
/*
Adaptation en php du fameux et excellent scripte Astro-MoonPhase de Brett Hamilton écrit en Perl.
http://search.cpan.org/~brett/Astro-MoonPhase-0.60/

Ce Scripte vous permettra de connaître, à une date donnée, l'illumination de la Lune, son age, 
sa distance en km par rapport à la Terre, son angle en degrés, sa distance par rapport au soleil, 
et son angle par rapport au soleil.

*/

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $method = $_POST['method'];
} else {
    $method = $_GET['method'];
}

//define different routes
$moon = new Moon();
$methods = get_class_methods($Moon);

if (empty($_GET['op']) || $_GET['op'] == '') {
    $moon->fallback();
    die;
}

$op = $_GET['op'];
if (in_array($op, $methods)) {
    $moon->$op();
} else {
    //echo "fallbackop is null";
    $moon->fallback();
}


class Moon
{
    function __construct()
    {
    }

    public function fallback()
    {
        //if there is no function to recall
        //echo "Moon Phase Fallback.";
        $timestamp = time();
        $response = Moon::moon_phase(date('Y', $timestamp), date('n', $timestamp), date('j', $timestamp));
        echo json_encode($response);
    }



    public function moon_phase($year, $month, $day)
    {
        // $year = $_GET['year'];
        // $month = $_GET['month'] ;
        // $day = $_GET['day'];


        $c = $e = $jd = $b = 0;
        if ($month < 3) {
            $year--;
            $month += 12;
        }
        ++$month;
        $c = 365.25 * $year;
        $e = 30.6 * $month;
        $jd = $c + $e + $day - 694039.09; //jd is total days elapsed
        $jd /= 29.5305882; //divide by the moon cycle
        $b = (int)$jd; //int(jd) -> b, take integer part of jd
        $jd -= $b; //subtract integer part to leave fractional part of original jd
        $b = round($jd * 8); //scale fraction from 0-8 and round
        if ($b >= 8) {
            $b = 0; //0 and 8 are the same so turn 8 into 0
        }
        switch ($b) {
            case 0:
                return 'New Moon';
                break;
            case 1:
                return 'Waxing Crescent Moon';
                break;
            case 2:
                return 'Quarter Moon';
                break;
            case 3:
                return 'Waxing Gibbous Moon';
                break;
            case 4:
                return 'Full Moon';
                break;
            case 5:
                return 'Waning Gibbous Moon';
                break;
            case 6:
                return 'Last Quarter Moon';
                break;
            case 7:
                return 'Waning Crescent Moon';
                break;
            default:
                return 'Error';

        }

    }
}

?>