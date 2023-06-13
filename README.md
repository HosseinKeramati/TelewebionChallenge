
<p align="center"><a href="https://telewebion.com" target="_blank"><img src="https://static.telewebion.com/assets/logo-top-new.png" width="400" alt="Laravel Logo"></a></p>

## Challenge #1
Implement a Lottery Game

# Getting Started

### Step 1:
Install dependencies using composer

```
composer install
```

### Step 2:

Copy `.env.example` to `.env` file and genereate `APP_KEY`:

```
php artisan key:generate
```

### Step 3:

Generate Prize map file:

```
php artisan db:seed
```
`prizeMap.txt` should be available in the root folder. A sample prize map file is already exists.

### Step 4:

Serve project
```
php artisan serve
```
Now the project is live at (http://localhost:8000).

#### End point(s):

[Perform Lottery](http://localhost:8000/api/v1/lottery) : `http://localhost:8000/api/v1/lottery`

-------

# Available tests

You can run tests with command below

```
php artisan test
```
