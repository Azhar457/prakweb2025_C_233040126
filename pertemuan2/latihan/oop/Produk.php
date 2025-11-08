<?php
class produk 
{
    public $judul, $penerbit, $harga;
    public function __construct($judul, $penerbit, $harga)
    {
        $this->judul = $judul;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
    }

    public function getLabel()
    {
        return $this->judul . " | | " . $this->penerbit;
    }
}

class komik extends produk
{
    public $jmlHalaman;
    public function __construct($judul, $penerbit, $harga, $jmlHalaman)
    {
        // super($judul, $penerbit, $harga);
        $this->jmlHalaman = $jmlHalaman;
        parent::__construct($judul, $penerbit, $harga);
    }

    public function getLabel()
    {
        return $this->judul;
    }


    public function getInfoKomik()
    {
        echo "Label : " . parent::getLabel();
        echo "<br>";
        echo "harga : " . $this->harga;
        echo "<br>";
        echo "Jumlah Halaman : " . $this->jmlHalaman;
    }
}

$komik1 = new komik("Naruto","Shonen Jump",35000,200);
$komik1->getInfoKomik();
echo "<br>";
echo $komik1->getLabel();