<h2>Registrasi Berhasil Silahkan login</h2>
<div class="float-left mr-4">
    <a class="btn btn-primary" href="?f=home&m=login" role="button">LOGIN</a>
</div>

<?php 

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password' ";
        $count = $db->rowCOUNT($sql);

        if ($count == 0) {
            echo "<center><h3>Email atau Password Salah</h3></center>";
        }else {

            $sql = "SELECT * FROM tbluser WHERE email='$email' AND password='$password' ";
            $row = $db->getITEM($sql);

            $_SESSION['user']=$row['email'];
            $_SESSION['level']=$row['level'];
            $_SESSION['iduser']=$row['iduser'];
            
            header("location:index.php");
        }
    }

?>
