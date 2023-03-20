<!DOCTYPE html>
<html>

<head>
    <title>Meal Plans Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/MP-NAV.css">
    <link rel="stylesheet" href="MealPlans.css">
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
            <a class="active" href="MealPlans.php"><i class="bi-egg-fried"></i> Meal Plans</a>
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
    <div>
        <?php
        if ($_SESSION['user_name'] == 'Guest') {
            header("location:Login.php");
        }
        ?>
    </div>

    <?php
    $db = new SQLite3('database/SMP.db');
    ?>

    <div class="main2" style="padding-left:9px;padding-right:12px;">
        <form action="" method="post">

            <div class="row"> <!-- Row -->

                <div class="column" style="width:70%; background-color:<?php echo $_SESSION['bodytheme'] ?>;"> <!-- Left Column -->

                    <br>

                    <div class="row"> <!-- For Breakfast -->

                        <?php

                        $db = new SQLite3('database/SMP.db');
                        $username = $_SESSION['user_name'];

                        $bmiquery = "SELECT BMI_CLASS FROM USER_INFO WHERE USER_NAME = '$username'";
                        $bmiclass = $db->querySingle($bmiquery);

                        if ($_SESSION['mealpref'] == 'VEG') {
                            $query = "SELECT * FROM FOODS WHERE MEAL_TYPE = 'BF' AND MEAL_PREF = 'VEG' AND BMI_CLASS = '$bmiclass'";
                        } else {
                            $query = "SELECT * FROM FOODS WHERE MEAL_TYPE = 'BF' AND BMI_CLASS = '$bmiclass'";
                        }

                        $result = $db->query($query);
                        ?>

                        <div class="mealbox">
                            <h3>Breakfast</h3>
                            <div class="mealtable">

                                <div class="vertical-menu">
                                    <table>
                                        <tr>
                                            <th style="width:70px;">Select</th>
                                            <th style="width:300px;">Title</th>
                                            <th style="width:80px;">Calories</th>
                                            <th style="width:70px;">Cost (₹)</th>
                                            <th style="width:450px;">Description</th>
                                        </tr>

                                        <?php

                                        while ($rows = $result->fetchArray()) {
                                            ?>
                                            <td>
                                                <input style="align:center;" class="checkboxes" type="checkbox" name="checkArrB[]"
                                                    value="<?php echo $rows['TITLE']; ?>">
                                            </td>
                                            <td>
                                                <?php echo $rows['TITLE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['CALORIES']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['COST1']; ?>
                                            </td>
                                            <td>

                                            </td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- For Breakfast -->
                    <br>
                    <div class="row"> <!-- For Lunch -->

                        <?php

                        if ($_SESSION['mealpref'] == 'VEG') {
                            $query = "SELECT * FROM FOODS WHERE MEAL_TYPE = 'LN' AND MEAL_PREF = 'VEG' AND BMI_CLASS = '$bmiclass'";
                        } else {
                            $query = "SELECT * FROM FOODS WHERE MEAL_TYPE = 'LN'AND BMI_CLASS = '$bmiclass'";
                        }

                        $result = $db->query($query);
                        ?>

                        <div class="mealbox">
                            <h3>Lunch</h3>
                            <div class="mealtable">

                                <div class="vertical-menu">
                                    <table>
                                        <tr>
                                            <th style="width:70px;">Select</th>
                                            <th style="width:300px;">Title</th>
                                            <th style="width:80px;">Calories</th>
                                            <th style="width:70px;">Cost (₹)</th>
                                            <th style="width:450px;">Description</th>
                                        </tr>

                                        <?php

                                        while ($rows = $result->fetchArray()) {
                                            ?>
                                            <td>
                                                <input style="align:center;" class="checkboxes" type="checkbox" name="checkArrL[]"
                                                    value="<?php echo $rows['TITLE']; ?>">
                                            </td>
                                            <td>
                                                <?php echo $rows['TITLE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['CALORIES']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['COST1']; ?>
                                            </td>
                                            <td>

                                            </td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- For Lunch -->
                    <br>
                    <div class="row"> <!-- For Dinner -->

                        <?php

                        if ($_SESSION['mealpref'] == 'VEG') {
                            $query = "SELECT * FROM FOODS WHERE MEAL_TYPE = 'DN' AND MEAL_PREF = 'VEG' AND BMI_CLASS = '$bmiclass'";
                        } else {
                            $query = "SELECT * FROM FOODS WHERE MEAL_TYPE = 'DN' AND BMI_CLASS = '$bmiclass'";
                        }

                        $result = $db->query($query);
                        ?>

                        <div class="mealbox">
                            <h3>Dinner</h3>
                            <div class="mealtable">

                                <div class="vertical-menu">
                                    <table>
                                        <tr>
                                            <th style="width:70px;">Select</th>
                                            <th style="width:300px;">Title</th>
                                            <th style="width:80px;">Calories</th>
                                            <th style="width:70px;">Cost (₹)</th>
                                            <th style="width:450px;">Description</th>
                                        </tr>

                                        <?php

                                        while ($rows = $result->fetchArray()) {
                                            ?>
                                            <td>
                                                <input style="align:center;" class="checkboxes" type="checkbox" name="checkArrD[]"
                                                    value="<?php echo $rows['TITLE']; ?>">
                                            </td>
                                            <td>
                                                <?php echo $rows['TITLE']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['CALORIES']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows['COST1']; ?>
                                            </td>
                                            <td>

                                            </td>
                                            </tr>
                                        <?php } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- For Dinner -->

                    <?php

                    $_SESSION['PAY_ID'] = rand(1000, 9999);

                    if (isset($_POST['Submit'])) {
                        if (!empty($_POST['checkArrB'])) {

                            $username = $_SESSION['user_name'];
                            $startdate = $_POST['STARTDATE'];
                            $noofdays = $_POST['NOOFDAYS'];
                            $payid = $_SESSION['PAY_ID'];
                            $mealcount = count($_POST['checkArrB']);
                            $arraycnt = 0;

                            for ($i = 0; $i < $noofdays; $i++) {
                                $deliverydate = date('Y-m-d 09:00', strtotime("+$i day", strtotime($startdate)));
                                $checked = $_POST['checkArrB'][$arraycnt];
                                $result = $db->exec("INSERT INTO ORDERS (USER_NAME, TITLE, DELIVERY_DATE, NOOFDAYS, PAY_ID)
                                    VALUES ('$username','$checked', '$deliverydate', '$noofdays', '$payid')");
                                $arraycnt++;
                                if (!fmod($arraycnt, $mealcount)) {
                                    $arraycnt = 0;
                                }
                            }
                        }

                        if (!empty($_POST['checkArrL'])) {

                            $username = $_SESSION['user_name'];
                            $startdate = $_POST['STARTDATE'];
                            $noofdays = $_POST['NOOFDAYS'];
                            $payid = $_SESSION['PAY_ID'];
                            $mealcount = count($_POST['checkArrL']);
                            $arraycnt = 0;

                            for ($i = 0; $i < $noofdays; $i++) {
                                $deliverydate = date('Y-m-d 14:00', strtotime("+$i day", strtotime($startdate)));
                                $checked = $_POST['checkArrL'][$arraycnt];
                                $result = $db->exec("INSERT INTO ORDERS (USER_NAME, TITLE, DELIVERY_DATE, NOOFDAYS, PAY_ID)
                                    VALUES ('$username','$checked', '$deliverydate', '$noofdays', '$payid')");
                                $arraycnt++;
                                if (!fmod($arraycnt, $mealcount)) {
                                    $arraycnt = 0;
                                }
                            }
                        }

                        if (!empty($_POST['checkArrD'])) {

                            $username = $_SESSION['user_name'];
                            $startdate = $_POST['STARTDATE'];
                            $noofdays = $_POST['NOOFDAYS'];
                            $payid = $_SESSION['PAY_ID'];
                            $mealcount = count($_POST['checkArrD']);
                            $arraycnt = 0;

                            for ($i = 0; $i < $noofdays; $i++) {
                                $deliverydate = date('Y-m-d 20:00', strtotime("+$i day", strtotime($startdate)));
                                $checked = $_POST['checkArrD'][$arraycnt];
                                $result = $db->exec("INSERT INTO ORDERS (USER_NAME, TITLE, DELIVERY_DATE, NOOFDAYS, PAY_ID)
                                    VALUES ('$username','$checked', '$deliverydate', '$noofdays', '$payid')");
                                $arraycnt++;
                                if (!fmod($arraycnt, $mealcount)) {
                                    $arraycnt = 0;
                                }
                            }

                            echo "<script>location.href = 'Payment.php'</script>";
                        } else {
                            echo '<div class="error" style="color:red;">Checkbox is not selected!</div>';
                        }
                    }
                    ?>
                    <br><br>

                </div> <!-- Left Column -->

                <div class="column" style="background-color:<?php echo $_SESSION['mprightcolumn'] ?>;
                    float:left;width:30%;"> <!-- Right Column -->
                    <br>
                    <h2>Selected Info</h2>

                    <?php
                    $tdate = date('Y-m-d', strtotime("+1 day"));
                    $fdate = date('Y-m-d', strtotime("+21 day"));
                    ?>

                    <br>
                    <h5>Starting Date</h5>
                    <input type="date" class="date form-control" name="STARTDATE" min="<?php echo $tdate ?>"
                        max="<?php echo $fdate ?>" style="width: 150px"><br>

                    <h5>Number of Days</h5>
                    <input type="number" class="date form-control" name="NOOFDAYS" min="1" max="60" style="width: 75px">
                    <p>(A maximum of 60 days only)</p>

                    <br><input class="btn btn-primary" type="Submit" name="Submit" value="Proceed to Payment" />

                </div> <!-- Right Column -->
            </div> <!-- Row -->
        </form>
        <?php
        $db->close();
        ?>
</body>

</html>