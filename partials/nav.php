<?php
$inactive = 1600; 
ini_set('session.gc_maxlifetime', $inactive);

    session_start();
    if (isset($_SESSION['time']) && (time() - $_SESSION['time'] > $inactive)) {
        // last request was more than 2 hours ago
        session_unset();     // unset $_SESSION variable for this page
        session_destroy();   // destroy session data
        header("Location:index.php");
    }
    $_SESSION['time'] = time(); 

?>
<div class="nav">
       <div class="logo">
          <a href="/Modlice/index.php"><img src="/Modlice/images/logo.jpg" alt="Logo 3D radionica"></a>  
        </div>
        <div class="nav-primary">
            <ul>
                <li><a href="/Modlice/index">Početna strana</a></li>
                <li><a href="/Modlice/o-nama">O nama</a></li>
                <li><a href="#">Omiljeno</a></li>
                <li><a href="/Modlice/cart">Korpa</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role']=='admin') { ?>
                <li><a href="/Modlice/admin">Admin</a></li>
                <?php  } ?>
            </ul>
        </div>
        <div class="nav-secondary">
            <ul>
                <?php
                if (isset($_SESSION['username'])) {?>
                   <p>Zdravo, <?php echo $_SESSION['username'];?></p>
                    <li><a href="logout">Odjavi se</a></li>
                <?php }else{?>
                <li><a href="registracija">Registruj se</a></li>
                <li><a href="login">Prijavi se</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>