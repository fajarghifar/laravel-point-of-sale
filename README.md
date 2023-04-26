## ✨ Laravel Point of Sale

Point of Sale Management and Invoice build with Laravel 10 and MySql.

![Dashboard](https://user-images.githubusercontent.com/71541409/234483153-38816efd-c261-4585-bb93-28639508f5e3.jpg)

## 😎 Features
- POS
- Orders
  - Pending Orders
  - Complete Orders
  - Pending Due
- Stock Management
- Products
  - Products
  - Categories
- Employees
- Customers
- Suppliers
- Salary
  - Advance Salary
  - Pay Salary
  - History Pay Salary
- Attendence
- Role and Permission
- Users Management
- Backup Database

## 🚀 How to Use

1.  **Clone Repository or Download**

    ```bash
    $ git clone https://github.com/fajarghifar/laravel-point-of-sale
    ```
1. **Setup**
    ```bash
    # Go into the repository
    $ cd laravel-point-of-sale

    # Install dependencies
    $ composer install

    # Open with your text editor
    $ code .
    ```
1. **Config File**

    Rename or copy `.env.example` file to `.env`
    ```bash
    # Generate app key
    $ php artisan key:generate
    ```

    Additional setting to set Faker Locale, add this line of code to the `.env` file.
    ```bash
    # In this case the locale set to Indonesia

    FAKER_LOCALE="id_ID"
    ```

    Setup your database credentials in your `.env` file.
    ```bash
    $ php artisan:migrate:fresh --seed

    # Note: If showing an error, please try to run this command again.
    ```
1. **Create Storage Link**

    ```bash
    $ php artisan storage:link
    ```
1. **Run Server**

    ```bash
    $ php artisan serve
    ```
1. **Login**

    Try login with username : `admin` and password : `password`

    or username : `user` and password : `password`

## 📸 Screenshot

#### POS
![pos](https://user-images.githubusercontent.com/71541409/234483450-92e3d8fd-c729-4709-bdd3-9bec2b4cf909.jpg)
#### Products
![products](https://user-images.githubusercontent.com/71541409/234483453-c3e355f0-c7a3-441d-88ae-f1d983e5b267.jpg)
#### Employees
![employees](https://user-images.githubusercontent.com/71541409/234483444-87097f5d-ae41-407a-b9b0-cd0724c83edb.jpg)
#### Suppliers
![suppliers](https://user-images.githubusercontent.com/71541409/234483408-a66f3a86-ba05-404f-8819-b6760807486d.jpg)
#### Customers
![customers](https://user-images.githubusercontent.com/71541409/234483436-0ddbe384-2755-4ba5-a8ae-617eb2527fd9.jpg)
#### Salary
![salary](https://user-images.githubusercontent.com/71541409/234483463-650ca4d7-76a7-44f1-8c56-5d3be651476f.jpg)
#### Backup Database
![database](https://user-images.githubusercontent.com/71541409/234483441-ea356666-5f19-4f62-8b6d-dc5e06bbbf8e.jpg)
#### Role and Permission
![roles](https://user-images.githubusercontent.com/71541409/234483460-604b6e7d-2213-464e-98bb-4820c1791b82.jpg)
![permissions](https://user-images.githubusercontent.com/71541409/234483445-9c6f3447-704d-4fbf-b046-23aaa91166d4.jpg)
![role_in_permission](https://user-images.githubusercontent.com/71541409/234483454-69610edb-b996-4850-a826-3a1745da2cf9.jpg)


## 📝 Contributing

If you have any idea to make it more interesting, feel free to send a PR, or create an issue for a feature request.

# 🤝 License

### [MIT](LICENSE)

> Github [@fajarghifar](https://github.com/fajarghifar) &nbsp;&middot;&nbsp;
> Instagram [@fajarghifar](https://instagram.com/fajarghifar)
