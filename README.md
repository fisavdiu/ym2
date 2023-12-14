
## YM Discussions

YM Discussion is a clone of reddit like features, for posting, commenting and creating content

Project is created with Laravel Sail in Windows 11 and WSL2 + Ubuntu 22.04. 

To run the project you should have Docker installed

### Install
Clone the repository.
```bash 
git clone git@github.com:fisavdiu/ym2.git
```
Install the dependencies
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
Build and start containers
```bash
sail up -d
```
Enter inside docker container
```bash
sail bash
cp .env.example .env
composer start
```

### Have fun

[Localhost](http://localhost) - Laravel Project

[Mailpit](http://localhost:8025) - Mailpit - Verify users and receive emails locally




### Programming Language and Tools used

- **[Laravel](https://laravel.com/)**
- **[Laravel Sail](https://laravel.com/docs/10.x/sail)**
- **[Livewire](https://laravel-livewire.com/)**
- **[WindUI](https://wind-ui.com/)**
- **[Tailwind CSS](https://tailwindcss.com/)**
- **[Docker](https://www.docker.com/)**
- **[MySQL](https://www.mysql.com/)**
- **[PHPStorm](https://www.jetbrains.com/phpstorm/)**

## Security Vulnerabilities

This code is intended for coding skills and it is not suitable for production purposes

