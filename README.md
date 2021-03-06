# Semart Api Skeleton

>
> Semart Api Skeleton adalah skeleton untuk membangun aplikasi berbasis Api
>

## Vidoe

[![Semart Youtube](http://img.youtube.com/vi/-PvoMagr4JM/0.jpg)](https://www.youtube.com/watch?v=-PvoMagr4JM)

## Screenshot

#### Api Doc
![Api Doc](doc/assets/full.png)

#### Sandbox
![Sandbox](doc/assets/sandbox.png)

#### Cronjob Management
![Cronjob](doc/assets/cron.png)

#### Setting Management
![Setting](doc/assets/setting.png)

#### Media Management
![Media](doc/assets/media.png)

#### Group Management
![Group](doc/assets/group.png)

#### Menu Management
![Menu](doc/assets/menu.png)

#### User Management
![User](doc/assets/user.png)

#### Profile Management
![Profile](doc/assets/profile.png)

#### Client/Api Consumer Management
![Consumer](doc/assets/consumer.png)

## Requirement

#### Abaikan Requirement jika Kamu menggunakan Docker

> 
> * PHP >= 7.4.0
>
> * Extension Ctype 
>
> * Extension Iconv
>
> * Extension Json
>
> * Extension Openssl
>
> * Extension Pcntl
>
> * Extension Pdo
>
> * Extension Posix
>
> * Extension Redis
>
> * RDBMS (MySQL/MariaDB/PostgreSQL/OracleDB/SQLServer)
>
> * Redis Server >= 4.0
>
> * Composer
>
> * Symfony Console 
>

## Install

### Pre Step

> 
> Clone dan Generate PKI (Public Key Infrastucture)
>

```bash
git clone https://github.com/KejawenLab/SemartApiSkeleton
cd SemartApiSkeleton
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

### Non Docker Install

>
> Install menggunakan metode Non Docker secara default akan menggunakan secure connection configuration
>
> Ini artinya password database akan dienkripsi sehingga lebih aman
>

```bash
composer update --prefer-dist -vvv
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load --no-interaction
php bin/console assets:install
php bin/console cron:start
symfony server:start
```

> 
> Buka browser pada halaman https://localhost:8000/api/doc atau sesuai alamat yang tertera ketika menjalankan perintah `symfony server:start`
>

### Docker Install

>
> Install menggunakan metode Docker adalah cara tercepat untuk memulai tanpa perlu install dependencies terlebih dahulu
>
> * Ubah file `.env.template` menjadi file `.env`
>
> * Ubah isi file `.env` sesuai dengan kebutuhan, berikut contoh konfigurasinya

```dotenv
# In all environments, the following files are loaded if they exist,
# the latter taking precedence over the former:
#
#  * .env                contains default values for the environment variables needed by the app
#  * .env.local          uncommitted file with local overrides
#  * .env.$APP_ENV       committed environment-specific defaults
#  * .env.$APP_ENV.local uncommitted environment-specific overrides
#
# Real environment variables win over .env files.
#
# DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
#
# Run "composer dump-env prod" to compile .env files for production use (requires symfony/flex >=1.2).
# https://symfony.com/doc/current/best_practices.html#use-environment-variables-for-infrastructure-configuration

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=3GXjF83smPRZWvHCZ7O+mA==
#TRUSTED_PROXIES=127.0.0.0/8,10.0.0.0/8,172.16.0.0/12,192.168.0.0/16
#TRUSTED_HOSTS='^(localhost|example\.com)$'
###< symfony/framework-bundle ###

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=4e938d7532adc7163e0c657b1eb3ce93ed8f42c2
###< lexik/jwt-authentication-bundle ###

###> snc/redis-bundle ###
# passwords that contain special characters (@, %, :, +) must be urlencoded
REDIS_URL=redis://session
###< snc/redis-bundle ###

###> CUSTOM ###
NGINX_WEBROOT=/semart/public
APP_SUPER_ADMIN=SPRADM
APP_TITLE="Semart Api Skeleton"
APP_DESCRIPTION="Semart Api Skeleton"
APP_VERSION=1.0@dev
APP_UPLOAD_DIR=%kernel.project_dir%/storage
###< CUSTOM ###

###> doctrine/doctrine-bundle ###
DATABASE_DRIVER=pdo_mysql
DATABASE_SERVER_VERSION=5.7
DATABASE_CHARSET=utf8mb4
DATABASE_USER=root
DATABASE_PASSWORD=4ZFbDniRw+vx+QnUY93Fhg==
DATABASE_NAME=semart
DATABASE_HOST=db
DATABASE_PORT=3306
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# For a PostgreSQL database, use: "postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=11&charset=utf8"
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
# DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
###< doctrine/doctrine-bundle ###

###> nelmio/cors-bundle ###
CORS_ALLOW_ORIGIN=^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$
###< nelmio/cors-bundle ###

```

>
> * Jalankan perintah berikut:
>

```bash
docker-compose build && docker-compose up
docker-compose exec app bash -c "php bin/console semart:encrypt semart"
```

> 
> * Abaikan warning atau error yang terjadi
> 
> * Ubah nilai `DATABASE_PASSWORD` pada file `.env` sesuai dengan hasil perintah di atas
>
> * Jalankan perintah berikut:
>

```bash
docker-compose exec app bash -c "php bin/console cache:clear"
docker-compose exec app bash -c "chmod 777 -R var"
docker-compose exec app bash -c "php bin/console doctrine:database:create"
docker-compose exec app bash -c "php bin/console doctrine:schema:update --force"
docker-compose exec app bash -c "php bin/console doctrine:fixtures:load --no-interaction"
docker-compose exec app bash -c "php bin/console assets:install"
```

> 
> * Aplikasi berjalan pada alamat `http://localhost:9876/api/doc`
>
> * Adminer berjalan pada alamat `http://localhost:6789`
>

## Cron Daemon

#### Start Cron Daemon

```bash
php bin/console cron:start
```

#### Stop Cron Daemon

```bash
php bin/console cron:stop
```

## Fitur

>
> * RESTful Api Generator
>
> * Api Documentation
>
> * Sandbox
>
> * JWT Authentication
>
> * Login Failure Limiter
>
> * Single Sign In
>
> * Query Extension
>
> * Soft Deletable
>
> * Audit Trail
>
> * User Management
>
> * Profile Management
>
> * Group Management
> 
> * Menu Management
>
> * Permission Management
>
> * Setting Management
>
> * Cronjob Management
>
> * Cache Management
>
> * Media Management
>
> * Public & Private Media Support
>
> * Public & Private Api Support
>
> * Upgrade Management
>
> * House Keeping
> 
> * Password History
>
> * Api Client/Consumer Management
>

## Cara Penggunaan

#### Buat Interface Model

```php
<?php

declare(strict_types=1);

namespace KejawenLab\ApiSkeleton\Test\Model;

/**
 * @author Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 */
interface TestInterface
{
    public function getId(): ?string;

    public function getName(): ?string;
}

```

#### Buat Class Entity

```php
<?php

declare(strict_types=1);

namespace KejawenLab\ApiSkeleton\Entity;

use DH\DoctrineAuditBundle\Annotation\Auditable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use KejawenLab\ApiSkeleton\Repository\TestRepository;
use KejawenLab\ApiSkeleton\Test\Model\TestInterface;
use KejawenLab\ApiSkeleton\Util\StringUtil;
use Ramsey\Uuid\UuidInterface;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 * @ORM\Table(name="test_table")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @Auditable()
 */
class Test implements TestInterface
{
    use BlameableEntity;
    use SoftDeleteableEntity;
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     *
     * @Groups({"read"})
     *
     * @SWG\Property(type="string")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(max=255)
     * @Assert\NotBlank()
     *
     * @Groups({"read"})
     */
    private ?string $name;
    
    public function __construct()
    {
        $this->name = null;
    }

    public function getId(): ?string
    {
        return (string) $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = StringUtil::title($name);

        return $this;
    }
}

```

Kamu bisa juga menggunakan [Symfony Maker](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html) untuk membuat entity lalu kemudian memodifikasinya sesuai dengan spek dari Semart Api Skeleton.

#### Generate RESTful Api

```bash
php bin/console semart:generate Test
```

#### Update form type

```php
//class: KejawenLab\ApiSkeleton\Form\TestType 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }
```

#### Update search query extension

```php
//class: KejawenLab\ApiSkeleton\Test\Query\SearchQueryExtension
    public function apply(QueryBuilder $queryBuilder, Request $request): void
    {
        $query = $request->query->get('q');
        if (!$query) {
            return;
        }

        /**
        * Uncomment to implement your own search logic
        *
        * $alias = $this->aliasHelper->findAlias('root');
        * $queryBuilder->andWhere($queryBuilder->expr()->like(sprintf('UPPER(%s.name)', $alias), $queryBuilder->expr()->literal(sprintf('%%%s%%', StringUtil::uppercase($query)))));
        */
    }
```

Dan walllaaaaaaa **Api + Dokumentasi + Permission** secara otomatis dibuatkan untuk Kamu.

## Dokumentasi

>
> Dokumentasi terletak pada folder [`doc`](doc) pada proyek ini.
> 
> Kamu juga bisa mengunjungi [Arsiteknologi[dot]Com](https://arsiteknologi.com/category/symfony/semartapiskeleton) untuk mengetahui tips dan trik dari Semart Api Skeleton
>

## Demo

>
> Kunjungi [Demo](https://arsiteknologi.com:8080/api/doc)
>
> * Username: `admin`
> * Password: `admin`
>
> **NB:** Data akan direset setiap **15 menit** sekali
>

## Copyright

Semart Api Skeleton dikembangkan dan dimaintain oleh [KejawenLab](https://github.com/KejawenLab)

## Lisensi

Lisensi dari Semart Api Skeleton adalah [MIT License](LICENSE) namun proyek yang dibangun menyeseuaikan dengan kebijakan masing-masing
