<?php
//require_once 'ConnectionDB.php';
// read a random value from the array names
function randName() {
    $namesArr = array("Jan", "Frik", "Ben", "Riaan", "Maria", "Susan", "Santie", "Freddie", "Peter", "Garret Pieter", "Pieter Andre", "Miena", "Aaron", "Aron-James", "Shadow", "Shae", "Shahmir", "Shai", "Shane", "jaco");

    $name = $namesArr[rand(0, 19)];

    return $name;
}

// read a random value from the array surname
function randSurname() {
    $surnameArr = array('Duran', 'Durham', 'Dyer', 'Eaton', 'Edwards', 'Elliott', 'Ellis', 'Ellison', 'Emerson', 'England', 'Fuentes', 'Fuller', 'Fulton', 'Gaines', 'Gallagher', 'Gallegos', 'Galloway', 'Gamble', 'Van Zyl', 'Harold');

    $surname = $surnameArr[rand(0, 19)];

    return $surname;
}

//generate a random date of birth
function GenDateOfBirth() {

    $day = rand(1, 30);
    $month = rand(1, 12);
    $year = rand(1970, date("Y"));

    //$date = $day . "-" . $month . "-" . $year;
     $date = $year . "-" . $month . "-" .$day ;
    $time = strtotime($date);
    $newFormat = date('Y/m/d', $time);
    if (checkdate($month, $day, $year) == True) {
        return $newFormat;
    } else {
        return GenDateOfBirth();
    }
}

// get a age from dateofbirth 
function Getage($dateOfBirth) {


    $year = substr($dateOfBirth, 0, 4);
    
    $age = date("Y") - $year;


    return $age;
}

// get the initial from the name
function GetInisials($name) {
    $initial = explode(" ", $name);
    $initials = null;
    foreach ($initial as $I) {
        $initials .= $I[0];
    }
    return $initials;
}

// make the main line of the array
function GenerateLine($index) {
    $name = randName();
    $surname = randSurname();
    $dateOfBirth = GenDateOfBirth();
    $age = Getage($dateOfBirth);
    $initials = GetInisials($name);


    // $line = array($index => array("index" => $index, "name" => $name,"surname" => $surname, "initials" =>  $initials,"age" => $age,"dateOfBirth" => $dateOfBirth));
    $line = array("index" => $index, "name" => $name, "surname" => $surname, "initials" => $initials, "age" => $age, "dateOfBirth" => $dateOfBirth);
    return $line;
}


// write into a file
function WriteToFile($amount) {
    // makes a array 
    $array = createBigArr($amount);
    $createdCSV = 'output.csv';
    
    
    $output = fopen($createdCSV, "w");
    //$headers = array_keys($array[0]);

    foreach ($array as $keys => $line) {
        $headers = array_keys($line[0]);
    }
    fputcsv($output, $headers);
    foreach ($array as $keys => $line) {
        foreach ($line as $keys => $out) {
            
            fputcsv($output, $out);
        }
    }
    fclose($output);
}

function checkUnique($bigArray,$index){
     $bigArray1 = $bigArray;
     $generatedLine = GenerateLine($index);
     
     foreach ($bigArray1 as $keys => $singleLine){
         foreach ($singleLine as $key => $arrayLine){
             if($generatedLine['name'] == $arrayLine['name'] && $generatedLine['surname'] == $arrayLine['surname'] && $generatedLine['dateOfBirth'] == $arrayLine['dateOfBirth'] ){
              $generatedLine = checkUnique2($bigArray1,$index); 
              echo '1';
             }
         }
         }
         
         return $generatedLine ;

    
}

Function createBigArr($amountOfLines) {
$bigArr = array();

    for ($i = 0; $i < $amountOfLines; $i++) {
        
        //checkUnique2($bigArr ,$i)
        $bigArr[$i] = array(checkUnique($bigArr,$i));
        
    }
    

    return $bigArr;
}
function createTBL($file,$table){
    
   require_once 'ConnectionDB.php';
   createHeaders($table);
    mysqli_query($connection, '
    LOAD DATA LOCAL INFILE "'.$file.'"
        INTO TABLE '.$table.'
        FIELDS TERMINATED by \',\'
        LINES TERMINATED BY \'\n\'
        ignore 1 lines;
')or die(mysql_error());

$connection->close();
}

function createHeaders($table){
    require 'ConnectionDB.php';
    
    $dropTable = "Drop table $table" ;
mysqli_query($connection,$dropTable );
    
    $createTable = "create table $table ( `index` int,`name` varchar(255),`surname` varchar(255), `initials` varchar(3),`age` int(11),`dateOfBirth` date)" ;
mysqli_query($connection,$createTable);
}



