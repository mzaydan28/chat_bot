# 🚀 Panduan Hosting di InfinityFree - Step by Step

## 📋 Persiapan

### Yang Anda Butuhkan:
- ✅ Akun email aktif
- ✅ Project chatbot ini (sudah siap)
- ✅ Credentials Supabase & Groq API (dari file .env)

---

## 1️⃣ DAFTAR AKUN INFINITYFREE

### Step 1.1: Buka Website InfinityFree
1. Buka browser, kunjungi: **https://infinityfree.net**
2. Klik tombol **"Sign Up"** atau **"Get Started Free"**

### Step 1.2: Isi Form Registrasi
1. Masukkan **Email Address** Anda
2. Masukkan **Password** (minimal 8 karakter)
3. Centang "I agree to the Terms of Service"
4. Klik **"Sign Up"**

### Step 1.3: Verifikasi Email
1. Buka email Anda
2. Cari email dari InfinityFree
3. Klik link verifikasi
4. Login ke akun InfinityFree

---

## 2️⃣ BUAT HOSTING ACCOUNT

### Step 2.1: Create New Account
1. Setelah login, klik **"Create Account"**
2. Anda akan diminta memilih domain

### Step 2.2: Pilih Domain/Subdomain
**Pilihan 1 - Subdomain Gratis (Recommended untuk testing):**
- Pilih **"Use a subdomain"**
- Ketik nama subdomain Anda, contoh: `chatbot-disperindag`
- Pilih domain dari dropdown (contoh: `.infinityfreeapp.com`, `.epizy.com`, dll)
- Contoh hasil: `chatbot-disperindag.infinityfreeapp.com`

**Pilihan 2 - Custom Domain (jika punya domain sendiri):**
- Pilih **"Use your own domain"**
- Masukkan domain Anda (contoh: `chatbot.example.com`)
- Anda perlu setup DNS nanti

### Step 2.3: Buat Account
1. Baca terms of service
2. Klik **"Create Account"**
3. Tunggu proses setup (1-5 menit)
4. Anda akan dapat **username** (contoh: `if0_12345678`)

### Step 2.4: Catat Informasi Penting
Setelah account dibuat, catat:
- ✏️ **Username**: `if0_xxxxxxxx`
- ✏️ **Password**: (password hosting Anda)
- ✏️ **Domain**: `your-subdomain.infinityfreeapp.com`
- ✏️ **FTP Hostname**: `ftpupload.net`
- ✏️ **cPanel URL**: `https://cpanel.infinityfree.net`

---

## 3️⃣ UPLOAD FILE PROJECT

### Step 3.1: Login ke cPanel
1. Klik **"Control Panel"** atau buka: https://cpanel.infinityfree.net
2. Login dengan username & password hosting

### Step 3.2: Buka File Manager
1. Di cPanel, cari **"Online File Manager"**
2. Klik untuk membuka

### Step 3.3: Masuk ke Folder htdocs
1. Double-click folder **`htdocs`**
2. Ini adalah folder public website Anda
3. ⚠️ **HAPUS semua file default** yang ada (index.html, dll)

### Step 3.4: Upload File Project
**Cara 1 - Via File Manager (Recommended):**

1. Klik tombol **"Upload Files"**
2. Pilih **SEMUA file project** KECUALI:
   - ❌ Folder `.git`
   - ❌ File `.env` (akan dibuat manual nanti)
   - ❌ File `README.md` (opsional)
   - ❌ Folder `node_modules` (jika ada)

3. **File yang HARUS di-upload:**
   - ✅ `index.php`
   - ✅ Semua folder: `assets/`, `cache/`, `config/`, `logs/`, `public/`
   - ✅ File `.htaccess` (jika ada)
   - ✅ File `.env.example`

4. Tunggu upload selesai (tergantung kecepatan internet)

**Cara 2 - Via FTP (Alternative):**

Jika upload lewat File Manager gagal/lambat:

1. Download FileZilla: https://filezilla-project.org
2. Install FileZilla Client
3. Buka FileZilla, masukkan:
   - **Host**: `ftpupload.net`
   - **Username**: `if0_xxxxxxxx` (username hosting Anda)
   - **Password**: (password hosting Anda)
   - **Port**: `21`
4. Click **"Quickconnect"**
5. Di sebelah kanan, masuk ke folder `htdocs`
6. Drag & drop semua file project dari komputer Anda

---

## 4️⃣ BUAT FILE .ENV DI HOSTING

### Step 4.1: Buka File Manager
1. Di cPanel, buka **Online File Manager**
2. Masuk ke folder **`htdocs`**

### Step 4.2: Buat File .env Baru
1. Klik tombol **"New File"** atau **"+ File"**
2. Nama file: **`.env`** (dengan titik di depan)
3. Klik **"Create"**

### Step 4.3: Edit File .env
1. Klik kanan file **`.env`**
2. Pilih **"Edit"** atau **"Code Edit"**
3. Copy paste ISI ini:

```env
# Supabase Configuration
SUPABASE_PROJECT_ID=wbuwkgspuyoqibgsvswr
SUPABASE_URL=https://wbuwkgspuyoqibgsvswr.supabase.co
SUPABASE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6IndidXdrZ3NwdXlvcWliZ3N2c3dyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njk5NzcwMDMsImV4cCI6MjA4NTU1MzAwM30.U9M-kCST-ZPFuZLi2uIUcQ4ncU75r3J4CqYkXuRfIFw

# Groq AI Configuration
GROQ_API_KEY=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
GROQ_MODEL=llama-3.3-70b-versatile

# Environment - PENTING: Set production untuk hosting!
ENVIRONMENT=production

# SSL Configuration - PENTING: Set true untuk hosting!
ENABLE_SSL_VERIFY=true
```

