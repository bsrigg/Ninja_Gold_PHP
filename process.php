<?php
    session_start();
    $result = "received";
    $surprise = "YAHOOO...";
    $low=$_POST['low'];
    if($_POST['resetscreen'] == 'RESET'){
        session_destroy();
        $_SESSION['status']='ALIVE';
        header('Location: index.php');
    }
    if($_POST['building'] == 'Casino'){
        $low = -($_POST['high']);
    }
    if ($_SESSION['status']=='ALIVE')
    {
        $newgold = rand($low, $_POST['high']);
        if ($newgold < 0){
            $result = "lost";
            $surprise = "BOOOOOO...";
        }
    }   
    if ($_SESSION['gold']+$newgold<0 and $_SESSION['status']!='DEAD')
    {
        $_SESSION['returntext']="You just Died!!!!!!! You lost another ".$newgold." gold pieces. ".date("m-d-Y h:i:sa");
        $_SESSION['status']='DEAD';
        $_SESSION['gold'] = $newgold + $_POST['gold'];
    }
    else if ($_SESSION['gold']+$newgold>=0 and $_SESSION['status']=='ALIVE')
    {
        $_SESSION['gold'] = $newgold + $_POST['gold'];
        $_SESSION['returntext']="You entered the ".$_POST['building']." and ".$result." ".$newgold." gold pieces! ".$surprise." ".date("m-d-Y h:i:sa");
    }
    else
    {
        $_SESSION['returntext']="You're are dead Dude!!!!!!!  You can't play anymore...";
    }
    array_push($_SESSION[history],$_SESSION['returntext']);
    header('Location: index.php');
?>
