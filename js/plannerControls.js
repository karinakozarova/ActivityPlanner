$(document).ready(function() {
    var start = new Date();
    start.setHours(0,0,0,0);
    var end = new Date();
    end.setHours(23,59,59,999);

    var eventEnd = new Date();
    eventEnd.setHours(start.getHours() + 2);

    var $sked = $('#scheduler').skedTape({
      caption: 'Workouts',
      start: start, // Timeline starts this date-time (UTC)
      end: end,       // Timeline ends this date-time (UTC)
      showEventTime: false,     // Whether to show event start-end time
      showEventDuration: true, // Whether to show event duration
      showDates: false,
      zoom: 10.00,
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
              id: 7,
              name: 'Sunday',
          },
      ],
      events: [
          {
              name: 'Workout A',
              location: 1,
              start: start,
              end: eventEnd,
          },
          // ...
      ]
  });
  function addWorkout(name, start, end) {
      $sked.skedTape('addEvent', {
          name: name,
          location: start.getDay(),
          className: 'scheduler-workout-alt',
          start: start,
          end: end
      });
  }
});
