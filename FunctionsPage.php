<?php
//require_once 'ConnectionDB.php';
// read a random value from the array names
function randName() {
    $NamesArr = array("Jan", "Frik", "Ben", "Riaan", "Maria", "Susan", "Santie", "Freddie", "Peter", "Garret Pieter", "Pieter Andre", "Miena", "Aaron", "Aron-James", "Shadow", "Shae", "Shahmir", "Shai", "Shane", "jaco");

    $name = $NamesArr[rand(0, 19)];

    return $name;
}

// read a random value from the array surname
function randSurname() {
    $SurnameArr = array('Duran', 'Durham', 'Dyer', 'Eaton', 'Edwards', 'Elliott', 'Ellis', 'Ellison', 'Emerson', 'England', 'Fuentes', 'Fuller', 'Fulton', 'Gaines', 'Gallagher', 'Gallegos', 'Galloway', 'Gamble', 'Van Zyl', 'Harold');

    $sname = $SurnameArr[rand(0, 19)];

    return $sname;
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
    $newformat = date('Y/m/d', $time);
    if (checkdate($month, $day, $year) == True) {
        return $newformat;
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
            $lines = $out;
            fputcsv($output, $out);
        }
    }
    fclose($output);
}

function checkUnique($line){
    
  
    
    
}

Function createBigArr($lines) {


    for ($i = 0; $i <= $lines; $i++) {
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

//function createHeadersfromFile($file,$table){
//     require_once 'ConnectionDB.php';
//    $fp = fopen($file, 'r');
//$frow = fgetcsv($fp);
//
//foreach($frow as $column) {
//    if($columns) $columns .= ', ';
//    $columns .= "`$column` varchar(250)";
//}
//
//$create = "create table if not exists $table ($columns);";
//mysqli_query($connection,$create);
//}
function createHeaders($table){
    require 'ConnectionDB.php';
    echo 'hello';
    require_once 'ConnectionDB.php';
    $create = "create table $table ( `index` int,`name` varchar(255),`surname` varchar(255), `initials` varchar(3),`age` int(11),`dateOfBirth` date)" ;
mysqli_query($connection,$create);
}



