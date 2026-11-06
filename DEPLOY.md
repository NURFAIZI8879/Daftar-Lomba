# Deploy TiketIT ke Hosting Gratis (InfinityFree)

## Prasyarat
- Akun InfinityFree
- Domain (mis. `tiketit.infinityfreeapp.com`)
- MySQL database name (mis. `if0_XXXXXX_tiketit`)

## Langkah Deploy

1. Upload semua file ke `htdocs/` (kecuali `.git/`, `database.sql`, `database_infinityfree.sql`)
2. Buat database di InfinityFree panel
3. Import `database_infinityfree.sql` via phpMyAdmin
4. Buat `config.local.php` di root dengan kredensial InfinityFree:
   ```php
   <?php
   return [
       'database' => [
           'host' => 'sqlXXX.infinityfree.com',
           'port' => 3306,
           'dbname' => 'if0_XXXXXX_tiketit',
           'charset' => 'utf8mb4',
           'username' => 'if0_XXXXXX',
           'password' => 'your_password',
       ],
   ];
   ```
5. Pastikan folder `public/uploads/` writable (chmod 755)
6. Akses via domain

## Catatan
- Jangan upload folder `Screenshots/` (besar) - boleh dihapus sebelum upload
- Pastikan `.htaccess` ikut ter-upload
- Test semua fitur setelah deploy
