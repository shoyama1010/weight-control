# weight-control

<img width="1214" height="607" alt="Image" src="https://github.com/user-attachments/assets/6b4685e9-78cd-4f6f-8b10-313b89391547" />

<img width="1358" height="597" alt="Image" src="https://github.com/user-attachments/assets/67be76ae-4c6f-4dbe-9862-e9b28fae60ca" />

<img width="1350" height="604" alt="Image" src="https://github.com/user-attachments/assets/4f9b9e0f-6f17-429d-8e27-0d5bfeebfb87" />

# 作成した目的


# アプリケーションURL
ローカル環境
http://localhost

# 機能一覧
・認証機能

・検索機能

・CRUD機能


# 使用技術
・Laravel 8

・nginx 1.21.1

・php 7.4.9

・html

・css

・mysql 8.0.26

・javascript (モーダル画面のみ)

・fortify

# テーブル設計

![Image](https://github.com/user-attachments/assets/2a1afd78-53af-44a0-8b3d-10d8291c6e6f)

![Image](https://github.com/user-attachments/assets/3c7c88ee-784c-46ca-826c-f81aa23531dd)

# ER図

![Image](https://github.com/user-attachments/assets/ae88f826-c42f-44d3-a47f-845c28e448fe)

# 環境構築
## 1 Gitファイルをクローンする

git clone https://github.com/shoyama1010/fruit-furima.git

## 2 Dockerコンテナを作成する

docker-compose up -d --build

## 3 Laravelパッケージをインストールする

docker-compose exec php bash
でPHPコンテナにログインし

composer install

## 4 .envファイルを作成する

PHPコンテナにログインした状態で

cp .env.example .env

作成した.envファイルの該当欄を下記のように変更

DB_HOST=mysql

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp

MAIL_HOST=mailhog

MAIL_PORT=1025

MAIL_USERNAME=null

MAIL_PASSWORD=null

MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS=noreply@example.com 

MAIL_FROM_NAME="laravel"

## 5 テーブルの作成

docker-compose exec php bash

上記コマンドにて、PHPコンテナにログインし

php artisan migrate

## 6 ダミーデータ作成

WeightLogモデルとWeightTargetモデルにuse HasFactoryを設定

PHPコンテナにログインした状態で、ファクトリの作成

作成したWeightLogFactoryとWeightTargetFactory：fakerメソッドを使用して、登録設定

ファクトリのシーダーへの設定：WeightLogSeederに３５件を登録

DatabaseSeederにシーダーを設定して、最後に「php artisan db:seed」

## 7 アプリケーション起動キーの作成

PHPコンテナにログインした状態で

php artisan key:generate
