<?php
    session_start();
    $result = "received";
    $surprise = "YAHOOO...";
    $low=$_POST['low'];
    if($_POST['resetscreen'] == 'RESET'){
        session_destroy();
        $_SESSION['status']='ALIVE';
        header('Location: index.php');
        die();
    }
    if($_POST['building'] == 'Casino'){
        $low = -($_POST['high']+120);
    }
    if ($_SESSION['status']=='ALIVE')
    {
        $newgold = rand($low, $_POST['high']);
        $goldamount=$newgold;
        if ($newgold < 0){
            $result = "lost";
            $surprise = "BOOOOOO...";
            $goldamount=-$newgold;
        }
    }   
    if ($_SESSION['gold']+$newgold<0 and $_SESSION['status']!='DEAD')
    {
        $_SESSION['returntext']="<p class='lost' >&#09;You just Died!!!!!!! You lost ".$goldamount." gold pieces... (".date("m-d-Y h:i:sa").")</p>";
        $_SESSION['status']='DEAD';
        $_SESSION['gold'] = $newgold + $_POST['gold'];
    }
    else if ($_SESSION['gold']+$newgold>=0 and $_SESSION['status']=='ALIVE')
    {
        $_SESSION['gold'] = $newgold + $_POST['gold'];
        $_SESSION['returntext']="<p class='".$result."' >&#09;You entered the ".$_POST['building']." and ".$result." ".$goldamount." gold pieces! ".$surprise." (".date("m-d-Y h:i:sa").")</p>";
    }
    else
    {
        $_SESSION['returntext']="<p class='lost' >&#09;You're dead Dude!!!!!!!  You can't play anymore...</p>";
    }
    array_push($_SESSION[history],$_SESSION['returntext']);
    header('Location: index.php');
?>
