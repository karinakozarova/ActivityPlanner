let achievementsB64 = btoa(JSON.stringify(achievements));

const downloadLink = "data:application/octet-stream;charset=utf-8;base64," + achievementsB64;
document.getElementById("downloadAchievementsBttn").setAttribute("href", downloadLink);