# ORDER API

## Langkah-langkah

1. Clone project ```https://github.com/brianrizqi/order-api.git```
2. Install vendor
   ```composer install```
3. Copy .env.example menjadi .env
4. Isi value .env
5. Jalankan `php artisan migrate --seed` & `php artisan key:generate`


## Credentials
```
email : johndoe@mailnesia.com
password : password

email : jenadoe@mailnesia.com
password : password
```
## API Reference

Api disini menggunakan JWT atau Bearer Token. Untuk tokennya digunakan di semua route kecuali login

#### Login

```http
  POST /api/auth/login
```

| Parameter  | Type     | Description    |
|:-----------|:---------|:---------------|
| `email`    | `string` | **Required**.  |
| `password` | `string` | **Required**.  |

#### Logout

```http
  POST /api/auth/logout
```

| Parameter     | Type     | Description    |
|:--------------|:---------|:---------------|
| `bearerToken` | `string` | **Required**.  |

#### Profile

```http
  GET /api/auth/profile
```

| Parameter     | Type     | Description    |
|:--------------|:---------|:---------------|
| `bearerToken` | `string` | **Required**.  |

#### Get Product

```http
  GET /api/v1/product
```

| Parameter     | Type     | Description    |
|:--------------|:---------|:---------------|
| `bearerToken` | `string` | **Required**.  |

#### Show Product

```http
  GET /api/v1/product/{slug}
```

| Parameter     | Type     | Description                |
|:--------------|:---------|:---------------------------|
| `bearerToken` | `string` | **Required**.              |
| `slug`        | `string` | **Required**. slug product |


#### Get Cart

```http
  GET /api/v1/cart
```

| Parameter     | Type     | Description                |
|:--------------|:---------|:---------------------------|
| `bearerToken` | `string` | **Required**.              |

#### Add to Cart

```http
  POST /api/v1/cart/add-to-cart
```

| Parameter     | Type      | Description                            |
|:--------------|:----------|:---------------------------------------|
| `bearerToken` | `string`  | **Required**.                          |
| `product`     | `string`  | **Required**. menggunakan slug product |
| `quantity`    | `integer` | **Required**.                          |

#### Delete Item

```http
  POST /api/v1/cart/delete-item
```

| Parameter     | Type      | Description                          |
|:--------------|:----------|:-------------------------------------|
| `bearerToken` | `string`  | **Required**.                        |
| `product_id`  | `integer` | **Required**. menggunakan product id |

#### Checkout

```http
  POST /api/v1/cart/checkout
```

| Parameter     | Type     | Description    |
|:--------------|:---------|:---------------|
| `bearerToken` | `string` | **Required**.  |
| `name`        | `string` | **Required**.  |
| `email`       | `string` | **Required**.  |
| `address`     | `string` | **Required**.  |

#### Get All Order

```http
  GET /api/v1/order
```

| Parameter     | Type     | Description    |
|:--------------|:---------|:---------------|
| `bearerToken` | `string` | **Required**.  |

#### Show Order by Invoice

```http
  GET /api/v1/order/{invoice}
```

| Parameter     | Type     | Description    |
|:--------------|:---------|:---------------|
| `bearerToken` | `string` | **Required**.  |
| `invoice`     | `string` | **Required**.  |
