<?php

function GenerateLine($index, $name, $surname) {

    $dateOfBirth = GenDateOfBirth();
    $age = Getage($dateOfBirth);
    $initials = Getinitials($name);

    $line = array($index, $name, Surname, $initials, $age, $dateOfBirth);
}

  function GenDateOfBirth() {

    $day = rand(1, 30);
    $month = rand(1, 12);
    $year = rand(1970, date("Y"));

    $date = $day . "-" . $month . "-" . $year;
    $time = strtotime($date);
    $newformat = date('d-m-Y',$time);
    if (checkdate($month, $day, $year) == True) {
        return $newformat;
    } else {
        return GenDateOfBirth();
    }
}

function Getage($dateOfBirth)
{
   $year =  date('Y', $dateOfBirth );
   
   $age = date("Y") - $year;
    
    return $age;
            
}

function GetInisials($name){
    
}
