# weight-control

# 作成した目的


# アプリケーションURL
ローカル環境
http://localhost

# 機能一覧

# 使用技術
・Laravel 8

・nginx 1.21.1

・php 7.4.9

・html

・css

・mysql 8.0.26


# テーブル設計


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

ファクトリの作成：fakerメソッドを使用して、３５件のランダムデータを作成する

ファクトリのシーダーへの設定：WeightLogSeederに登録

DatabaseSeederにシーダーを設定して、PHPコンテナにログインした状態で

php artisan db:seed

## 7 アプリケーション起動キーの作成

PHPコンテナにログインした状態で

php artisan key:generate
