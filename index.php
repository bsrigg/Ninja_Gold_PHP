<?php
    session_start();
    $gold = $_SESSION['gold']+0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Ninja Gold Game</title>
</head>
<body>
    <h1>Your Gold: <span><input type="number" class="goldcount" name="gold" value=<?php echo $gold; ?> /><br/>
    <br/>
        <?php
            $dept = array(
                array("name" => "Farm", "low" => 10, "high" => 20),
                array("name"=> "Cave", "low"=> 5, "high"=> 10),
                array("name"=> "House", "low"=> 2, "high"=> 5),
                array("name"=> "Casino", "low"=> 0, "high"=> 50)
            );
            for($i=0; $i<count($dept); $i++){
                echo "<div class='dept'>";
                echo "<h5>".$dept[$i]['name']."</h5>";
                if($dept[$i]['name'] == 'Casino'){
                    echo "<h6>(earns/takes ".$dept[$i]['low']."-".$dept[$i]['high']." golds)</h6>";
                }
                else {
                    echo "<h6>(earns ".$dept[$i]['low']."-".$dept[$i]['high']." golds)</h6>";
                }
                echo "<form action='process.php' method='POST'><input type='hidden' name='building' value=".$dept[$i]['name']." /><input type='hidden' name='gold' value=".$gold." /><input type='hidden' name='low' value=".$dept[$i]['low']." /><input type='hidden' name='high' value=".$dept[$i]['high']." /><input type='submit' name='submitnow' value='Find Gold!'' /></form>";
                echo "</div>";
            }
        ?>
        <br/><br/>
        <textarea rows="25" cols="227"><?php echo $_SESSION['returntext'] ?>&#13</textarea>
</body>
</html