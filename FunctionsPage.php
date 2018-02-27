<?php



function GenerateLine($index, $name, $surname) {

    $dateOfBirth = GenDateOfBirth();
    $age = Getage($dateOfBirth);
    $initials = GetInisials($name);

    return $line = array($index, $name, $surname, $initials, $age, $dateOfBirth);
}

function GenDateOfBirth() {

    $day = rand(1, 30);
    $month = rand(1, 12);
    $year = rand(1970, date("Y"));

    $date = $day . "-" . $month . "-" . $year;
    $time = strtotime($date);
    $newformat = date('d/m/Y', $time);
    if (checkdate($month, $day, $year) == True) {
        return $newformat;
    } else {
        return GenDateOfBirth();
    }
}

function Getage($dateOfBirth) {
    echo $dateOfBirth;
    
    $year = substr($dateOfBirth, 6, 4);
     echo $year;
    $age = date("Y") - $year;
    echo $age;

    return $age;
}

function GetInisials($name) {
    $Initial = explode(" ", $name);
    $initials = null;
    foreach ($Initial as $I) {
        $initials .= $I[0];
    }
    return $initials;
}
