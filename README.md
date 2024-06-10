
# BizHub
BizHub merupakan platfowm berbasis website yang memiliki fungsi untuk memasarkan produk UMKM yang ada di Surabaya. Fungsinya agar UMKM di Surabaya lebih mudah dikenal oleh masyarakat Umum. Serta memiliki konten blog untuk membantu Owner UMKM untuk terus update tentang berita terkait pemasaran UMKM

## Fitur Bizhub
Dalam website BizHub terdapat 3 Role nantinya yaitu Super Admin, UMKM Owner, dan Customer


**Fitur Of Web :**
- Login User
- Register Konsumen and Register UMKM Owner
- Wishlist Product
- Comment UMKM Product
- Blog (only UMKM Owner)

**Super Admin :** 
- Manage User List
- Manage Blog List
- Manage Blog Categories
- Manage UMKM Product
- Manage Product Categories
- Manage Roles And Permissions
- All frontend display ( UMKM LIST, BLOG LIST )

**UMKM Owner**
- Edit Profile UMKM
- Manage UMKM Product by UMKM Owner ID
- All frontend display ( UMKM LIST, BLOG LIST )

**Customer**
- Edit Profile
- Only display UMKM list


## Tech Stack
Website Bizhub menggunakan Teknologi Sebagai Berikut
- Laravel 10
- Filament 3
- Tabler (Bootstrap UI KIT)
- Alpine JS
- Sweetalert

## Installation

### Requirement

- PHP 8.3
- MySql 8

### Clone And Installation

#### Please make sure you have database before clone this repo. `Database Ex: Bizhub`

```
1.Run git clone https://github.com/Fakhri17/bizhub.git
2.Run composer install
3.Run cp .env.example .env
4.Run php artisan key:generate
5.Run php artisan migrate
6.Run php artisan serve
```
### Command Run new 

```
1. php artisan migrate:fresh
2. php artisan db:seed
3. php artisan storage:link
```

### User of test
```
Super Admin
email: admin@gmail.com
password: admin123

UMKM Owner 1
email: umkmowner@gmail.com
password: umkm123

UMKM Owner 2
email: umkmowner2@gmail.com
password: umkm123

Customer
email: customer@gmail.com
password: customer123
```
