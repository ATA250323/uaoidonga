const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
const daysContainer = document.getElementById('days');
const monthContainer = document.getElementById('month');
const today = new Date();
const month = today.getMonth();
const year = today.getFullYear();

function renderCalendar(month, year) {
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    monthContainer.textContent = `${monthNames[month]} ${year}`;
    daysContainer.innerHTML = '';

    for (let i = 0; i < firstDay; i++) {
        daysContainer.innerHTML += '<div></div>';
    }

    for (let i = 1; i <= lastDate; i++) {
        daysContainer.innerHTML += `<div>${i}</div>`;
    }
}

renderCalendar(month, year);
