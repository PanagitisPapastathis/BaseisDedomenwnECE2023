

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>School Library</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
    body {
        background-image: url('path_to_your_background_image');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .navbar {
        background-color: #007bff;
    }

    .navbar-brand, .nav-link, .navbar-text {
        color: #ffffff !important;
    }

    #logo-container {
        text-align: center;
        margin-top: 10%;
    }

    footer {
        background-color: #007bff;
        position: fixed;
        bottom: 0;
        width: 100%;
        color: white;
        text-align: center;
        padding: 10px 0;
    }
</style>

</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">School Library</a>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./central_admin/sign_up.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div id="logo-container">
        <img src="path_to_your_logo" alt="Library Logo">
    </div>

    <footer>
        <p>Somoene says hello &copy; 2023</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
