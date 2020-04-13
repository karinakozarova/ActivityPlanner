$(document).ready(function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Burned calories',
                data: [12, 19, 3, 5, 2, 3, 7, 3, 4, 5 , 6 , 7].slice(-7),
                backgroundColor: "transparent",
                borderColor: 'rgba(255, 87, 51)',
                borderWidth: 3
            },
            {
                label: 'Exercise Activity',
                data: [6, 10, 1, 2, 16, 6, 7].slice(-7),
                backgroundColor: "transparent",
                borderColor: 'rgba(7, 121, 228)',
                borderWidth: 3
            },
            {
                label: 'Steps',
                data: [1, 15, 18, 8, 4, 6, 19].slice(-7),
                backgroundColor: "transparent",
                borderColor: 'rgba(91, 140, 90)',
                borderWidth: 3
            },
            {
                label: 'Distance',
                data: [5,3,6,7,8,3,20,10, 5].slice(-7),
                backgroundColor: "transparent",
                borderColor: 'rgba(85, 34, 68)',
                borderWidth: 3
            }
        ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {scales: {yAxes: [{beginAtZero: true}], xAxes: [{autoskip: true, maxTicketsLimit: 7, gridLines: {show: false}}]}},
            tooltips: {mode: 'index'}
        }
    });
});
