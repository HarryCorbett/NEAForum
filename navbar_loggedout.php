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
    </style>
</head>


<!------------------------------------------------>


<div class="w3-bar w3-light-grey w3-top" style="letter-spacing:4px;">
    <a href="../" class="w3-bar-item w3-button">Home</a>
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

    // When the user clicks the button, open the modal
    loginbtn.onclick = function() {
        <?php $_SESSION['loginmessage'] = NULL ?>
        loginmodal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    loginspan.onclick = function() {
        loginmodal.style.display = "none";

    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === loginmodal) {
            loginmodal.style.display = "none";

        }
        if (event.target === createmodal) {
            createmodal.style.display = "none";
        }
    }

    if(window.location.href.indexOf('#loginerror') != -1) {
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

                <label for="username" class="w3-wide w3-left" style="letter-spacing: 2px;">Username</label>
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

    if(window.location.href.indexOf('#createerror') != -1) {
        createmodal.style.display = "block";
    }

</script>
</html>


