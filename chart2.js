const ctx2 = document.getElementById('barchart').getContext('2d');
const barchart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Proper', 'Bauan', 'Mabini', 'San Juan', 'Calatagan', 'Lemery'],
        datasets: [{
            label: 'Violators',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                '#fafafa',
                '#cc3c43',
                '#367952',
                '#f5b74f',
                '#4f35a1',
                '#246dec',
            ],

            borderColor: [
                '#fafafa',
                '#cc3c43',
                '#367952',
                '#f5b74f',
                '#4f35a1',
                '#246dec',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },

}
);