4. **PENTING**: Pastikan `ENVIRONMENT=production` dan `ENABLE_SSL_VERIFY=true`
5. Klik **"Save Changes"**
6. Close editor

---

## 5️⃣ SET PERMISSIONS FOLDER

### Step 5.1: Set Permission Folder Cache
1. Di File Manager, klik kanan folder **`cache`**
2. Pilih **"Change Permissions"** atau **"Chmod"**
3. Set permission: **`777`** atau centang semua checkbox
4. Klik **"Change Permissions"**

### Step 5.2: Set Permission Folder Logs
1. Klik kanan folder **`logs`**
2. Pilih **"Change Permissions"**
3. Set permission: **`777`**
4. Klik **"Change Permissions"**

### Step 5.3: Verifikasi Permission File .env
1. Klik kanan file **`.env`**
2. Pilih **"Change Permissions"**
3. Set permission: **`644`**
4. Klik **"Change Permissions"**

---

## 6️⃣ TESTING WEBSITE

### Step 6.1: Buka Website
1. Buka browser baru
2. Ketik domain Anda: `http://your-subdomain.infinityfreeapp.com`
3. Atau klik **"Visit Website"** di cPanel

### Step 6.2: Test Chatbot
1. Halaman chatbot muncul? ✅
2. Coba ketik pertanyaan
3. Bot merespons? ✅

### Step 6.3: Cek Error (jika ada masalah)
1. Di File Manager, buka folder **`logs`**
2. Cek file log terbaru
3. Atau buka: `http://your-domain.com/logs/` (jika public)

---

## 7️⃣ TROUBLESHOOTING

### ❌ Error 403 Forbidden
**Solusi:**
- Pastikan ada file `index.php` di folder `htdocs`
- Bukan di subfolder

### ❌ Error 500 Internal Server Error
**Solusi:**
1. Cek file `.env` sudah benar
2. Cek permission folder `cache` dan `logs` = 777
3. Cek PHP error log di cPanel

### ❌ Bot Tidak Merespons
**Solusi:**
1. Cek `GROQ_API_KEY` di file `.env`
2. Cek koneksi ke Groq API (quota habis?)
3. Buka browser console (F12) untuk lihat error

### ❌ Database Error / Supabase Error
**Solusi:**
1. Cek `SUPABASE_KEY` dan `SUPABASE_URL` di `.env`
2. Pastikan `ENABLE_SSL_VERIFY=true`
3. Cek apakah Supabase memblokir IP InfinityFree
4. Login ke Supabase Dashboard → Settings → API → pastikan key masih aktif

### ❌ Website Lambat
**Catatan:** InfinityFree adalah hosting gratis, jadi:
- Bisa lebih lambat dari XAMPP local
- Ada limit bandwidth dan requests
- Untuk production serius, pertimbangkan hosting berbayar

---

## 8️⃣ TIPS & BEST PRACTICES

### 🔒 Keamanan
- ✅ Jangan share file `.env` ke siapa pun
- ✅ Jangan commit `.env` ke Git (sudah di-ignore)
- ✅ Gunakan HTTPS jika tersedia

### ⚡ Performance
- Clear cache folder berkala jika penuh
- Monitor penggunaan bandwidth di cPanel
- Compress gambar di folder `assets/images/`

### 📊 Monitoring
- Cek log error berkala di folder `logs/`
- Monitor API quota Groq
- Cek storage Supabase

### 🔄 Update
Jika ada perubahan di local:
1. Upload file yang berubah via File Manager
2. Atau gunakan FTP
3. Clear cache jika perlu

---

## 9️⃣ UPGRADE KE DOMAIN CUSTOM (OPSIONAL)

### Jika Anda Punya Domain Sendiri:

1. **Beli domain** di provider (Namecheap, Niagahoster, dll)

2. **Setup DNS** di domain provider:
   - **Type**: A Record
   - **Name**: @ atau subdomain
   - **Value**: IP hosting InfinityFree
   - Cek IP di cPanel → Account Settings

3. **Tambah domain** di InfinityFree:
   - cPanel → Addon Domains atau Parked Domains
   - Masukkan domain Anda
   - Tunggu propagasi DNS (24-48 jam)

---

## 🆘 BUTUH BANTUAN?

### Support InfinityFree:
- Forum: https://forum.infinityfree.net
- Knowledge Base: https://infinityfree.net/support

### Masalah Technical Chatbot:
- Cek file logs di folder `logs/`
- Hubungi tim developer

---

## ✅ CHECKLIST AKHIR

Sebelum launch, pastikan:

- [ ] File sudah di-upload semua
- [ ] File `.env` sudah dibuat dengan credentials production
- [ ] `ENVIRONMENT=production` di `.env`
- [ ] `ENABLE_SSL_VERIFY=true` di `.env`
- [ ] Permission folder `cache/` = 777
- [ ] Permission folder `logs/` = 777
- [ ] Website bisa diakses
- [ ] Chatbot merespons dengan benar
- [ ] Koneksi Supabase berfungsi
- [ ] AI/Groq API berfungsi

---

## 🎉 SELESAI!

Chatbot Anda sekarang sudah LIVE di internet! 🚀

Domain Anda: `http://your-subdomain.infinityfreeapp.com`

Share ke tim dan mulai terima feedback dari user!

---

**Dibuat dengan ❤️ untuk Chatbot Disperindag**
