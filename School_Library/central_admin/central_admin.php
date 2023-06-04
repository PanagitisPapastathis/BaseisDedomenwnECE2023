<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        Main Menu
    </title>
    <link rel = "stylesheet" href = "../css/styles.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel = "stylesheet" href = "../bootstrap/css/bootstrap.min.css">
    

</head>


<body>
    <nav class="navbar navbar-light navbar-expand-md" id="nav-bar">
        <div id="navbar-div" class="container-fluid">
            <a class="navbar-brand" id="nav-bar-text">School Library - Central Admin Page</a>
            <a id="navbar-items" href="home.php"> 
                <i class="fa fa-home "></i> Home
            </a>
        </div>
    </nav>

    <div class="container" id="row-container">
        <div class="row" id="row">
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">View Yout profile</h4>
                        <p class="card-text" id="paragraph">Personal Information</p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_profile.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">View Schools</h4>
                        <p class="card-text" id="paragraph">View specific information for each school participating in the system<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_view_schools.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Promotion Requests</h4>
                        <p class="card-text" id="paragraph">View which user has asked to become administrator in his/her school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_promotion_requests.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Backup</h4>
                        <p class="card-text" id="paragraph">This should backup the whole database somehow.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_backup.php">Backup</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.1 by year</h4>
                        <p class="card-text" id="paragraph">This is returns a table of the lendings per school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.1_by_year.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.1 by month</h4>
                        <p class="card-text" id="paragraph">This is returns a table of the lendings per school.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.1_by_month.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.2 </h4>
                        <p class="card-text" id="paragraph">This leads you to a page where by selecting a book subject you can see all the authors associated with this subject and all the teachers who have borrowed books of this particular subject.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.2.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.3 </h4>
                        <p class="card-text" id="paragraph">This leads you to a page showing by descending order all the young teachers (younger than 40) who have borrowed at least a book.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.3.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.4 </h4>
                        <p class="card-text" id="paragraph">This leads you to a page showing the authors whose books have never been lended.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.4.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.5 </h4>
                        <p class="card-text" id="paragraph">Mplamplampa.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.5.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.6 </h4>
                        <p class="card-text" id="paragraph">This leads you to a page showing by descending order the three most popular binary subject relationships among book subjects.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.6.php">Show</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">3.1.7 </h4>
                        <p class="card-text" id="paragraph">This leads you to a page showing all the authors who have at maximum less than five bookw from the author with the most books.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="./central_admin_3.1.7.php">Show</a>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-4">
                <div class="card" id="card-container-layout">
                    <div class="card-body" id="card">
                        <h4 class="card-title">Restore</h4>
                        <p class="card-text" id="paragraph">This should restore the whole database from the backup file somehow.<br></p>
                        <a class="btn btn-primary" id="show-btn" href="lended_so_far.php">Restore</a>
                    </div>
                </div>
            </div>-->
        </div>
    </div>

    <script src = "{{ url_for('static', filename = '../bootstrap/js/bootstrap.min.js') }}"></script>
    
</body>

</html>