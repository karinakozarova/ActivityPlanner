var d = new Date();
d.setSeconds(0,0);
document.getElementById('datePicker').value = d.toISOString().replace('Z', '') ;