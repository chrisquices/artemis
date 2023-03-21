![Alt text](logo-2.svg)

## Built With

[![Laravel][Laravel.com]][Laravel-url]
[![Livewire][Livewire.com]][Livewire-url]
[![Bootstrap][Bootstrap.com]][Bootstrap-url]
[![JQuery][JQuery.com]][JQuery-url]

[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com

[Livewire.com]: https://img.shields.io/badge/Livewire-fb6fa9?style=for-the-badge&logo=livewire&logoColor=white
[Livewire-url]: https://jquery.com

[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com

[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com

## Prerequisites

* PHP ^8.1

## Installation

Download or clone the repository
```
git clone https://bitbucket.org/rosphrethic/artemis.git
```

Install packages
```
composer install
```

Create your environment file
```
cp .env.example .env
```

Generate project key
```
php artisan key:generate
```

Create storage folder link
```
php artisan storage:link
```

Configure your environment file, do not forget the following variables
```
APP_NAME=Artemis
APP_URL=http://artemis.test
```

Run migrations
```
php artisan migrate:fresh --seed
```

Link Valet
```
valet link
```

## Usage

To access the project, go to:

```
http://artemis.test
```

Log in with the following credentials:
```
Administrator User
email: admin@artemis.com
password: password
```
