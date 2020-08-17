<? session_start(); ?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<html>
<head>
    <style>
        body {font-family: Times New Roman, Georgia, Serif, Serif;}

        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #ffffff;
            margin: auto;
            padding: 20px;
            width: 80%;
        }

        .topnav .search {
            float: left;
        }

        .topnav input[type=text] {

            padding: 4px;
            margin-top: 3px;
        }

        .topnav .search button {
            float: right;
            padding:  7.7px;
            margin-top: 3px;
            margin-right: 16px;
            background: #dddddd;
            font-size: 15px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<div class="w3-bar w3-wight w3-top w3-white topnav" style="letter-spacing:4px; border-bottom: 1px solid black;">
    <a href="../" class="w3-bar-item w3-button">Home</a>

    <div class="search">
    <form action="includes/search.php" >
    <input type="text" class="w3-bar-item"  placeholder="Search..." name="search" style="border-radius: 5px 0 0 5px;  border-bottom: 1px solid #9c9c9c;">
        <button type="submit" style="border-radius: 0 5px 5px 0; border-bottom: 1px solid #9c9c9c;"><i class="fa fa-search" ></i></button>
    </form>
    </div>

    <a href="#" class="w3-bar-item w3-button w3-right" id="loginbtn">Login</a>
    <a href="#" class="w3-bar-item w3-button w3-right" id="createbtn">Create an account</a>

</div>
<br><br>

<div id="loginmodal" class="modal">

    <div class="modal-content">
        <span id="closelogin" class="closelogin">&times;</span>
        <br>
        <div class="container">

            <form class="form" action="includes/login.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <br>
            <header style="letter-spacing: 4px;" class="w3-select w3-center"> Login</header>
            <br>
            <label style="letter-spacing: 2px; text-align: center;" id="loginerror" class = "w3-text-red"><? echo $_SESSION['loginmessage'] ?> </label>
            <br>
            <label for="email" class="w3-wide w3-left" style="letter-spacing: 2px;">Email</label>
            <input class="w3-select" type="text" placeholder="Enter Email" name="email" required><br>
            <label for="password" class="w3-wide w3-left" style="letter-spacing: 2px;">Password</label>
            <input class="w3-select" type="password" placeholder="Enter Password" name="password" required>
            <br><br>
            <input type="submit" value="Login" name="login" class="w3-btn w3-light-grey w3-animate-opacity">

            </form>
        </div>
    </div>
</div>

<script>
    const loginmodal = document.getElementById("loginmodal");
    const loginbtn = document.getElementById("loginbtn");
    const loginspan = document.getElementsByClassName("closelogin")[0];

    loginbtn.onclick = function() {
        <?php $_SESSION['loginmessage'] = '' ; ?>
        loginmodal.style.display = "block";
    };

    loginspan.onclick = function() {
        loginmodal.style.display = "none";

    };

    window.onclick = function(event) {
        if (event.target === loginmodal) {
            loginmodal.style.display = "none";
        }
        if (event.target === createmodal) {
            createmodal.style.display = "none";
        }
    };

    if(window.location.href.indexOf('#login') !== -1) {
        loginmodal.style.display = "block";
    }
</script>

<!-- create an account -->
<div id="createmodal" class="modal">

    <div class="modal-content">
        <span id="closecreate" class="closecreate">&times;</span>
        <br>
        <div class="container">

            <header style="letter-spacing: 5px;" class="w3-select w3-center"> Create an account</header>
            <br>

            <form class="form" action="includes/create_user.php" method="post" enctype="multipart/form-data" autocomplete="off">

                <label style="letter-spacing: 2px; text-align: center;" class = "w3-text-red"><? echo $_SESSION['createmessage'] ?> </label>
                <br>
                <label for="email" class="w3-wide w3-left" style="letter-spacing: 2px;">Email</label>
                <input class="w3-select" type="text" placeholder="Enter Email" name="email" required><br>
                <label for="username" class="w3-wide w3-left" style="letter-spacing: 2px;">Username</label><br>
                <label class="w3-tiny" style="letter-spacing: 2px;">Spaces in your username will be replaced with underscores</label>
                <input class="w3-select" type="text" placeholder="Enter Username" name="username" required><br>
                <label for="psw" class="w3-wide w3-left" style="letter-spacing: 2px;">Password</label>
                <input class="w3-select" type="password" placeholder="Enter Password" name="password" required>
                <label for="psw" class="w3-wide w3-left" style="letter-spacing: 2px;">Confirm password</label>
                <input class="w3-select" type="password" placeholder="Enter Password" name="confirm_password" required>
                <br><br>
                <input type="submit" value="Create account" name="register" class="w3-btn w3-light-grey w3-animate-opacity">

            </form>
        </div>
    </div>

</div>

<script>
    const createmodal = document.getElementById("createmodal");
    const createbtn = document.getElementById("createbtn");
    const createspan = document.getElementsByClassName("closecreate")[0];

    createbtn.onclick = function() {
        createmodal.style.display = "block";
    };

    createspan.onclick = function() {
        createmodal.style.display = "none";
    };

    if(window.location.href.indexOf('#createerror') !== -1) {
        createmodal.style.display = "block";
    }

</script>
</html>


