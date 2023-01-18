# booking-crm
- Booking-crm, web application, build using PHP-Laravel & inertia-vuejs.
- MySQL DB
- Using nginx web server, http/2.

## Project overview:

<table>
    <tr>
        <td><img src="./public/captures/1.png" alt="project" /></td>
        <td><img src="./public/captures/2.png" alt="project" /></td>
   </tr> 
    <tr>
        <td><img src="./public/captures/3.png" alt="project" /></td>
    <td><img src="./public/captures/2.png" alt="project" /></td></tr>
  </tr>
    <tr>
        <td><img src="./public/captures/5.png" alt="project" /></td>
        <td><img src="./public/captures/6.png" alt="project" /></td>
   </tr> 
    <tr>
        <td><img src="./public/captures/7.png" alt="project" /></td>
        <td><img src="./public/captures/8.png" alt="project" /></td>
    </tr> 
</table>

## Starting Project

1. install laravel packs

```composer
composer install
```

1. Run the following command to generate your app key:

```
php artisan key:generate
```

Create the symbolic link:

```
php artisan storage:link
```

2. install npm and run

```npm
npm install
```

```npm
npm run dev
```

## Generate Data

```
php artisan migrate:fresh --seed
```

## validate PHP-PSR2

```
./vendor/bin/phpcs app/Http/Controllers/Listing/ListingController.php --standard=PSR2
```

----- 
Need helps? Reach me out

> Email: soulaimaneyahya1@gmail.com

> Linkedin: soulaimane-yahya

All the best :beer: