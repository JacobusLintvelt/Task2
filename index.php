<!DOCTYPE html>
<?php
      require 'FunctionsPage.php';
      
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $NamesArr = array("Jan", "Frik", "Ben", "Riaan", "Maria", "Susan", "Santie", "Freddie", "Peter", "Garret Pieter", "Pieter Andre", "Miena", "Aaron", "Aron-James", "Shadow", "Shae", "Shahmir", "Shai", "Shane", "jaco");
        $SurnameArr = array('Duran', 'Durham', 'Dyer', 'Eaton', 'Edwards', 'Elliott', 'Ellis', 'Ellison', 'Emerson', 'England', 'Fuentes', 'Fuller', 'Fulton', 'Gaines', 'Gallagher', 'Gallegos', 'Galloway', 'Gamble', 'Van Zyl', 'Harold');

           
            $count = 0;
            set_time_limit ( 0 );
            WriteToFile($NamesArr ,$SurnameArr);
            //while(100  > $count){
           // print_r(GenerateLine($count, randName($NamesArr), randSurname($SurnameArr))) ;
            echo '</br>';
            $count++;
          //  }
        ?>
    </body>
</html>

<!--
"1","Andre","van Zuydam", "A", "33","13/02/1979" 
"2","Tyron James", "Hall", "TJ", "32", "03/06/1980";
-->
