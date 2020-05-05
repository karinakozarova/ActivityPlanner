let inputData = [0, 0, 0, 0, 0, 0, 0];
let dayNames = [];
const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
dates.forEach(function (item, index) {
    $.ajax({
        type: 'get',
        url: '../backend/getWaterIntake.php?date=' + item,
        date: item,
        success: function (res) {
            inputData[index] = res;
        }
    });
    const currentDay = new Date(item);
    dayNames[index] = days[currentDay.getDay()];
});

$(function () {
    let ctx = $("#line-chartcanvas");
    const goals = [dailyGoal, dailyGoal, dailyGoal, dailyGoal, dailyGoal, dailyGoal, dailyGoal];
    const data = {
        labels: dayNames,
        datasets: [
            {
                label: "Water Intake",
                data: inputData,
                backgroundColor: "#552244",
                borderColor: "#552244",
                fill: false,
                lineTension: 0,
                radius: 5
            },
            {
                label: "Your goals",
                data: goals,
                backgroundColor: "#1abc9c",
                borderColor: "#1abc9c",
                fill: false,
                lineTension: 3,
                radius: 0,

            }
        ]
    };

    //options
    const options = {
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
    const chart = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
});