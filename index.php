<?php
    session_start();
    $gold = $_SESSION['gold']+0;
    if(!isset($_SESSION['history']))
    {
        $_SESSION['history']=array();
    }
    if(!isset($_SESSION['status']))
    {
        $_SESSION['status']='ALIVE';
    }
    function Read() {
        $reverse=array_reverse($_SESSION['history']);
        foreach($reverse as $data) {
            echo "$data";
        }
    }
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
    <div class='header'>
        <h1>Your Gold: 
            <span><input type="number" class="goldcount" name="gold" value=<?php echo $gold; ?> />
                <form action='process.php' method='POST'>
                    <input type='hidden' name='resetscreen' value="RESET" />
                    <input type='submit' name='resetnow' value='Reset' />
                </form>
            </span>
        </h1>
    </div>
    <div class='main'>
        <?php
            $dept = array(
                array("name" => "Farm", "low" => 10, "high" => 20),
                array("name"=> "Cave", "low"=> 5, "high"=> 10),
                array("name"=> "House", "low"=> 2, "high"=> 5),
                array("name"=> "Casino", "low"=> 0, "high"=> 50)
            );
            for($i=0; $i<count($dept); $i++){
                echo "<div class='dept'>";
                echo "<h2>".$dept[$i]['name']."</h2>";
                if($dept[$i]['name'] == 'Casino'){
                    echo "<h4>(earns/takes ".$dept[$i]['low']."-".$dept[$i]['high']." golds)</h4>";
                }
                else {
                    echo "<h4>(earns ".$dept[$i]['low']."-".$dept[$i]['high']." golds)</h4>";
                }
                echo "<form action='process.php' method='POST'><input type='hidden' name='building' value=".$dept[$i]['name']." /><input type='hidden' name='gold' value=".$gold." /><input type='hidden' name='low' value=".$dept[$i]['low']." /><input type='hidden' name='high' value=".$dept[$i]['high']." /><input type='submit' name='submitnow' value='Find Gold!'' /></form>";
                echo "</div>";
            }
            
        ?>
        <br/><br/>
        <div class="output"><?php Read(); ?></div>
        <?php 
            if ($_SESSION['status']=='DEAD')
            {
                echo "<img src='bloody-handprint.png' />";
            }
        ?>
    </div>
</body>
</html