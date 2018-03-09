<!DOCTYPE html>
<?php
$NamesArr = array("Jan", "Frik", "Ben", "Riaan", "Maria", "Susan", "Santie", "Freddie", "Peter", "Garret Pieter", "Pieter Andre", "Miena", "Aaron", "Aron-James", "Shadow", "Shae", "Shahmir", "Shai", "Shane", "jaco");
$SurnameArr = array('Duran', 'Durham', 'Dyer', 'Eaton', 'Edwards', 'Elliott', 'Ellis', 'Ellison', 'Emerson', 'England', 'Fuentes', 'Fuller', 'Fulton', 'Gaines', 'Gallagher', 'Gallegos', 'Galloway', 'Gamble', 'Van Zyl', 'Harold');


require 'FunctionsPage.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST">
            Generate a csv file:</br></br>
            Amount of records <input type="text" name="iinputamount" pattern="[0-9]+" required="">

            <input type="submit" name="sub"></br>


        </form>

       <!----------------------Form 2-------------------------------------------------------------------->
        </br>----------------------------------------------------------------------------------</br>
        <form method="POST">
            Choose a file to generate a table :</br></br>
            
            <input type="file" id="file"  name="file" required="" accept=".csv"><input type="reset" value="Cancel"></br></br>
            <input type="submit" name="sub" value="Create Table"></br>
        </form>
    <?php
            $outputMessage = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
             if (isset($_POST['file'])) {
                $file = $_POST['file'];
                createTBL($file, "csv_import");
                
                $outputMessage = 'Table created';
            }
            else{
                $outputMessage = 'Please select a file';
            }
             if (isset($_POST['iinputamount'])) {
            $amount = $_POST['iinputamount'];
            set_time_limit(0);
            
            WriteToFile($amount);
            checkUnique();
            $outputMessage = 'file created';
        }
        }
        ?>
        </br>----------------------------------------------------------------------------------
        <br>Status message:  <p><?php  if (isset($outputMessage)) { echo $outputMessage; }?></p>
        
    </body>
</html>

<!--
"1","Andre","van Zuydam", "A", "33","13/02/1979" 
"2","Tyron James", "Hall", "TJ", "32", "03/06/1980";
-->
