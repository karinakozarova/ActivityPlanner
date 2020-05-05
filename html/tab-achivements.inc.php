<?php
$achievements = $achievements->getUserAchievements($_SESSION['userid']);
?>

<h2>
    <div class="row">
        <div class="column">
            <img src="../images/trophy.png" class="small-image">
            Achievements (<?= $achievementsCount ?>) <a id="downloadAchievementsBttn" href="">
                <i class="fa fa-download" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <a href="newAchievement.php" class="card">
                <button> Add new achievement</button>
            </a>
        </div>
    </div>
    <br> <br>
</h2>
<div class="row">
    <?php
    if ($achievementsCount != 0) {
        foreach ($achievements as $achievement) { ?>
            <div class="column">
                <div class="card">
                    <img src="../images/achievement.jpg" alt="achievement" class="achievement-picture">
                    <div class="container">
                        <h4><b><?= $achievement->name; ?> received on <?= $achievement->receivedOn ?></b>
                        </h4>
                        <p><?= $achievement->description; ?></p>
                        <button class="btn-light left-margin" value="<?= $achievement->id?>" onclick="editAchievement($(this).val());">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn-light" value="<?= $achievement->id ?>"
                                onclick="deleteAchievement($(this).val());">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <h3> You don't have any achievements. Please add some. </h3>
    <?php } ?>
</div>

<script>
    var achievements = <?= json_encode($achievements) ?>;
</script>
<script src="../js/downloadAchievement.js"></script>
<script src="../js/deleteAchievements.js"></script>
<script src="../js/editAchievement.js"></script>