<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>assets/css/test.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="styles.css"> -->
    <title>Rank List</title>
</head>

<body>
    <div class="rank-list">
        <?php foreach ($result as $key => $username) : ?>
            <div class="rank-item <?php if ($key + 1 <= 3) echo 'first-three'; ?><?php if ($key + 1 > 3) echo 'rank-four-and-below'; ?>">
                <?php if ($key + 1 == 1) : ?>
                    <img class="medal" src="<?php echo base_url(); ?>assets/img/medali/medali_01.png" alt="Medal">
                <?php elseif ($key + 1 == 2) : ?>
                    <img class="medal" src="<?php echo base_url(); ?>assets/img/medali/medali_02.png" alt="Medal">
                <?php elseif ($key + 1 == 3) : ?>
                    <img class="medal" src="<?php echo base_url(); ?>assets/img/medali/medali_03.png" alt="Medal">
                <?php else : ?>
                    <span><?= $key + 1; ?></span>
                <?php endif; ?>
                <div class="username-container">
                    <span class="username"><?= $username['nama_sales']; ?></span>
                    <span class="jumlah"><?= $username['jumlah']; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>