## ✨ Laravel Point of Sale

A simple and powerful Point of Sale (POS) management system with invoice generation, built with **Laravel 10** and **MySQL**.

![Dashboard](https://user-images.githubusercontent.com/71541409/234483153-38816efd-c261-4585-bb93-28639508f5e3.jpg)

## 😎 Features

- **Point of Sale (POS)**
- **Order Management**
  - Pending Orders
  - Completed Orders
  - Pending Due Payments
- **Stock Management**
- **Product Management**
  - Products
  - Categories
- **Employee Management**
- **Customer Management**
- **Supplier Management**
- **Salary Management**
  - Advance Salary
  - Pay Salary
  - Salary History
- **Attendance Management**
- **Role & Permission System**
- **User Management**
- **Database Backup**

## 🚀 How to Use

#### 1. Clone the Repository
To get started, clone or download the repository:

```bash
git clone https://github.com/fajarghifar/laravel-point-of-sale
```

#### 2. Set Up the Project

Once you’ve cloned the repository, navigate to the project directory and install dependencies:

```bash
cd laravel-point-of-sale
composer install
```

Open the project in your preferred code editor:

```bash
code .
```

#### 3. Configure the Environment

Rename the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

#### 4. Set Faker Locale (Optional)

To set the Faker locale (for example, to Indonesian), add the following line at the end of your `.env` file:

```bash
FAKER_LOCALE="id_ID"
```

#### 5. Set Up the Database

Configure your database credentials in the `.env` file.

#### 6. Seed the Database

Run the following command to migrate and seed the database:

```bash
php artisan migrate:fresh --seed
```

**Note**: If you encounter any errors, try rerunning the command.

#### 7. Create Storage Link

Create a symbolic link for storage:

```bash
php artisan storage:link
```

#### 8. Start the Server

To run the application locally, start the Laravel development server:

```bash
php artisan serve
```

#### 9. Log In

Use the following credentials to log in:

- **Username**: `admin`
- **Password**: `password`

## 🚀 Configuration

#### 1. Configure Cart Settings

Open the `./config/cart.php` file to configure settings like tax rates, number formats, and more.

For more details, check out the [hardevine/shoppingcart documentation](https://packagist.org/packages/hardevine/shoppingcart).

#### 2. Storage Link

If you haven't already, run this command to create the storage link:

```bash
php artisan storage:link
```

#### 3. Start the Server

Run the development server:

```bash
php artisan serve
```

#### 4. Log In

Try logging in with:

- **Username**: `admin`
- **Password**: `password`

## 💡 Contributing

Have suggestions or want to contribute? Here’s how:

- Submit a **Pull Request (PR)**
- Report issues or request features by creating an **Issue**

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

> Connect with me on [GitHub](https://github.com/fajarghifar) &nbsp;&middot;&nbsp; [YouTube](https://www.youtube.com/@fajarghifar) &nbsp;&middot;&nbsp; [Instagram](https://instagram.com/fajarghifar) &nbsp;&middot;&nbsp; [LinkedIn](https://www.linkedin.com/in/fajarghifar/)
