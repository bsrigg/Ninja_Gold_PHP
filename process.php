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
    if ($_SESSION['gold']<0)
    {
        $_SESSION['returntext']="You are DEAD!!!!!!!";
    }
    else
    {
        $_SESSION['gold'] = $newgold + $_POST['gold'];
        $_SESSION['returntext']="You entered the ".$_POST['building']." and ".$result." ".$newgold." gold pieces! ".$surprise;
    }
    array_push($_SESSION[history],$_SESSION['returntext']);
    header('Location: index.php');
?>
