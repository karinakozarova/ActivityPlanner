<?php
$achievements = $achievements->getUserAchievements($_SESSION['userid']);
?>

<h2>
    <div class="row">
        <div class="column title-wrapper">
            <svg id="achievements-trophy-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M13.408 18c.498-3.947 5.592-7.197 5.592-17h-14c0 9.803 5.105 13.053 5.604 17h2.804zm-3.614-11.472l1.46-.202.643-1.326.643 1.326 1.46.202-1.063 1.021.26 1.451-1.3-.695-1.3.695.26-1.451-1.063-1.021zm-3.803 4.128c.286.638.585 1.231.882 1.783-4.065-1.348-6.501-5.334-6.873-9.439h4.077c.036.482.08.955.139 1.405h-2.689c.427 2.001 1.549 4.729 4.464 6.251zm10.009 10.963v1.381h-8v-1.381c1.941 0 2.369-1.433 2.571-2.619h2.866c.193 1.187.565 2.619 2.563 2.619zm8-18.619c-.372 4.105-2.808 8.091-6.873 9.438.297-.552.596-1.145.882-1.783 2.915-1.521 4.037-4.25 4.464-6.251h-2.688c.059-.45.103-.922.139-1.405h4.076z"/>
            </svg>
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
