<h3>Registrasi Pelanggan Baru :</h3><br>
<div class="form-group">

    <form action="" method="post">
        <div class="form-group w-50">
            <label for=""><b>Nama pelanggan :</b></label>
            <input type="text" name="pelanggan" required placeholder="isi pelanggan" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for=""><b>Alamat :</b></label>
            <input type="text" name="alamat" required placeholder="isi alamat" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for=""><b>Telp :</b></label>
            <input type="text" name="telp" required placeholder="isi telp" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for=""><b>Email :</b></label>
            <input type="email" name="email" required placeholder="email" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for=""><b>Password :</b></label>
            <input type="password" name="password" required placeholder="password" class="form-control">
        </div>
        <div class="form-group w-50">
            <label for=""><b>Konfirmasi Password :</b></label>
            <input type="password" name="konfirmasi" required placeholder="password" class="form-control">
        </div>
        <div>
            <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
        </div>
        </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $pelanggan = $_POST['pelanggan'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi = $_POST['konfirmasi'];

        if ($password === $konfirmasi) {
            $sql = "INSERT INTO tblpelanggan VALUES ('','$pelanggan','$alamat','$telp','$email','$password',1)";

            $db->runSQL($sql);
            header("location:?f=home&m=info");
        }else {
            echo "<h2>PASSWORD TIDAK SAMA DENGAN KONFIRMASI</h2>";
        }
    }

?>