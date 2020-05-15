<?php
$workouts = Workout::getWorkouts($_SESSION['userid']);
?>

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
      week: {
          startDayOfWeek: 1,
          showTimezoneCollapseButton: true,
          timezonesCollapsed: false,
      },
    });

    // Populating the workout planner with database data

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
    calendar.render(true);

    // Workout planner navigation buttons - AJAX

    $("#calendar-prev-button").click(function(){
        if(calendar) { calendar.prev(); }
    });

    $("#calendar-next-button").click(function(){
        if(calendar) { calendar.next(); }
    });
});
</script>
