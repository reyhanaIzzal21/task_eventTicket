# Event Workshop Ticket Management System

Sebuah website manajemen tiket workshop yang memungkinkan pengguna untuk melihat dan memesan tiket workshop yang tersedia. Website ini menyediakan platform bagi admin untuk mengelola workshop dan pesanan tiket, serta memungkinkan pengguna untuk melakukan pemesanan tiket workshop dengan mudah.

## Fitur Utama

### Role User
1. Melihat daftar workshop yang tersedia
2. Melihat detail workshop (tempat, waktu, harga, dll)
3. Melakukan pemesanan tiket workshop
4. Melakukan pembayaran dan upload bukti pembayaran
5. Melihat status pemesanan tiket

### Role Admin
1. Mengelola data workshop (tambah, edit, hapus)
2. Melihat dan mengelola daftar pemesanan tiket
3. Memverifikasi pembayaran tiket
4. Mengelola status workshop (buka/tutup pendaftaran)
5. Melihat laporan pemesanan

## Struktur Database

Website ini menggunakan 3 tabel utama:

1. **users**
   - Menyimpan data pengguna
   - Memiliki role: admin dan user
   - Menyimpan informasi nama, email, password, dll

2. **workshop**
   - Menyimpan informasi workshop
   - Mencakup nama, harga, tanggal, waktu, lokasi
   - Menyimpan status workshop (buka/tutup)
   - Menyimpan gambar thumbnail workshop

3. **booking_transaction**
   - Menyimpan data transaksi pemesanan tiket
   - Terhubung dengan tabel workshop dan users
   - Menyimpan detail pembayaran dan bukti pembayaran
   - Mencatat status pembayaran

## Kegunaan Website

1. **Bagi Penyelenggara Workshop**
   - Mempermudah manajemen pendaftaran workshop
   - Memantau peserta workshop secara real-time
   - Mengelola pembayaran secara terorganisir
   - Mengatur ketersediaan tiket workshop

2. **Bagi Peserta Workshop**
   - Melihat informasi workshop dengan mudah
   - Melakukan pemesanan tiket secara online
   - Melakukan pembayaran secara fleksibel
   - Memantau status pemesanan tiket

## Teknologi yang Digunakan

- PHP Native
- MySQL Database
- HTML, CSS
- JavaScript

## Pembuat
Project Manager: Reyhan Izzal
Back end: 1. Izza Rahmatullah, 2. Dhama Giovanni
Front end: 1. Ayub Raditya.W, 2. Andrean anggara.P
System Analyst: Vicky Ade.R
Quality Assurance: 1.Yoga Andri.S
Project: ThreeTix - Event Ticket
Tahun: 2025
