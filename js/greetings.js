function updateGreeting() {
    setInterval(greeting, 1000 * 60 * 60); // called every hour
    greeting();
}

function greeting() {
    const currentHour = new Date().getHours();

    if (currentHour > 4 && currentHour < 12) {
        greeting = "Good morning";
    } else if (currentHour < 18) {
        greeting = "Good afternoon";
    } else if (currentHour < 22) {
        greeting = "Good evening";
    } else {
        greeting = "Good night";
    }

    document.getElementById("profile-greeting-js").innerHTML = greeting;
}