<?php
$workouts = Workout::getWorkouts($_SESSION['userid']);
?>

<!--<script type="text/javascript">
$(document).ready(function() {
    var start = new Date();
    start.setHours(0,0,0,0);
    var end = new Date();
    end.setHours(23,59,59,999);

    var eventEnd = new Date();
    eventEnd.setHours(start.getHours() + 2);

    var workouts = <?php //echo json_encode($workouts); ?>;

    var curr = new Date; // get current date
    var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
    var last = first + 6; // last day is the first day + 6

    var firstday = new Date(curr.setDate(first));
    var lastday = new Date(curr.setDate(last));

    var $sked = $('#scheduler').skedTape({
      caption: 'Workouts',
      start: firstday, // Timeline starts this date-time (UTC)
      end: lastday,       // Timeline ends this date-time (UTC)
      showEventTime: false,     // Whether to show event start-end time
      showEventDuration: true, // Whether to show event duration
      showDates: true,
      zoom: 10,
      locations: [
          {
              id: 1,
              name: 'Monday',
              showDates: true,
          },
          {
              id: 2,
              name: 'Tuesday',
          },
          {
              id: 3,
              name: 'Wednesday',
          },
          {
              id: 4,
              name: 'Thursday',
          },
          {
              id: 5,
              name: 'Friday',
          },
          {
              id: 6,
              name: 'Saturday',
          },
          {
              id: 0,
              name: 'Sunday',
          },
      ],
      events: [
            <?php/*
            foreach ($workouts as $workout)
            {
                $location = date('N', strtotime($workout->startTime));
                echo "{name:".json_encode($workout->name).", location:".$location.", start:".json_encode($workout->startTime).", end:".json_encode($workout->endTime).",},";
            }*/
            ?>
      ]
  });

  function addWorkout(name, startTime, endTime) {
      $sked.skedTape('addEvent', {
          name: name,
          location: startTime.getDay(),
          className: 'scheduler-workout-alt',
          start: startTime,
          end: endTime.setHours(endTime.getHours() + 1)
      });
  }
});
</script>-->

<script type="text/javascript">
$(document).ready(function() {
    var Calendar = tui.Calendar;

    var calendar = new Calendar('#calendar', {
      defaultView: 'week',
      taskView: ['task'],
      scheduleView: ['time'],
      isReadOnly: true,
      useDetailPopup: true,
      template: {
        monthDayname: function(dayname) {
          return '<span class="calendar-week-dayname-name">' + dayname.label + '</span>';
        },
      },
    });

    calendar.clear();
    calendar.createSchedules([
        <?php
        $id = 0;
        foreach ($workouts as $workout)
        {
            $id++;
            //$location = date('N', strtotime($workout->startTime));
            echo "{id:".$id.", title:".json_encode($workout->name).", category: 'time', dueDateClass: '', bgColor: '#6dfc9a', start:".json_encode($workout->startTime).", end:".json_encode($workout->endTime).",},";
        }
        ?>
    ]);
    calendar.render();

    $("#calendar-prev-button").click(function(){
        if(calendar) { calendar.prev(); }
    });

    $("#calendar-next-button").click(function(){
        if(calendar) { calendar.next(); }
    });
});
</script>
