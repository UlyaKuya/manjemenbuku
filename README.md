# 📚 Sistem Manajemen Buku Perpustakaan

Aplikasi Manajemen Buku berbasis **Laravel 12** dan **Livewire 3** sebagai tugas mata kuliah Pemrograman Web2.

---

## 👨‍💻 Teknologi

- Laravel 12
- Livewire 3
- Tailwind CSS
- MySQL

---

## ⚙️ Cara Instalasi

```bash
git clone https://github.com/UlyaKuya/manjemenbuku.git

cd manjemenbuku

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate:fresh --seed

npm run dev

php artisan serve
```

---

## 🔐 Akun Login

Semua akun menggunakan password yang sama:

**Password:** `password`

| Role | Email |
|------|-------|
| Super Administrator | superadmin@app.test |
| Administrator | admin@app.test |
| Petugas Perpustakaan | petugas@app.test |
| Anggota | member@app.test |

---

## ✨ Fitur

- ✅ Login & Logout
- ✅ CRUD Buku
- ✅ Search Buku
- ✅ Pagination
- ✅ Authorization Policy
- ✅ Role & Permission
- ✅ Multi User
- 🚧 Custom Middleware (Dalam Pengembangan)

---

## 👤 Pengembang

**Nama:** Ulya Panwasusana / NRP 241226004 Ubhinus Malang 2026

**Framework:** Laravel 12

**Mata Kuliah:** Pemrograman Web 2