<?php
$achievements = $achievements->getUserAchievements($conn, $_SESSION['userid']);
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
                    <img src="../images/achievement.jpg" alt="achievement"
                         style="width: 100%;height: 100%">
                    <div class="container">
                        <h4><b><?= $achievement->name; ?> received
                                on <?= $achievement->receivedOn ?></b>
                        </h4>
                        <p><?= $achievement->description; ?></p>
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
    let achievementsB64 = btoa(JSON.stringify(achievements));

    var downloadLink = "data:application/octet-stream;charset=utf-8;base64," + achievementsB64;
    document.getElementById("downloadAchievementsBttn").setAttribute("href", downloadLink);
</script>