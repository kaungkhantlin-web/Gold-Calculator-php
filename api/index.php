<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold calculator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    :root {
        --bgcolor: rgb(59, 59, 59, 0.8);
    }

    :root {
        --goldcolor: rgb(255, 215, 0);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(to bottom, var(--bgcolor), black);
        height: 100vh;
    }


    /* calculator contianer start */
    .main-container {
        display: flex;
        flex-direction: column;
        width: 60%;
        padding: 10px;
        text-align: center;
        border: 1px solid gray;
        transition: all 0.4s ease-in-out;
        border-radius: 10px;
        background: linear-gradient(150deg, var(--bgcolor), gray);
        margin: auto;
    }

    /* form */
    form {
        display: flex;
        flex-direction: column;
        background-color: var(--bgcolor);
        border-radius: 10px;
        box-shadow: 0px 0px 3px var(--goldcolor);
        margin: 2px 7px;
    }

    .title {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        color: var(--goldcolor);
    }

    .calculate-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 15px 10px;
    }

    .calculate-container label {
        font-size: 18px;
        font-weight: bold;
        color: var(--goldcolor);
    }

    .calculate-container input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
        box-shadow: 0 0 5px var(--bgcolor);
        transition: all 0.3s ease-in-out;
        background-color: beige;
        cursor: pointer;
    }

    .calculate-container button {
        width: 100%;
        padding: 13px;
        border-radius: 5px;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        box-shadow: 0 0 10px var(--bgcolor);
        transition: all 0.4s ease-in-out;
        background-color: beige;
        color: black;
        margin-top: 15px;
    }

    input:focus {
        outline: none;
    }

    input:hover {
        border: 3px solid black;
    }

    button:focus {
        outline: none;
    }

    button:hover {
        transform: scale(1.1);
        background-color: black;
        font-size: 19px;
        color: var(--goldcolor);
    }

    .line {
        border-bottom: 1px solid var(--goldcolor);
        width: 80%;
        margin: auto;
    }

    /* calculator container end */

    /* result start */
    .reult-container {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: large;
        margin-top: 10px;
        color: var(--goldcolor);
    }

    /* result end */

    /* media query */
    @media screen and (max-width: 600px) {
        .main-container {
            width: 60%;
        }
    }

    @media screen and (max-width: 500px) {
        .main-container {
            width: 80%;
        }
    }
</style>
</head>

<body>
    <?php

    $weightInGram = null;
    $salePrice = null;
    $currentPrice = null;
    $weightInPae = null;
    $actualGoldPrice = null;
    $serviceCharges = null;
    $error_message = false;

    if (isset($_POST["submit"])) {

        if (isset($_POST["weightInGram"]) && isset($_POST["salePrice"]) && isset($_POST["currentPrice"])) {
            $weightInGram = $_POST["weightInGram"];
            $salePrice = $_POST["salePrice"];
            $currentPrice = $_POST["currentPrice"];

            if (!empty($weightInGram) && !empty($salePrice) && !empty($currentPrice)) {
                $weightInPae = $weightInGram  / 1.0205;
                $pae_to_kyat = $weightInGram / 16;
                $actualGoldPrice = $pae_to_kyat * $currentPrice;
                $serviceCharges = $salePrice - $actualGoldPrice;
            }
            else 
                 $error_message = true;
            
        }
    }
    ?>
    <!-- calculate contianer start -->
    <div class="main-container">
        <div class="title">
            <h2>Gold Calculator</h2>
            <i class="fa-solid fa-coins"></i>
        </div>
        <form action="index.php" method="post" enctype="multipart/form-data">
        <span class="text-danger"> <?php echo $error_message ? "All fields are required!" : " "; ?> </span>
            <div class="calculate-container">

                <label for="weightInGram">Gold weight (in gram):
                    <span class="text-danger">*</span>
                </label>
                <!-- <span class="text-danger"> <?php echo  ($error_message) ? "This field is required!" : ""; ?> </span> -->
                <input type="number" name="weightInGram" value="<?php echo $weightInGram;  ?>" placeholder="write your gold weight..">

                <label for="salePrice">Sale Price:
                    <span class="text-danger">*</span>
                </label>
               
                <input type="number" name="salePrice" value="<?php echo $salePrice;  ?>" placeholder="write the sale price..">
               

                <label for="currentPrice">Current Gold price:
                    <span class="text-danger">*</span>
                </label>
                <!-- <span class="text-danger"> <?php echo ($error_message) ? "This field is required!" : ""; ?> </span> -->
                <input type="number" name="currentPrice" value="<?php echo $currentPrice; ?>" placeholder="write current gold price..">
               

                <button type="submit" name="submit">Calculate</button>
            </div>
            <!-- calculate container end -->

            <!-- Result container -->
            <div class="reult-container">
                <h2>Results:</h2>
                <div class="line"></div>
                <p>ရွှေအလေးချိန်: <strong name="weightInPae"><?php echo $weightInPae = number_format($weightInPae, 0);  ?></strong> ပဲ</p>
                <p>ရွှေတန်ဖိုး: <strong name="actualGoldPrice"><?php echo $actualGoldPrice = number_format($actualGoldPrice, 0); ?></strong> ကျပ်</p>
                <p>လက်ခ: <strong name="serviceCharges"><?php echo $serviceCharges = number_format($serviceCharges, 0);  ?></strong> ကျပ်</p>
            </div>
            <!-- Result container end -->
        </form>
    </div>

</body>

</html>