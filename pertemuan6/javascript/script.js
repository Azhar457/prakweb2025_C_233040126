// Variabel

// Deklarasi
var nama;

// Inisialisasi
nama = "Azhar";
nama = "Azhar2";


const universitas = "UNPAS";


let npm = "233040127";

npm = "233040126";

// Output
console.log(nama);
console.log(universitas);
console.log(npm);

// perbedaan var let const adalah var dapat diubah, let dapat diubah, const tidak dapat diubah
// kenapa var tidak digunakan lagi? dibanding let dan const karena alasan keamanan dan konsistensi 

const nilai = 100;

// Jika nilainya diatas dari 70 maka lulus, jika tidak maka tidak lulus jika lebih dari 100 maka nilai tidak valid
if (nilai > 100) {
    console.log("Nilai tidak valid");
} else if (nilai > 70) {
    console.log("Lulus");
} else {
    console.log("Tidak Lulus");
}

const kelas = "PW";

if (kelas === "PW") {
    console.log("PAK SANDHIKA");
} else {
    console.log("TIDAK ADA");
}

// Kenapa penggunaan === lebih baik dari == atau = ?   
// Karena === membandingkan nilai dan tipe data sedangkan == hanya membandingkan nilai

// JIka harganya 10.000 ubah variabel x jadi "baju"
// jika tidak jadi celana

const harga = 10000;
let x = "";

if (harga > 10000) {
    x = "baju";
} else {
    x = "celana";
}

console.log(x);

// Function

function jumlah(a, b) {
    return a + b;
}

function pengurangan(a, b) {
    return a - b;
}

console.log(jumlah(10, 10));
console.log(pengurangan(15, 5));

// Buatkan Fungsi luas Persegi
function luasPersegi(sisi) {
    return sisi * sisi;
}

console.log("Luas Persegi dengan sisi 10 adalah " + luasPersegi(10));

// ARRAY

let mahasiswa = ["Azhar", "Akmal", "Fernanda", "Haikal", "Fikri"];
console.log(mahasiswa);
for (let index = 0; index < mahasiswa.length; index++) {
    console.log(mahasiswa[index]);
}

// Array bisa menampung banyak tipe data termasuk function atau bahkan array lagi didalam array
const data = ["Uji Coba", 23, true, function test() { return "Hello" }, ["Azhar", "Akmal", "Fernanda", "Haikal", "Fikri"]];
console.log(data);

// Object Terdiri dari Key dan Value
const person = {
    nama: "Azhar",
    email: "azhar@gmail.com",
    npm: "233040126",
    sapa: function () {
        return "Halo, nama saya " + this.nama + "\n" + "dan npm saya " + this.npm + "\n" + "dan email saya " + this.email;
        // return `halo saya ${this.nama} dan npm saya ${this.npm} dan email saya ${this.email}`;
        // kenapa dua return tidak bisa digunakan? karena return akan menghentikan fungsi
    }
};
console.log(person.sapa());

// DOM

