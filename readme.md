## Quickstart

Ikuti langkah berikut untuk melakukan installasi:

- Buka terminal di local server anda lalu jalankan perintah ```git clone https://github.com/rizqicp/pos.git```
- Setelah terinstall, buat database kosong lalu simpan.
- Masuk ke directory aplikasi pos, lakukan konfigurasi pada file database ```.env```, contohnya seperti dibawah ini, atau copy file ```.env.example```
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pos
    DB_USERNAME=root
    DB_PASSWORD=
    ```
  sesuaikan dengan database yang anda buat tadi dan konfigurasi di server local anda.
- Selanjutnya jalankan perintah ```composer install``` di terminal.
- Terminal akan mendownload dependensi untuk program, ini dapat memakan waktu cukup lama tergantung koneksi anda.
- Setelah selesai, jalankan ```php artisan migrate``` untuk membuat tabel pada database yang kita buat tadi.
- Lalu jalankan ```php artisan db:seed``` untuk mengisi tabel dengan data yang sudah disiapkan.
- Selesai, aplikasi dapat dijalankan dengan ```php artisan serve``` atau melalui ```localhost/pos/public```


## Masalah yang mungkin dijumpai

- Apabila mengalami error 'No application encryption key has been specified', coba jalankan ```php artisan key:generate```
- Gambar pada produk secara default tidak ada, ini dikarenakan directory penyimpanan masuk dalam list ```.gitignore```
  lakukan edit atau input baru pada produk untuk mengatasi masalah ini.

## Diagram aplikasi
- Dokumen teknis dalam bentuk diagram dapat dilihat di dalam directory <a href="https://github.com/rizqicp/pos/tree/master/dokumentasi">pos/dokumentasi</a>

- Use Case Diagram
 
![alt text](https://github.com/rizqicp/pos/blob/master/dokumentasi/UseCaseDiagramPOS.jpg?raw=true)



- Activity Diagram 
 
![alt text](https://github.com/rizqicp/pos/blob/master/dokumentasi/ActivityDiagramPOS.jpg?raw=true)



- Entity Relationship Diagram
 
![alt text](https://github.com/rizqicp/pos/blob/master/dokumentasi/ERDDiagramPOS.jpg?raw=true)
