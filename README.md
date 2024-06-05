# Laravel 11 勉強

## 前提となる環境

wsl の ubuntu24, apache2, php8.3 で開発。

### パッケージ導入

```bash
sudo apt install php
sudo apt install composer
sudo apt install mariadb-server
```

### mariadb で、データベースとユーザーを作り、権限を付与。

```bash
# mariadb (sqlサーバー)にログイン
sudo mysql -u root
```

```sql
-- hoge はユーザー名, fuga はパスワード
create user 'hoge'@'localhost' identified by 'fuga';

-- laravel というデータベースを作る。後述の .env では、データベースのデフォルト名は laravel になっている。なんでもよい。
create database laravel;

-- 上記データベース内の全テーブルに対する全権限を、上記のユーザーに与える。
grant all on laravel.* to hoge@localhost

--- ここで必須ではないが、よく使う
--- ユーザー一覧
select user,host from mysql.user;

--- 権限確認
show grants for usre@localhost;
```

### php モジュール

これまで要求されたことのあるモジュール。
エラーが出たら、その都度インストールするというのでもよい。

- php-mbstring
- php-mysql
- php-xml
- php-curl

```bash
# 導入済みモジュールの一覧
php -m
php --ini

# パッケージの調査
sudo apt show パッケージ名
sudo apt search 単語

# インストール。必要なものだけ。
sudo apt install php-mbstring php-mysql php-xml php-curl
```

---

## 導入

`v11_study` は何でもよい。

```bash
composer create-project laravel/laravel v11_study

# 作成後は package.json をもとに node_modules を作成
cd v11_study
npm i
```

## .env 編集

### 言語、タイムゾーン

次の記述を探す。なお、三行は連続してはいない。

```bash
APP_TIMEZONE=UTC
APP_LOCALE=en
APP_FAKER_LOCALE=en_US
```

値を下記のように変更

```bash
APP_TIMEZONE=Asia/Tokyo
APP_LOCALE=ja
APP_FAKER_LOCALE=ja_JP
```

### データベース接続

次の記述を探す

```bash
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

次の様に変更

```bash
DB_CONNECTION=mysql # 変更
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=データベース名 # create したデータベース名
DB_USERNAME=ユーザー名@localhost # 上記DBへの権限を与えたユーザー名
DB_PASSWORD=パスワード # 上記ユーザーのパスワード
```

migrate を実行し、データベースを Laravel の管理下に置く。

```bash
php artisan migrate
```

ここでエラーが出たときは、php モジュールが足りない、または、データベースの設定が正しくない、という原因があった。

---

## lang ディレクトリを出しておく。日本語化していくため。

```bash
php artisan lang:publish
```

---

## Breeze 導入

```bash
# インストーラのようなものをインストール
composer require laravel/breeze --dev

# インストール開始。選択肢はすべてデフォルト。
php artisan breeze:install

# インストール後の処置
php artisan migrate
npm i
```

### Breeze 日本語化

[参照](https://github.com/askdkc/breezejp)

README.md どおりに操作してみる。

### 動作確認

```bash
php artisan serve
```

その後、[localhost](http://localhost:8000/)をブラウザで開く。

