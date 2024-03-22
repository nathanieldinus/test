<?php
session_start();
include 'admin/dist/functions.php';

//cek status pelanggan
if (!isset($_SESSION['loginPelanggan'])) {
    echo "<script>
        alert('Harap login terlebih dahulu!');
        document.location.href='login.php';
        </script>";
}

$totalBarang = 0;
global $totalHarga;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ORMATRADE</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Check-Out-Page-V100.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form-1.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Pretty-Product-List.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us-1.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us-2.css">
    <link rel="stylesheet" href="assets/css/WOWSlider-about-us.css">
</head>

<body>
    <div class="container-fluid">

        <h1 class="mt-4">
            <a href="Keranjang.php" class="">
                <i class="fa fa-arrow-circle-o-left" aria-hidden="true">
                </i>
            </a> Home
        </h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="">Checkout</i>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="table-responsive">
                        <div id="offline_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable no-footer" id="offline" role="grid" aria-describedby="offline_info" style="width: 100%;" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center" role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 99px;" aria-sort="ascending" aria-label="No: activate to sort column descending">No.
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 147px;" aria-label="Nama: activate to sort column ascending">
                                                    Gambar</th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 147px;" aria-label="Nama: activate to sort column ascending">
                                                    Nama Produk</th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 139px;" aria-label="Email: activate to sort column ascending">
                                                    Deskripsi
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">
                                                    Harga
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">
                                                    Jumlah
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="offline" rowspan="1" colspan="1" style="width: 111px;" aria-label="NIK: activate to sort column ascending">
                                                    Sub Harga
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1; ?>
                                            <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                                                <?php
                                                $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                                                $barang = $ambil->fetch_assoc();
                                                $subHarga = $jumlah * $barang["harga_produk"];
                                                ?>
                                                <tr class="odd">
                                                    <td class="text-center text-justify"><?= $nomor; ?></td>
                                                    <td><img src="admin/dist/assets/img/<?= $barang["foto_produk"]; ?>" width="50%"></td>
                                                    <td><?= $barang["nama_produk"]; ?></td>
                                                    <td><?= substr($barang['deskripsi'], 0, 100), ""; ?><a href="#">(Selengkapnya..)</a></td>
                                                    <td class="text-center text-justify">Rp <?= number_format($barang['harga_produk'], 0, ",", "."); ?></td>
                                                    <td class="text-center text-justify"><?= $jumlah; ?></td>
                                                    <td class="text-center text-justify">Rp <?= number_format($subHarga, 0, ",", "."); ?></td>
                                                </tr>
                                                <?php $nomor++; ?>
                                            <?php
                                                $totalBarang += $jumlah;
                                                $totalHarga += $subHarga;
                                            endforeach; ?>
                                        </tbody>
                                        <tfoot class="table-responsive-md table-responsive-sm table-info">
                                            <tr class="odd">
                                                <th class="w-75" colspan="6">Total Harga : </th>
                                                <th colspan="6">Rp <?= number_format($totalHarga, 0, ",", "."); ?> </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="alamat">Nama :</label>
                                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $_SESSION['loginPelanggan']['Nama'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="alamat">No Telepon :</label>
                                        <input type="text" name="telepon" id="telepon" class="form-control" value="0<?= $_SESSION['loginPelanggan']['no_hp'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label for="alamat">E-mail :</label>
                                        <input type="text" name="email" id="email" class="form-control" value="<?= $_SESSION['loginPelanggan']['email'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label for="alamat">Alamat :</label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="alamat" value="<?= $_SESSION['loginPelanggan']['alamat'] ?>" readonly>
                                    </div>
                                </div>

                                <!-- source code dari rajaongkir -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label for="">Provinsi</label>
                                        <select name="nama_provinsi" id="" class="form-control">
                                        <!-- Menggunakan javascript -->
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label for="">Distrik</label>
                                        <select name="nama_distrik" id="" class="form-control">

                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label for="">Ekspedisi</label>
                                        <select name="nama_ekspedisi" id="" class="form-control">
                                        
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label for="">Paket</label>
                                        <select name="nama_paket" id="" class="form-control">
                                        
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-10 col-lg-12">
                                    <button class="btn btn-info w-100" type="submit" name="bayar">Bayar Sekarang</button>
                                    <!-- checkout item belanja -->
                                    <?php
                                    if (isset($_POST['bayar'])) {
                                        $idPelanggan = $_SESSION['loginPelanggan']['id_pelanggan'];
                                        $namaPelanggan = $_SESSION['loginPelanggan']['Nama'];
                                        $noHpPelanggan = $_SESSION['loginPelanggan']['no_hp'];
                                        $alamatPelanggan = $_SESSION['loginPelanggan']['alamat'];
                                        date_default_timezone_set('Asia/Jakarta');
                                        $tanggalPembelian = date("Y-m-d H:i:s");
                                    
                                        $totalberat = $_POST['total_berat'];
                                        $provinsi = $_POST['provinsi'];
                                        $distrik = $_POST['distrik'];
                                        $tipe = $_POST['tipe'];
                                        $kodepos = $_POST['kodepos'];
                                        $ekspedisi = $_POST['ekspedisi'];
                                        $paket = $_POST['paket'];
                                        $ongkir = $_POST['ongkir'];
                                        $estimasi = $_POST['estimasi'];
                                      
                                        $total_pembelian = $totalbelanja + $ongkir;
                                    
                                        //Menyimpan ke tabel pembelian 
                                        $value = "INSERT 
                                            INTO `pembelian_barang` (id_pelanggan,Nama,tanggal_pembelian,alamat,no_telp,total_harga)
                                            VALUE ('$idPelanggan','$namaPelanggan','$tanggalPembelian','$alamatPelanggan','$noHpPelanggan','$totalHarga')";
                                        mysqli_query($conn, $value);
                                    
                                        //Memasukkan semua kedalam tabel checkout
                                        $idPembelian = mysqli_insert_id($conn);
                                        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                                            $ambil = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                                            $barang = $ambil->fetch_assoc();
                                            $namaProduk = $barang["nama_produk"];
                                            $hargaPrdouk = $barang['harga_produk'];
                                            $descProduk = $barang['deskripsi'];
                                            $fotoProduk = $barang['foto_produk'];
                                            $subHarga = $hargaPrdouk * $jumlah;
                                    
                                            $dataProduk = "INSERT
                                                INTO `checkout` (id_pembelian,id_produk,nama,harga_produk,jumlah,sub_harga,deskripsi,foto_produk)
                                                VALUE ('$idPembelian','$id_produk','$namaProduk','$hargaPrdouk','$jumlah','$subHarga','$descProduk','$fotoProduk') ";
                                            mysqli_query($conn, $dataProduk);
                                        }
                                    
                                        // unset($_SESSION['keranjang']);
                                    
                                        echo "<script>
                                        alert('Produk berhasil dicheckout');
                                        </script>";
                                        echo "<script>
                                        location = 'nota.php?id=$idPembelian'
                                        </script>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

<script>
    $(document).ready(function(){
      $.ajax({
        type: 'post',
        url: 'dataprovinsi.php',
        success: function(hasil_provinsi){
          $("select[name=nama_provinsi]").html(hasil_provinsi);
        }
      });

      $("select[name=nama_provinsi]").on("change", function(){
        // Ambil id_provinsi ynag dipilih (dari atribut pribadi)
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
        $.ajax({
          type: 'post',
          url: 'datadistrik.php',
          data: 'id_provinsi='+id_provinsi_terpilih,
          success:function(hasil_distrik){
            $("select[name=nama_distrik]").html(hasil_distrik);
          }
        })
      });

      $.ajax({
        type: 'post',
        url: 'jasaekspedisi.php',
        success: function(hasil_ekspedisi){
          $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
        }
      });

      $("select[name=nama_ekspedisi]").on("change", function(){
        // Mendapatkan data ongkos kirim

        // Mendapatkan ekspedisi yang dipilih
        var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
        // Mendapatkan id_distrik yang dipilih
        var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
        // Mendapatkan toatal berat dari inputan
        $total_berat = $("input[name=total_berat]").val();
        $.ajax({
          type: 'post',
          url: 'datapaket.php',
          data: 'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+$total_berat,
          success: function(hasil_paket){
            // console.log(hasil_paket);
            $("select[name=nama_paket]").html(hasil_paket);

            // Meletakkan nama ekspedisi terpilih di input ekspedisi
            $("input[name=ekspedisi]").val(ekspedisi_terpilih);
          }
        })
      });

      $("select[name=nama_distrik]").on("change", function(){
        var prov = $("option:selected", this).attr('nama_provinsi');
        var dist = $("option:selected", this).attr('nama_distrik');
        var tipe = $("option:selected", this).attr('tipe_distrik');
        var kodepos = $("option:selected", this).attr('kodepos');
        
        $("input[name=provinsi]").val(prov);
        $("input[name=distrik]").val(dist);
        $("input[name=tipe]").val(tipe);
        $("input[name=kodepos]").val(kodepos);
      });

      $("select[name=nama_paket]").on("change", function(){
        var paket = $("option:selected", this).attr("paket");
        var ongkir = $("option:selected", this).attr("ongkir");
        var etd = $("option:selected", this).attr("etd");

        $("input[name=paket]").val(paket);
        $("input[name=ongkir]").val(ongkir);
        $("input[name=estimasi]").val(etd);
      })
    });
  </script>

</body>
</html>