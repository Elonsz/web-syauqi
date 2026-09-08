<p align="center">
    <img src="public/images/logo.png">
</p>

# Website Yayasan Cahaya Amanah
## Cara Deploynya

### 1. Diclone dulu

```zsh
git clone https://github.com/Elonsz/web-syauqi.git 
cd web-syauqi
```

### 2. Install depedencies & Vendor(Update opsional)
```zsh
composer update
composer install 
```

### 3. Ganti .env.exampe ke .env lalu configure
#### Terminal Laragon & Windows CMD:
```zsh
copy .env.example .env
code .env
```

#### Windows powershell, Linux, Macos & Git Bash:
```zsh
cp .env.example .env
code .env
```
### 4. Artisan migrate untuk sinkronisasi Database 
```zsh
php artisan migrate
```
### 5. (Opsional) Tambahkan seeder untuk database dummy
```zsh
php artisan migrate --seed
```
### 6. Run projeknya
```zsh
php artisan serve
```




