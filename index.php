<!DOCTYPE html>
<?php
$NamesArr = array("Jan", "Frik", "Ben", "Riaan", "Maria", "Susan", "Santie", "Freddie", "Peter", "Garret Pieter", "Pieter Andre", "Miena", "Aaron", "Aron-James", "Shadow", "Shae", "Shahmir", "Shai", "Shane", "jaco");
$SurnameArr = array('Duran', 'Durham', 'Dyer', 'Eaton', 'Edwards', 'Elliott', 'Ellis', 'Ellison', 'Emerson', 'England', 'Fuentes', 'Fuller', 'Fulton', 'Gaines', 'Gallagher', 'Gallegos', 'Galloway', 'Gamble', 'Van Zyl', 'Harold');
set_time_limit(0);
//ini_set('memory_limit', '-1');


require 'FunctionsPage.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <title>csv import</title>
    </head>
    <body>
        <div class="container">
            <form class=" form-control panel panel-default" method="POST">
                <h3> Generate a csv file:</h3>
                <div class="form-group">
                    <label class="label label-default" for="iinputamount">Amount of records</label>
                    <input class="form-control" type="text" name="iinputAmount" pattern="[0-9]+" required="">
                </div>
                    <input class="btn btn-info" type="submit" name="submit">
                

            </form>

            <!----------------------Form 2-------------------------------------------------------------------->

            <form class=" form-control panel panel-default" method="POST">
                <h3>Choose a file to generate a table</h3>
                
                <div class="form-group">
                    <input class="form-control "  type="file" id="file"  name="file" required="" accept=".csv">
                </div>   
                
                <div class="form-group">
                    <input  class=" btn btn-info" type="submit" name="submitFile" value="Create Table">
                    <input  class="btn btn-danger" type="reset" value="Cancel">
                </div>
                
            </form>


            
            <?php
            $outputMessage = "";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (isset($_POST['file'])) {
                    $file = $_POST['file'];
                    createTBL($file, "csv_import");

                    $outputMessage = 'Table created';
                } else {
                    $outputMessage = 'Please select a file';
                }
                if (isset($_POST['iinputAmount'])) {
                    $amount = $_POST['iinputAmount'];

                    WriteToFile($amount);

                    $outputMessage = 'file created';
                }
            }
            ?>

            <h3>Status message:</h3>  <p><?php if (isset($outputMessage)) {
                echo $outputMessage;
            } ?></p>
        </div>
    </body>
</html>

<!--
"1","Andre","van Zuydam", "A", "33","13/02/1979" 
"2","Tyron James", "Hall", "TJ", "32", "03/06/1980";
-->
