# weight-control(体重管理アプリ)

## アプリ概要
Weight Control は、日々の体重や摂取カロリー、運動内容を記録・管理できる laravel(バックエンドのみ)の体重管理アプリケーションです。

ユーザーは目標体重を設定し、日々の記録を一覧で確認しながら健康管理を行えます。

また、CSV エクスポート機能やレポート機能により、自身の記録を分析することも可能です。

## 作成した目的
- Laravelの模擬案件から、各機能要件を習得しており、応用機能として、今回CSV出力機能とレポート機能を取り組みでおります。
- 以前から自分自身の「体重の増加」が気になっており、運動効果がどういう感じで現れるかを確認したかったので、ぜひアプリとして開発したかったです。
- 将来的に、フロントエンドとAPI連携でのSPA開発予定にて、「独自の健康アプリ」としても、新規開発して実装していきたいと思います。

<img width="1293" height="679" alt="スクリーンショット (4982)" src="https://github.com/user-attachments/assets/d40c0db8-50b7-4247-bfce-c8e523cef295" />

<img width="1358" height="597" alt="Image" src="https://github.com/user-attachments/assets/67be76ae-4c6f-4dbe-9862-e9b28fae60ca" />

<img width="1350" height="604" alt="Image" src="https://github.com/user-attachments/assets/4f9b9e0f-6f17-429d-8e27-0d5bfeebfb87" />

<img width="1320" height="674" alt="Image" src="https://github.com/user-attachments/assets/874e463d-1cea-46b3-8e07-9fe6ade9f6b5" />


# アプリケーションURL
ローカル環境
http://localhost

# 機能一覧
・認証機能

・検索機能

・初期体重・目標体重登録

・目標体重の変更

・体重ログ一覧表示

・モーダルによる体重ログ登録

・CRUD機能

・CSVエクスポート機能

・レポート機能

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

# テスト

## テスト環境
本プロジェクトでは PHPUnit を利用した Feature テストを実装しています。
テスト実行時は .env.testing および demo_test データベースを使用しています。

## テスト実行コマンド
### 特定のテストを実行
php artisan test --env=testing --filter=WeightLogIndexTest

php artisan test --env=testing --filter=WeightLogStoreTest

php artisan test --env=testing --filter=WeightLogValidationTest

php artisan test --env=testing --filter=WeightLogUpdateTest

また、すべてのテストを実行する場合は以下のコマンドを使用します。

php artisan test --env=testing

## 実装済みテスト&結果

テスト名 ------------------------------ 内容 --------------------------------------------------  結果

WeightLogIndexTest	-- ログイン済みユーザーが体重一覧画面を表示できることを確認	---- ✅ PASS

WeightLogStoreTest	----- 体重ログを正常に登録できることを確認	---------------------- ✅ PASS

WeightLogValidationTest	- 必須項目未入力時にバリデーションエラーとなることを確認	-- ✅ PASS

WeightLogUpdateTest	 -- 既存の体重ログを正常に更新できることを確認	---------------- ✅ PASS

# 工夫した点

- JavaScript を利用したモーダル画面による体重ログ登録
- FormRequest を利用した入力バリデーション
- 日付範囲による検索機能
- CSV エクスポート機能を追加し、データの活用を容易にした
- 平均値や最大・最小値、月別平均を表示するレポート機能を実装
- Feature テストを作成し、一覧表示・登録・バリデーション・更新処理の動作を検証

# 苦労した点
## モーダル画面の実装
- 体重ログ登録画面をモーダル形式で実装する際、Laravelのルーティングと連携しながら一覧画面上で表示する必要がありました。
- CSSのみの実装では要件を満たせなかったため、JavaScriptを利用してURL状態を判定し、モーダル表示を制御する形で実装しました。

## バリデーションと更新処理の整合性
-体重ログ更新機能では、入力値を変更してもデータが更新されない問題や、運動時間の入力形式によるバリデーションエラーが発生しました。
- FormRequestによるバリデーションとControllerの更新処理を見直し、データの整合性を保てるよう改善しました。

## CSV出力・レポート機能の実装
- CRUD機能だけでなく実務を意識し、CSVエクスポート機能とレポート機能を追加しました。
- 。特に月別平均レポートでは、SQLの集計処理（AVG・COUNT・GROUP BY）を利用してデータ分析機能を実装し、業務システムに近い構成を意識しました。

# 今後の改善点
- UI画面改善のため、ReactもしくはＮext.jsにて、SPA開発予定。
- Chart.jsによるグラフを用いた解析を行う（最優先）
