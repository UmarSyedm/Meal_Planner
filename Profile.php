<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/MP-NAV.css">
    <style>
        body {
            background-image: url('Images/wp-1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
            width: 90%
        }

        /*style="text-align: center;color: #006600;font-size: xx-large;font-family: 'Gill Sans', 'Gill Sans MT',' Calibri', 'Trebuchet MS', 'sans-serif';">*/

        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            /* background-color: #E4F5D4; */
            font-weight: lighter;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>

    <div class='header' style='background-color:<?php echo $_SESSION["themecolour"] ?>;'>
        <div class="row">
            <div class="col">
                <h1><a style="text-decoration:none;color:black;" href="index.php">Smart Meal Planner</a></h1>
            </div>
            <div class="col">
                <?php
                if (!isset($_SESSION['user_name'])) {
                    $_SESSION['user_name'] = 'Guest';
                }
                echo "<p style=\"text-align:right;\">Welcome,<br><b>" . $_SESSION['user_name'] . "</b></p>";
                ?>
            </div>
        </div>
    </div>

    <div class="topnav" style='background-color:<?php echo $_SESSION["themecolour"] ?>;'>
        <nav>
            <a href="index.php"><i class="bi-house-fill"></i> Home</a>
            <a href="HowitWorks.php"><i class="bi-tags"></i> How it Works</a>
            <a href="BrowseFood.php"><i class="bi-layout-text-sidebar-reverse"></i> Browse Food</a>
            <a href="MealPlans.php"><i class="bi-egg-fried"></i> Meal Plans</a>
            <a href="SnackPlans.php"><i class="bi-cup-straw"></i> Snack Plans</a>
            <a class="active1" href="Profile.php" class="split"><i class="bi-person-lines-fill"></i> Profile</a>
            <?php
            if ($_SESSION['user_name'] == 'Guest') {
                echo "<a href='SignUp.php' class='split'><i class='bi-person-plus'></i> SignUp</a>";
                echo "<a href='Login.php' class='split'><i class='bi-lock'></i> Login</a>";
            }
            ?>
        </nav>
        <?php
        if ($_SESSION['user_name'] == 'Guest') {
            header("location:Login.php");
        }
        ?>
    </div>

    <div class="main" style="padding-left:16px">
        <h2>Profile Page</h2>

        <form action="Profile.php" method="post">
            <div class="container" style="text-align:right;">

                <input class="btn btn-primary" type="submit" name="create" value="Logout">

            </div>
            <div>
                <?php
                if (isset($_POST['create'])) {
                    session_start();
                    if (isset($_SESSION['user_name'])) {
                        session_destroy();
                    }
                    echo "<script>location.href='index.php'</script>";
                }
                ?>
                <br>
            </div>
        </form>

        <div>
            <?php
            $db = new SQLite3('database/SMP.db');
            $username = $_SESSION['user_name'];

            $query = "SELECT * FROM ORDERS WHERE USER_NAME = '$username' AND DELIVERY_DATE > DATETIME()
                        AND PAYMENT_STATUS = 'PAID'
                        ORDER BY DELIVERY_DATE";
            $result = $db->query($query);
            ?>

            <h2 class="container">Upcoming Orders Info</h2>
            <br>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Meal Type</th>
                    <th>Order Date</th>
                    <th>Address</th>
                    <th>Delivery Date</th>
                    <th>Payment Status</th>
                </tr>
                <?php
                while ($rows = $result->fetchArray()) {
                    ?>
                    <td>
                        <?php echo $rows['TITLE']; ?>
                    </td>
                    <td>
                        <?php echo $rows['MEAL_TYPE']; ?>
                    </td>
                    <td>
                        <?php echo $rows['ORDER_DATE']; ?>
                    </td>
                    <td>
                        <?php echo $rows['ADDRESS']; ?>
                    </td>
                    <td>
                        <?php echo $rows['DELIVERY_DATE']; ?>
                    </td>
                    <td>
                        <?php echo $rows['PAYMENT_STATUS']; ?>
                    </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>

        <div>
            <?php
            $db = new SQLite3('database/SMP.db');
            $username = $_SESSION['user_name'];

            $query = "SELECT * FROM USER_INFO WHERE USER_NAME = '$username'";

            $result = $db->query($query);
            ?>
            
            <br><br><br>
            <h2 class="container">User Info</h2>
            <br>
            <table>
                <?php
                while ($rows = $result->fetchArray()) {
                    ?>
                    <tr>
                        <th style="width:30%">Username</th>
                        <td><?php echo $rows['USER_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><?php echo $rows['FIRST_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?php echo $rows['LAST_NAME']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $rows['EMAIL']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $rows['PHONE_NUMBER']; ?></td>
                    </tr>
                    <tr>
                        <th>Yeah of Birth</th>
                        <td><?php echo $rows['YOB']; ?></td>
                    </tr>
                    <tr>
                        <th>Height (in cm)</th>
                        <td><?php echo $rows['HEIGHT']; ?></td>
                    </tr>
                    <tr>
                        <th>Weight (in Kg)</th>
                        <td><?php echo $rows['WEIGHT']; ?></td>
                    </tr>
                    <tr>
                        <th>Meal Preference</th>
                        <td><?php echo $rows['MEAL_PREF']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $rows['ADDRESS']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>

        <div>

            <?php

            $db = new SQLite3('database/SMP.db');

            $query = "SELECT * FROM USER_INFO";
            $result = $db->query($query);
            // $db->close();
            ?>

            <br><br><br>
            <!-- <section> -->
            <h2 class="container">All Users Info</h2>
            <br>
            <table>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                <?php

                while ($rows = $result->fetchArray()) {
                    ?>
                    <td>
                        <?php echo $rows['USER_NAME']; ?>
                    </td>
                    <td>
                        <?php echo $rows['FIRST_NAME']; ?>
                    </td>
                    <td>
                        <?php echo $rows['LAST_NAME']; ?>
                    </td>
                    <td>
                        <?php echo $rows['EMAIL']; ?>
                    </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <br><br><br><br>
            <!-- </section> -->
        </div>
    </div>
</body>

</html>