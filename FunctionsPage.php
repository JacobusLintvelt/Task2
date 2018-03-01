<?php
// read a random value from the array names
function randName($names){
    
    $name = $names[rand(0, 19)];
    
    return $name;
    
    
}
// read a random value from the array surname
function randSurname($Surname){
    
    $sname = $Surname[rand(0, 19)];
    
    return $sname;
    
    
}
// make the main line of the array
function GenerateLine($index, $name, $surname) {

    $dateOfBirth = GenDateOfBirth();
    $age = Getage($dateOfBirth);
    $initials = GetInisials($name);
    

    $line = array($index => array("index" => $index, "name" => $name,"surname" => $surname, "initials" =>  $initials,"age" => $age,"dateOfBirth" => $dateOfBirth));
    
    return $line; 
}
//generate a random date of birth
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
// get a age from dateofbirth 
function Getage($dateOfBirth) {
    
    
    $year = substr($dateOfBirth, 6, 4);
    
    $age = date("Y") - $year;
   

    return $age;
}
// get the initail from the name
function GetInisials($name) {
    $Initial = explode(" ", $name);
    $initials = null;
    foreach ($Initial as $I) {
        $initials .= $I[0];
    }
    return $initials;
}
// write into a file
function WriteToFile($NamesArr,$SurnameArr){
    $file = fopen("CSV.csv","w"); 
    $count = 0;
    $arr = GenerateLine($count, randName($NamesArr), randSurname($SurnameArr));
  
foreach ($arr as $line)
  {
  fputcsv($file,));
  }

fclose($file); 

}
