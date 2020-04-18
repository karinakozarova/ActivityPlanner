<style>
    form label {
        color: darkgray;
        cursor: pointer;
    }

    form input {
        margin: 15px 0;
        padding: 15px 10px;
        width: 30%;
        outline: none;
        border: 1px solid #bbb;
        border-radius: 20px;
    }

    input[type=submit] {
        padding: 15px 50px;
        width: auto;
        background: #1abc9c;
        border: none;
        color: white;
        cursor: pointer;
        clear: right;
    }

    input[type=submit]:hover {
        opacity: 0.8;
    }

    input[type="submit"]:active {
        opacity: 0.4;
    }
</style>
<?php
include('../backend/getDailyWaterIntake.php');
?>
<form action="../backend/addDailyCups.php" method="post">
    <label for="quantity">
        Number of cups today(250ml):
    </label> <br>
    <input type="number" id="quantity" name="quantity" min="1" value="<?= $waterCups ?>">
    <input type="submit">
</form>
<h4> Water statistics</h4>
<div class="chart-wrapper" id="activity-chart-container">
    <canvas id="line-chartcanvas" width="200px" height="80px"></canvas>
</div>
<?php
$date = date('Y-m-d');
$dayOfWeek = date("l", strtotime($date));
//Print out the day that our date fell on
$daynum = date("w", strtotime($dayOfWeek));
if($dayOfWeek = "Sunday") $daynum = 6;
$dates = [];

for($i = (int) $daynum; $i >= 0; $i--){
    $ago = '-' . $i . ' days';
    $thisDate = date("Y-m-d", strtotime($ago, strtotime($date)));
    $dates[] = $thisDate;
}
?>
<script>
    var inputData = [];
    var dates = [];
    dates = <?= json_encode($dates)?>;
    console.log(dates);

    dates.forEach(function (item, index) {
        // console.log(item);
        //$.ajax('../backend/getWaterIntake.php?date=' . item,
        //{
        //    success: function (data) {
        //        //console.log(<?////= $waterCups?>////);
        //        console.log(data);
        //    }
        //});
        $.ajax({
            type: 'get',
            url: '../backend/getWaterIntake.php?date=' + item,
            date: item,
            success: function(res) {
                console.log(res);
                inputData[index] = res;
                // alert(data);
            }
        });
    });


    $(function () {
        var ctx = $("#line-chartcanvas");
        //inputData = <?php //echo json_encode([0,0,0,0,0,0,0]) ?>//;
        //line chart data
        var data = {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            datasets: [
                {
                    label: "Water Intake",
                    data: inputData,
                    backgroundColor: "blue",
                    borderColor: "lightblue",
                    fill: false,
                    lineTension: 0,
                    radius: 5
                }
            ]
        };

        //options
        var options = {
            responsive: true,
            title: {
                display: true,
                position: "top",
                fontSize: 18,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            }
        };

        //create Chart class object
        var chart = new Chart(ctx, {
            type: "line",
            data: data,
            options: options
        });
    });
</script>