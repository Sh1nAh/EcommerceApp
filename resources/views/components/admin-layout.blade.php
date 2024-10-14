<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-commerce App</title>

        <!-- font awsome cdn link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <!-- custom css file link -->
        <link rel="stylesheet" href="css/styles.css">

        <!-- title icon link -->
        <link rel="shortcut icon" href="images/home/title-icon.svg">
    </head>
    <body>
        <header>
            <a href="/admin" class="logo">admin<span>.</span></a>
            <nav class="navbar1">
                <a href="/admin">Dashboard</a>
                <a href="/admin/products">Products</a>
                <a href="/admin/orders">Orders</a>
            </nav>
            <div class="icons">
                <form action="/logout" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <span class="fas fa-sign-out-alt logout-user"></span>
                    </button>
                </form>
            </div>
        </header>
        <div class="container">
            <div class="col2">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>