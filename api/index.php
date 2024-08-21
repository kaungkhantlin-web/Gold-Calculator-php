
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold calculator</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

</head>

<body>
    <?php

    $weightInGram = null;
    $salePrice = null;
    $currentPrice = null;
    $weightInPae = null;
    $actualGoldPrice = null;
    $serviceCharges = null;

    $value_required = false;

    
    if (empty($_POST["weightInGram"]) && empty($_POST["salePrice"]) && empty($_POST["currentPrice"])) {
        $weightInGram = $salePrice = $currentPrice = "";
        $value_required = true;
    }
    //  found error when checking for the validation 

    if (isset($_POST["weightInGram"]) && isset($_POST["salePrice"]) && isset($_POST["currentPrice"])) {
        $weightInGram = $_POST["weightInGram"];
        $salePrice = $_POST["salePrice"];
        $currentPrice = $_POST["currentPrice"];

        $weightInPae = $weightInGram  / 1.0205;
        $pae_to_kyat = $weightInGram / 16;
        $actualGoldPrice = $pae_to_kyat * $currentPrice;
        $serviceCharges = $salePrice - $actualGoldPrice;

        $weightInPae = number_format($weightInPae, 2);
        $actualGoldPrice = number_format($actualGoldPrice, 0);
        $serviceCharges = number_format($serviceCharges, 0);
    }
    
    ?>

    <!-- calculate contianer start -->
    <div class="border-container">
        <div class="main-container">
            <div class="title">
                <h2>Gold Calculator</h2>
                <i class="fa-solid fa-coins"></i>
            </div>
            <form action="index.php" method="post">
                <div class="calculate-container">

                    <label for="weightInGram">Gold weight (in gram):
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="weightInGram" value="<?php echo $weightInGram;  ?>" placeholder="write your gold weight..">
                    <?php if ($value_required) { ?>
                        <span class="text-danger"> This field is required!</span>
                    <?php  } ?>
                    <label for="salePrice">Sale Price:
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="salePrice" value="<?php echo $salePrice;  ?>" placeholder="write the sale price..">
                    <?php if ($value_required) { ?>
                        <span class="text-danger"> This field is required!</span>
                    <?php  } ?>
                    <label for="currentPrice">Current Gold price:
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="currentPrice" value="<?php echo $currentPrice;?>" placeholder="write current gold price..">
                    <?php if ($value_required) { ?>
                        <span class="text-danger"> This field is required!</span>
                    <?php  } ?>
                    <button type="submit">Calculate</button>
                </div>
                <!-- calculate container end -->

                <!-- Result container -->
                <div class="reult-container">
                    <h2>Results:</h2>
                    <div class="line"></div>
                    <p>ရွှေအလေးချိန်: <strong name="weightInPae"><?php echo $weightInPae;  ?></strong> ပဲ</p>
                    <p>ရွှေတန်ဖိုး: <strong name="actualGoldPrice"><?php echo $actualGoldPrice;  ?></strong> ကျပ်</p>
                    <p>လက်ခ: <strong name="serviceCharges"><?php echo $serviceCharges;  ?></strong> ကျပ်</p>
                </div>
                <!-- Result container end -->
            </form>
        </div>
    </div>

</body>

</html>