const MORNING_START = 4;
const AFTERNOON_START = 12;
const EVENING_START = 18;
const NIGHT_START = 22;

function updateGreeting() {
    setInterval(greeting, 1000 * 60 * 60); // called every hour
    greeting();
}

function greeting() {
    const currentHour = new Date().getHours();

    if (currentHour > MORNING_START && currentHour < AFTERNOON_START) {
        greeting = "Good morning";
    } else if (currentHour < EVENING_START) {
        greeting = "Good afternoon";
    } else if (currentHour < NIGHT_START) {
        greeting = "Good evening";
    } else {
        greeting = "Good night";
    }

    document.getElementById("profile-greeting-js").innerHTML = greeting;
}