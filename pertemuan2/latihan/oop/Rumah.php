<?php
class Rumah{

    public $warnaCat = "Putih";
    public $jumlahKamar = 99;
    public $alamat = "Jln. Setiabudhi No.1";



    // Method
    public function __construct($warnaCat, $jumlahKamar) {
        $this->warnaCat = $warnaCat;
        $this->jumlahKamar = $jumlahKamar;
    }

    public function kunciPintu()
    {
        return "Rumah ini dikunci !";
    }

    public function bukaPintu()
    {
        return "Rumah ini dibuka !";
    }

    public function gantiWarna($warnaCat)
    {
        $this-> warnaCat = $warnaCat;
        return "Rumah ganti warna jadi " . $this->warnaCat;
    }

    function pasangListrik(Rumah $rumah){
        return "Rumah ini dipasang listrik, rumah yang berwarna" . 
        $rumah->warnaCat;
    }
}

// Rumah Andi
$rumahAndi = new Rumah("Ungu",1);
echo pasangListrik($rumahAndi);

// Rumah Saya
$rumahSaya = new Rumah("Hijau", 9);
echo "Rumah Saya Warna Cat : " . $rumahSaya->warnaCat;
echo "<br>";
echo "Rumah Saya : " . $rumahSaya->kunciPintu();
echo "<br>";
echo "Rumah Saya Jumlah Kamar : " . $rumahSaya->jumlahKamar;

// $rumahSaya->gantiWarna("Merah");
// echo "Rumah Saya Warna Cat : " . $rumahSaya->warnaCat;
echo "<br>";



// Rumah Tetangga
$rumahTetangga = new Rumah("Kuning",11);
echo "Rumah Tetangga Warna Cat : " . $rumahTetangga->warnaCat;
echo "<br>";
echo "Rumah Tetangga : " . $rumahTetangga->kunciPintu();
echo "<br>";
echo "Rumah Saya Jumlah Kamar : " . $rumahTetangga->jumlahKamar;


?>