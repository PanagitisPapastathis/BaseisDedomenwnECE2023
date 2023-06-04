<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Databases PHP Demo
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>


<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Student page</a>
            <a id="navbar-items" href="../index.php"> 
                <i class="fa fa-home "></i> Log Out
            </a>
        </div>
    </nav>

    <div class="container" id="row-container">
        <div class="row" id="row">
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">View Student_profile</h4>
                        <p class="card-text" id="paragraph">Personal Information</p>
                        <a class="btn btn-primary" id="show-btn" href="./Student_profile.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">View Books</h4>
                        <p class="card-text" id="paragraph">Explore your School Library, make a reservation, or lend a book.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="../Books/books.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Books Lended</h4>
                        <p class="card-text" id="paragraph">See all the books you have lend since today.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./lended_so_far.php">Show</a>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">View Review</h4>
                        <p class="card-text" id="paragraph">See all the reviews you have made since today.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./Student_reviews.php">Show</a>
                    </div>
                </div>
            </div>
        </div>
</div>
    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>