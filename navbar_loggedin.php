
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

<body style="padding-top: 50px;"></body>

<div class="w3-bar w3-light-grey w3-top" style="position: fixed; letter-spacing:4px;">

    <a href="#" class="w3-bar-item w3-button">Home</a>
    <a href="#" class="w3-bar-item w3-button">Create Post</a>
    <a href="/includes/Logout.php" class="w3-bar-item w3-button w3-right" id="logoutbtn">Logout</a>
</div>
</body>