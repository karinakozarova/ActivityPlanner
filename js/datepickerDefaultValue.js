var date = new Date();
date.setSeconds(0, 0);
document.getElementById('datePicker').value = date.toISOString().replace('Z', '');