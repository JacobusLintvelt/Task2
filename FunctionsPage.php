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
function WriteToFile($amount) {
    // makes a array 
    $array = createBigArr($amount);
    $CreatedCSV = 'output.csv';


    $output = fopen($CreatedCSV, "w");
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

function checkUnique(){
$row = 0;
if (($handle = fopen("output.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
            echo $data[$c];
        }
    }
    fclose($handle);
}

    
}
function checkUnique2($bigArray,$Index){
    $bigArray1 = $bigArray;
    $generatedLine = GenerateLine($Index);
    echo $generatedLine;
    $unique = true;
    
    foreach ($bigArray1 as $keys => $singleLine){
        foreach ($singleLine as $key => $arrayLine){
            if ($generatedLine == array_shift($arrayLine) ){
                $unique = true;
            }
        }
        
    }
    
       
    
    
    if ($unique == true){
        return $generatedLine;
    }
    else {
       checkUnique2($bigArray1,$Index);
    }
    
}

Function createBigArr($lines) {
$bigArr = array();

    for ($i = 0; $i < $lines; $i++) {
        
        //checkUnique2($bigArr ,$i)
        $bigArr[$i] = array(GenerateLine($i));
        
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



