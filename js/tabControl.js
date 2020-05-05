const hidden_class = "hidden";
const active_class = "active";

function hideAll() {
    document.getElementById("tab-overview").classList.add(hidden_class);
    document.getElementById("tab-planner").classList.add(hidden_class);
    document.getElementById("tab-achievements").classList.add(hidden_class);
    document.getElementById("tab-goals").classList.add(hidden_class);
    document.getElementById("tab-water").classList.add(hidden_class);

    let elements = document.getElementsByClassName(active_class)
    while (elements[0]) {
        elements[0].classList.remove(active_class)
    }
}

function showOverview() {
    hideAll();
    document.getElementById("tab-overview").classList.remove(hidden_class);
    document.getElementById("overview-nav").classList.add(active_class);
}

function showPlanner() {
    hideAll();
    document.getElementById("tab-planner").classList.remove(hidden_class);
    document.getElementById("nav-planner").classList.add(active_class);
}

function showAchievements() {
    hideAll();
    document.getElementById("tab-achievements").classList.remove(hidden_class);
    document.getElementById("nav-achievements").classList.add(active_class);
}

function showGoals() {
    hideAll();
    document.getElementById("tab-goals").classList.remove(hidden_class);
    document.getElementById("nav-goals").classList.add(active_class);
}

function showWaterIntake() {
    hideAll();
    document.getElementById("tab-water").classList.remove(hidden_class);
    document.getElementById("nav-water").classList.add(active_class);
}