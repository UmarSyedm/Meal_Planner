<!DOCTYPE html>
<html>

<head>
    <title>Browse Food Page</title>
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
            <a class="active" href="BrowseFood.php"><i class="bi-layout-text-sidebar-reverse"></i> Browse Food</a>
            <a href="MealPlans.php"><i class="bi-egg-fried"></i> Meal Plans</a>
            <a href="SnackPlans.php"><i class="bi-cup-straw"></i> Snack Plans</a>
            <a href="Profile.php" class="split"><i class="bi-person-lines-fill"></i> Profile</a>
            <?php
            if ($_SESSION['user_name'] == 'Guest') {
                echo "<a href='SignUp.php' class='split'><i class='bi-person-plus'></i> SignUp</a>";
                echo "<a href='Login.php' class='split'><i class='bi-lock'></i> Login</a>";
            }
            ?>
        </nav>
    </div>

    <div class="main" style="padding-left:16px">
        <h2>Browse Food Page</h2>

        <?php

        $db = new SQLite3('database/SMP.db');

        $query = "SELECT * FROM FOODS";
        $result = $db->query($query);
        // $db->close();
        ?>

        <!-- <section> -->
        <h2>Foods Info</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Calories</th>
                <th>Cost for 1</th>
                <th>Cost for 2-5</th>
                <th>Cost for 6-10</th>
                <th>Cost for 11-20</th>
                <th>Cost for 21-30</th>
                <th>Cost for 30+</th>
                <th>High in Nutrient</th>
                <th>Meal Type</th>
                <th>Image</th>
            </tr>
            <?php

            while ($rows = $result->fetchArray()) {
                ?>
                <td>
                    <b><b>
                            <?php echo $rows['TITLE']; ?>
                        </b></b>
                </td>
                <td>
                    <?php echo $rows['CALORIES']; ?>
                </td>
                <td>
                    <?php echo $rows['COST1']; ?>
                </td>
                <td>
                    <?php echo $rows['COST2_5']; ?>
                </td>
                <td>
                    <?php echo $rows['COST6_10']; ?>
                </td>
                <td>
                    <?php echo $rows['COST11_20']; ?>
                </td>
                <td>
                    <?php echo $rows['COST21_30']; ?>
                </td>
                <td>
                    <?php echo $rows['COST30PLUS']; ?>
                </td>
                <td>
                    <?php echo $rows['NUTRIENT']; ?>
                </td>
                <td>
                    <?php echo $rows['MEAL_TYPE']; ?>
                </td>
                <td>
                    <?php
                    echo '<img style="border-radius:8px;" width="100" height="90" src="data:image/jpeg;base64,' . base64_encode($rows['IMAGE']) . '"/>';
                    ?>
                </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <br><br><br><br>
    </div>
</body>

</html>