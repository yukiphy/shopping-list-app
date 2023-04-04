# 買い物帳アプリ

PHPフレームワークのLaravelを用いています。</br>
データベースにはMy SQLを使っています。</br>
Tailwind CSSを使ってレイアウトを作っています。</br>

## インストール

```
git clone https://github.com/yukiphy/shopping-list-app.git
```

## Composerをupdate

shopping-list-appディレクトリで以下のコマンドを実行

```
composer update
```

## データベースの設定

### .envファイルの作成

.env.exampleから.envを作成

```
cp .env.example .env
```

DB_USERNAME=root</br>
DB_PASSWORD=</br>
は、環境に合わせて変更して下さい

### migrate

migrationファイルからデータベースを作成

```
php artisan migrate
```

## Tailwind CSSを起動

### Tailwind CSSの設定

shopping-list-appディレクトリで以下のコマンドを実行
```
npm install -D tailwindcss postcss autoprefixer
```

### Tailwind CSSを起動

以下のコマンドを実行して下さい

```
npm run dev
```
実行中はコンソール画面を閉じないようにして下さい

## Artisan開発サーバーを起動する

shopping-list-appディレクトリで以下のコマンドを実行

```
php artisan key:generate
php artisan serve
```

http://127.0.0.1:8000/shopping_lists を開けば、買い物帳アプリが開けます