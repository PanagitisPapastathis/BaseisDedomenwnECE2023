<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Databases PHP Demo
    </title>
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
    

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Administrator page</a>
            <a id="navbar-items" href="index.php"> 
                <i class="fa fa-home "></i>Log Out
            </a>
            <br><br>
        </div>
    </nav>

    <div class="container" id="row-container">
        <div class="row" id="row">
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">School-Administrator Profile</h4>
                        <p class="card-text" id="paragraph">Personal Information</p>
                        <a class="btn btn-primary" id="show-btn" href="./Admin_profile.php">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Lendings</h4>
                        <p class="card-text" id="paragraph">View all active book lendings.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./lendings.php">View</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Bookings</h4>
                        <p class="card-text" id="paragraph">View all bookings that are pending.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./bookings.php">View</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Archive</h4>
                        <p class="card-text" id="paragraph">View all lendings that are no longer active.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./archived_lendings.php">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Account Requests</h4>
                        <p class="card-text" id="paragraph">View all requests for new accounts in your school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./account_requests.php">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Book Reviews</h4>
                        <p class="card-text" id="paragraph">View all submissions for reviews made by students in your school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./admin_reviews.php">View</a>
                        <p class="card-text" id="paragraph">View all accepted reviews made by students in your school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./admin_accepted_reviews.php">View</a>
                        <p class="card-text" id="paragraph">View all removed reviews made by students in your school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./admin_removed_reviews.php">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Testing...</h4>
                        <p class="card-text" id="paragraph">Try submitting a review on some random book.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./review.php?isbn='9781234567890'">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src = "{{ url_for('static', filename = 'bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>