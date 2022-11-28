<?php 

    session_start();
    require_once "dbcontroller.php";
    $db = new DB;

    $sql = "SELECT * FROM tblkategori ORDER BY kategori";
    $row = $db->getALL($sql);

    if (isset($_GET['log'])) {
        session_destroy();
        header("location:index.php");
    }

    function cart(){

        global $db;

        $cart = 0;
        
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan' && $key<>'user' && $key<>'level' && $key<>'iduser') {
                $id = substr($key,1);

                $sql = "SELECT * FROM tblmenu WHERE idmenu=$id";

                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    $cart++;
                }
            }
        }

        return $cart;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restoran | Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="?f=bagian&m=kontak">Kontak</a>
        <a href="?f=bagian&m=tentang">Tentang</a>
        <a href="?f=bagian&m=diskusi">Profil</a>
        <a href="#download">Download</a>
        <a href="#tutorial">Tutorial</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-4">
                <h2 class="mt-2">Restoran Rizky</h2>
            </div>
            <div class="col-md-9">
                <?php 
                
                    if (isset($_SESSION['pelanggan'])) {
                        echo '
                            <a class="float-right mt-4 mr-2 btn btn-outline-primary" href="?log=logout" role="button">Logout</a>
                            <div class="float-right mt-4 mr-4">Pelanggan : '.$_SESSION['pelanggan'].'</div>
                            <div class="float-right mt-4 mr-4">Jumlah : ( <a href="?f=home&m=beli">'.cart().'</a> ) </div>
                            <a class="float-right mt-4 mr-4 btn btn-outline-primary" href="?f=home&m=histori" role="button">Histori</a>
                        ';
                    }else {
                        echo '
                            <div class="btn-group float-right mt-4 mr-4" role="group" aria-label="Basic outlined example">
                                <a class="btn btn-outline-primary" href="?f=home&m=login" role="button">Login</a>
                                <a class="btn btn-outline-primary" href="?f=home&m=daftar" role="button">Daftar</a>
                            </div>
                            <nav class="navbar float-right mt-3 mr-4 navbar-light">
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Pencarian" aria-label="search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                                </form>
                            </nav>
                        ';
                    }
                
                ?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-3">
                <h3>Kategori :</h3>
                <hr>

                <?php if(!empty($row)) {?>  
                <ul class="nav flex-column">

                <?php foreach($row as $r): ?>    
                    <li class="nav-item"><a class="nav-link" href="?f=home&m=produk&id=<?php echo $r['idkategori'] ?>"><?php echo $r['kategori'] ?></a></li>
                <?php endforeach ?>

                </ul>
                <?php } ?>
            </div>
            <div class="col-md-9">
                <?php 
                
                    if (isset($_GET['f']) && isset($_GET['m'])) {
                        $f=$_GET['f'];
                        $m=$_GET['m'];

                        $file = $f.'/'.$m.'.php';

                        require_once $file;

                    }else {
                        require_once "home/produk.php";
                    }
                
                ?>
            </div>
        </div>

        <button class="btn btn-primary mr-5" style="float: right" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>

        <div class="row mt-5">
            <div class="col mt-5">
                <p class="text-center mt-4">2022 - copyright@smkrevit.com</p>
            </div>
        </div>
    </div>
</body>
</html>

