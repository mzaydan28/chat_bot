# Panduan Deployment ke Hosting

## Persiapan File Environment

### 1. Copy File .env.example menjadi .env
```bash
cp .env.example .env
```

### 2. Edit File .env dengan Credentials Anda

Buka file `.env` dan isi dengan data yang sesuai:

```env
# Supabase Configuration
SUPABASE_PROJECT_ID=your_project_id
SUPABASE_URL=https://your_project_id.supabase.co
SUPABASE_KEY=your_supabase_anon_key

# Groq AI Configuration
GROQ_API_KEY=your_groq_api_key
GROQ_MODEL=llama-3.3-70b-versatile

# Environment (development/production)
ENVIRONMENT=production

# SSL Configuration for Production (WAJIB true untuk hosting)
ENABLE_SSL_VERIFY=true
```

### 3. Settings Penting untuk Production

**WAJIB** ubah di file `.env` saat hosting:
- `ENVIRONMENT=production`
- `ENABLE_SSL_VERIFY=true`

**JANGAN** ubah untuk local development:
- `ENVIRONMENT=development`
- `ENABLE_SSL_VERIFY=false`

## Langkah-langkah Upload ke Hosting

### 1. Upload File via FTP/cPanel
- Upload semua file KECUALI folder `node_modules` (jika ada)
- Pastikan file `.env` TIDAK ter-upload (sudah di-ignore di `.gitignore`)

### 2. Buat File .env Langsung di Hosting
Di cPanel atau File Manager hosting:
1. Buat file baru bernama `.env`
2. Copy isi dari `.env.example`
3. Isi dengan credentials production Anda
4. **PENTING**: Set `ENVIRONMENT=production` dan `ENABLE_SSL_VERIFY=true`

### 3. Set Permissions
```
chmod 644 .env
chmod 755 config/
chmod 755 public/
chmod 777 cache/
chmod 777 logs/
```

### 4. Testing
1. Akses website Anda
2. Test chat bot
3. Cek apakah koneksi ke Supabase berhasil
4. Cek apakah AI response bekerja

## Cara Mendapatkan Credentials

### Supabase
1. Login ke [https://supabase.com](https://supabase.com)
2. Pilih project Anda
3. Settings → API
4. Copy:
   - Project URL → `SUPABASE_URL`
   - anon public key → `SUPABASE_KEY`
   - Project Reference ID → `SUPABASE_PROJECT_ID`

### Groq API
1. Login ke [https://console.groq.com](https://console.groq.com)
2. API Keys → Create New Key
3. Copy API Key → `GROQ_API_KEY`

## Troubleshooting

### Error SSL Certificate
- Pastikan `ENABLE_SSL_VERIFY=true` di production
- Jika masih error, cek dengan hosting provider

### Koneksi Database Gagal
- Cek credentials Supabase
- Pastikan Supabase tidak blocking hosting IP Anda

### AI Tidak Merespon
- Cek `GROQ_API_KEY` valid
- Cek quota Groq API

## Security Checklist

✅ File `.env` tidak ter-commit ke Git  
✅ File `.env` tidak ter-upload ke public folder  
✅ `ENABLE_SSL_VERIFY=true` di production  
✅ Credentials production berbeda dengan development  
✅ Folder `cache/` dan `logs/` writable (777)  

## Contact

Jika ada masalah saat deployment, hubungi tim developer.
