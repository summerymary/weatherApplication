let body = document.querySelector('body');
let currentHours = parseInt(data.currentHour);
let dayManager = new DayManager(currentHours);
let currentWeather = (data.currentWeather);
console.log(data.currentWeather)

let dayStyleClassName = dayManager.getDayStyleClassName();

body.classList.add(dayStyleClassName);