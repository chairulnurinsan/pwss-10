<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName= "toko_ol";

    $kon =  mysqli_connect($host, $user, $pass);
    if (!$kon){
        die ("Gagal koneksi...");
    }
    
    $hasil = mysqli_select_db($kon, $dbName);
    if(!$hasil){
        $hasil = mysqli_query($kon, "CREATE DATABASE $dbName");
        if(!$hasil)
            die("Gagal Buat Database");
        else
            $hasil = mysqli_select_db($kon, 'toko_ol');
            if(!$hasil) die("Gagal Konek Database");
    }

    $sqlTabelBarang = "create table if not exists barang (
        idbarang int auto_increment not null primary key,
        nama varchar(40) not null,
        harga int not null default 0,
        stok int not null default 0,
        foto varchar(70) not null default '',
        KEY(nama))";
        mysqli_query($kon, $sqlTabelBarang) or die("gagal Buat Tabel Barang ");

    $sqlTabelHjual = "create table if not exists hjual ( 
        idhjual int auto_increment not null primary key, 
        tanggal date not null, 
        namacust varchar(40) not null,
        email varchar(50) not null default '', 
        notelp varchar (20) not null default ''
        )";

    mysqli_query($kon, $sqlTabelHjual) or die("Gagal Buat Tabel Header Jual ");

    $sqlTabelDjual = "create table if not exists djual (
        iddjual int auto_increment not null primary key,
        idhjual int not null,
        idbarang int not null,
        qty int not null,
        harga int not null
        )";
    
    mysqli_query($kon, $sqlTabelDjual) or die("Gagal Buat Tabel Detail Jual ");
    
?>