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
- Attendance
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
1. **.ENV**

    Rename or copy the `.env.example` file to `.env`
    ```bash
    # Generate app key
    $ php artisan key:generate
    ```
1. **Custom Faker Locale**

    To set Faker Locale, add this line of code to the end `.env` file.
    ```bash
    # In this case, the locale is set to Indonesian

    FAKER_LOCALE="id_ID"
    ```

1. **Setup Database**

    Setup your database credentials in your `.env` file.

1. **Seed Database**
    ```bash
    $ php artisan:migrate:fresh --seed

    # Note: If showing an error, please try to rerun this command.
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

    Try login with username: `admin` and password: `password`

## 🚀 Config
1. **Config Chart**

    Open file `./config/cart.php`. You can set a tax, format number, etc.
    > For More details, visit this link [hardevine/shoppingcart](https://packagist.org/packages/hardevine/shoppingcart).
1. **Create Storage Link**

    ```bash
    $ php artisan storage:link
    ```
1. **Run Server**

    ```bash
    $ php artisan serve
    ```
1. **Login**

    Try login with username: `admin` and password: `password`

    or username: `user` and password: `password`

## 📝 Contributing

If you have any ideas to make it more interesting, please send a PR, or create an issue for a feature request.

# 🤝 License

### [MIT](LICENSE)

> Github [@fajarghifar](https://github.com/fajarghifar) &nbsp;&middot;&nbsp;
> Instagram [@fajarghifar](https://instagram.com/fajarghifar)
