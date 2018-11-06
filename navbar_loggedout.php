<? session_start();
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<html>
<head>
    <style>
        body {font-family: Times New Roman, Georgia, Serif, Serif;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }




        .topnav .search-container {
            float: left;
        }

        .topnav input[type=text] {

            padding: 4px;
            margin-top: 3px;
            font-size: 15px;
            border: none;
        }

        .topnav .search-container button {
            float: right;
            padding: 7.7px 10px;
            margin-top: 3px;
            margin-right: 16px;
            background: #d1d1d1;
            font-size: 15px;
            border: none;
            cursor: pointer;
        }

        .topnav .search-container button:hover {
            background: #ccc;
        }

        @media screen and (max-width: 600px) {
            .topnav .search-container {
                float: none;
            }
            .topnav a, .topnav input[type=text], .topnav .search-container button {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                margin: 0;
                padding: 14px;
            }
            .topnav input[type=text] {
                border: 1px solid #ccc;
            }
        }


    </style>
</head>


<!------------------------------------------------>


<div class="w3-bar w3-wight w3-top topnav w3-white" style="letter-spacing:4px; border-bottom: 1px solid black;">
    <a href="../" class="w3-bar-item w3-button">Home</a>

    <div class="search-container">
    <form action="includes/search.php" >
    <input type="text" class="w3-bar-item"  placeholder="Search..." name="search" style="border-radius: 5px 0 0 5px;  border-bottom: 1px solid #9c9c9c;">
        <button type="submit" style="border-radius: 0 5px 5px 0; border-bottom: 1px solid #9c9c9c;"><i class="fa fa-search" ></i></button>
    </form>
    </div>

    <a href="#" class="w3-bar-item w3-button w3-right" id="loginbtn">Login</a>
    <a href="#" class="w3-bar-item w3-button w3-right" id="createbtn">Create an account</a>

</div>
<br><br>

<!-- Login -->
<!-- The Modal -->
<div id="loginmodal" class="modal">

    <!-- Modal content -->
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
    // Get the modal
    const loginmodal = document.getElementById("loginmodal");

    // Get the button that opens the modal
    const loginbtn = document.getElementById("loginbtn");

    // Get the <span> element that closes the modal
    const loginspan = document.getElementsByClassName("closelogin")[0];

    // open the modal
    loginbtn.onclick = function() {
        <?php $_SESSION['loginmessage'] = NULL ?>
        loginmodal.style.display = "block";
    }

    // When the user clicks on(x), close the modal
    loginspan.onclick = function() {
        loginmodal.style.display = "none";

    };

    // When the user clicks outside, close it
    window.onclick = function(event) {
        if (event.target === loginmodal) {
            loginmodal.style.display = "none";

        }
        if (event.target === createmodal) {
            createmodal.style.display = "none";
        }
    }

    if(window.location.href.indexOf('#login') !== -1) {
        loginmodal.style.display = "block";
    }


</script>

<!------------------------------------------------>

<!-- create an account -->



<!-- The Modal -->
<div id="createmodal" class="modal">

    <!-- Modal content -->
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
    // Get the modal
    const createmodal = document.getElementById("createmodal");

    // Get the button that opens the modal
    const createbtn = document.getElementById("createbtn");

    // Get the <span> element that closes the modal
    const createspan = document.getElementsByClassName("closecreate")[0];

    // When the user clicks the button, open the modal
    createbtn.onclick = function() {
        createmodal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    createspan.onclick = function() {
        createmodal.style.display = "none";
    }

    if(window.location.href.indexOf('#createerror') !== -1) {
        createmodal.style.display = "block";
    }


</script>
</html>


