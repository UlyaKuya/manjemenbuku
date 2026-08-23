# 📚 Sistem Manajemen Buku Perpustakaan

Aplikasi web manajemen perpustakaan berbasis **Laravel 12** dan **Livewire 3**.

Aplikasi menyediakan pengelolaan buku dan kategori dengan sistem autentikasi, role, permission, serta authorization berdasarkan hak akses pengguna.

---

## 🛠️ Teknologi

- Laravel 12
- Livewire 3
- Tailwind CSS
- SQLite / database relasional
- PHPUnit

---

## ✨ Fitur Aplikasi

### 🔐 Autentikasi

- Login
- Logout
- Registrasi
- Verifikasi email
- Reset password
- Update password
- Manajemen profil

### 👥 Manajemen Role & Permission

Aplikasi menggunakan sistem role dan permission untuk membatasi akses pengguna.

Role yang tersedia:

- Super Administrator
- Administrator
- Petugas Perpustakaan
- Anggota

### 📚 Manajemen Buku

Modul buku dibangun menggunakan Livewire dan menyediakan:

- Menampilkan daftar buku
- Menambahkan buku
- Mengubah buku
- Menghapus buku
- Pencarian berdasarkan judul
- Pencarian berdasarkan penulis
- Pencarian berdasarkan penerbit
- Pagination
- Validasi data
- Authorization berdasarkan role

### 📂 Manajemen Kategori

Modul kategori juga dibangun menggunakan Livewire dan menyediakan:

- Menampilkan daftar kategori
- Menambahkan kategori
- Mengubah kategori
- Menghapus kategori
- Pencarian kategori
- Pagination
- Menampilkan jumlah buku pada setiap kategori
- Authorization berdasarkan role

### 🔗 Relasi Buku dan Kategori

Setiap buku dapat memiliki kategori.

Relasi yang digunakan:

```text
Category
   │
   └── hasMany
          │
          ▼
        Books