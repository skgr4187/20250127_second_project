# coachtechフリマ

## 環境構築
### Dockerビルド
1. git@github.com:skgr4187/second_project_kojima.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build

### Laravel環境構築
1. docker-compose exec php bash
2. composer-install
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加  
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass  
5. アプリケーションキーの作成  
php artisan key:generate
6. マイグレーションの実行  
php artisan migrate
7. シーディングの実行  
php artisan db:seed

## 使用技術
- Laravel 8.83.29
- php 7.4.9
- MySQL 15.1

## ER図


## URL
- 開発環境  
[http://localhost/](http://localhost/)  
- phpMyAdmin  
[http://localhost:8080/](http://localhost:8080/)# 0127_second_project
# second_project_0127
# kojima_20250127_second_project
# 20250127_second_project
