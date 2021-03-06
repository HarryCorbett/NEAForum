<head>
    <style>
        body {
            font-family: Times New Roman, Georgia, Serif, Serif;
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
            background: #dcdcdc;
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

<body style="padding-top: 50px;"></body>
<div class="w3-bar w3-white w3-top topnav w3-white"
     style="position: fixed; letter-spacing:4px; border-bottom: 1px solid black;">

    <a href="../" class="w3-bar-item w3-button">Home</a>
    <a href="createpost.php" class="w3-bar-item w3-button">Create Post</a>

    <div class="search-container">
        <form action="includes/search.php">
            <input type="text" class="w3-bar-item" placeholder="Search..." name="search"
                   style="border-radius: 5px 0 0 5px;  border-bottom: 1px solid #9c9c9c;">
            <button type="submit" style="border-radius: 0 5px 5px 0; border-bottom: 1px solid #9c9c9c;"><i
                        class="fa fa-search"></i></button>
        </form>
    </div>

    <a href="/includes/Logout.php" class="w3-bar-item w3-button w3-right" id="logoutbtn">Logout</a>
    <a href="accountpage.php" class="w3-bar-item w3-button w3-right" id="logoutbtn">Account</a>
</div>
