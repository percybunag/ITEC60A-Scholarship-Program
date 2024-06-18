var ctx = document.getElementById('doughnut').getContext('2d')
var myChart = new  Chart(ctx, {
    type: 'doughnut',
    data: {
        labels:['Applicants' , 'Available Slots'],
        datasets: [{
            label: 'Applicants  ',
            data: [30 , 45],
            backgroundColor:[
                'rgba(5,55,116)',
                'rgba(32, 156, 72, 1)'
            ],
            borderColor:[
                'rgba(5,55,116)',
                'rgba(32, 156, 72, 1)'
            ],
            borderWidth: 1
        }]

    },
    options: {
        responsive: true
    }
});

let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");

let classList = profileDropdownList.classList;

const toggle = () => classList.toggle("active");

window.addEventListener("click", function (e) {
  if (!btn.contains(e.target)) classList.remove("active");
});