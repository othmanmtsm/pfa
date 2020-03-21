const api_url = './data.php';

let months = [];
let numComs = [];

async function getData() {
    const response = await fetch(api_url);
    const data = await response.json();
    data.forEach(rec => {
        months.push(rec.month);
        numComs.push(rec.countCom);
    });
    var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Nombre de Commandes par mois',
                    data: numComs,
                    backgroundColor: 'rgba(124, 77, 255, 0.2)',
                    borderColor: 'rgba(124, 77, 255)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
        myChart.canvas.style.height = '356px';
        myChart.canvas.style.width = '712px';
        document.getElementById('chartload').style.display = 'none';
}

getData();



        