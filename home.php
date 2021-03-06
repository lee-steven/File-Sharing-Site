<!DOCTYPE html>
<head>
    <link rel="icon" href="LogoIcon.png" type="image/png" sizes="20x20">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" type = "text/css" href = "CSS/stylesheet2.css" />
    <link href="https://fonts.googleapis.com/css?family=Heebo:300" rel="stylesheet">
    <link rel="icon" href="LogoIcon.png" type="image/png" sizes="20x20">
</head>
<body>
    <?php
        session_start();

        $username= $_SESSION['login_user'];
        if (isset( $_SESSION['login_user'])){
            // Grab user data from the database using the user_id
            // Let them access the "logged in only" pages

        } else {
            // Redirect them to the login page
            header("Location: login.php");
            exit();
        }


    ?>
    <section class="sidebar-home">
        <nav>
            <img src="Logo2.png" class="logo" alt="File Air Logo">
            
            <h3>Welcome, <?php echo trim($username) ?>!</h3>
            <div class="logButton">
                <form action="buff-logout.php" method="post">
                    <input type="submit" value="Logout">
                </form>
            </div>
            <div class="side-nav">
                <a href="home.php">Home</a>
                <a href="starredList.php">Starred</a>
            </div>
        </nav>
    </section>

    <section class="info-home">
                
        <h3>Home</h3>
        <h6>Files</h6><hr>
        <main>
            <?php
                $path   = sprintf("/home/stevenlee/Module2Info/uploads/%s", $username);
                $files = array_diff(scandir($path), array('.', '..'));

                foreach ($files as $file){
                    //To prevent star.txt file from showing up on list
                    if($file != "star.txt"){
                        $pathFile  = sprintf("/home/stevenlee/Module2Info/uploads/%s/%s", $username, $file);
                        
                        echo '<form name="star" action="starred.php" method="POST">';
                            echo '<button type="submit" class="star" name = "star" value="'.$file.'">&#9733</button>';
                        echo '</form>';

                        echo trim($file);


                        echo '<span class="align-button"><form name="delete" action="deleted.php" method="POST">';
                            echo '<button type="submit" name = "deleteButton" value="'.$file.'">delete.</button>';
                        echo '</form></span>';

                        echo'<span class="align-button"><form name="share" action="share.php" method="POST">';
                            echo '<button type="submit" name="shareButton" value="'.$file.'">share.</button>';
                        echo '</form></span>';

                        echo '<span class="align-button"><form name="view" action="view.php" method="POST">';
                            echo '<button type="submit" name="viewButton" value="'.$file.'">view.</button>';
                        echo '</form></span>';

                        echo '</br>';
                        echo '</br>';
                        echo '<hr>';
                    }
                }
            ?>
        </main>
    </section>

    <section class="home-upload">
        <form enctype="multipart/form-data" action="upload.php" method="POST">
            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                <label for="uploadfile_input">Choose a file to upload:</label>
                <input name="uploadedfile" type="file" id="uploadfile_input"/>
            </p>
            <p>
                <input type="submit" value="Upload File" />
            </p>
        </form>
    </section>
    
</body>
</html>