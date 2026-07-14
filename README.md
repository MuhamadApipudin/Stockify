# Inventory & Warehouse Management System

Sistem manajemen inventaris berbasis web yang dikembangkan menggunakan **Laravel** dan **Flowbite/Tailwind CSS**. Aplikasi ini dirancang untuk mengelola alur operasional gudang secara terstruktur, aman, dan transparan.

## 🚀 Fitur Utama

- **Role-Based Access Control (RBAC):** Pemisahan hak akses antara Admin, Manajer, dan Staff.
- **Approval Workflow:** Sistem transaksi berjenjang; Staff menginput, Manajer memverifikasi.
- **Admin Bypass:** Akses khusus Admin untuk manajemen data dan penyesuaian stok instan.
- **Manajemen Inventaris:** CRUD Produk, Kategori, Supplier, dan Atribut Produk.
- **Pelaporan Komprehensif:** Laporan stok, pergerakan barang, dan aktivitas pengguna.
- **Stock Opname:** Fitur untuk sinkronisasi jumlah stok fisik dengan stok sistem.

## 👥 Role & Tanggung Jawab

| Role | Tanggung Jawab Utama |
| :--- | :--- |
| **Admin** | Manajemen sistem, CRUD user, kategori, supplier, serta audit laporan. |
| **Manajer Gudang** | Verifikasi (Approve/Reject) transaksi, pemantauan stok, dan stock opname. |
| **Staff Gudang** | Input transaksi operasional harian (barang masuk/keluar). |

## 🛠 Tech Stack

- **Framework:** Laravel 10/11
- **Frontend:** Flowbite & Tailwind CSS
- **Database:** MySQL
- **Icons:** Heroicons

## 📦 Cara Instalasi

1. **Clone Repository:**
   ```bash


   git clone https://github.com/MuhamadApipudin/laravel-flowbite-admin-dashboard.git
   cd laravel-flowbite-admin-dashboard



