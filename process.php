<?php
    session_start();
    $result = "received";
    $surprise = "YAHOOO...";
    $low=$_POST['low'];
    if($_POST['building'] == 'Casino'){
        $low = -($_POST['high']);
    }
    $newgold = rand($low, $_POST['high']);
    if ($newgold < 0){
        $result = "lost";
        $surprise = "BOOOOOO...";
    }
    $_SESSION['gold'] = $newgold + $_POST['gold'];
    $_SESSION['returntext']="You entered a ".$_POST['building']." and ".$result." ".$newgold." gold pieces! ".$surprise;
    header('Location: index.php');
?>
