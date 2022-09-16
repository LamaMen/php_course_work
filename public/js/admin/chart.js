/* globals Chart:false, feather:false */

(function () {
        'use strict'

        var ctx = document.getElementById('myChart')
        // eslint-disable-next-line no-unused-vars


        const colors = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
        ];

        const backgroundColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
        ];

        const background = [];
        const mainColors = [];

        for (var i = 0; i < length; i++) {
            background.push(backgroundColors[i % 7])
            mainColors.push(colors[i % 7])
        }

        const config = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: background,
                    borderColor: mainColors,
                    borderWidth: 1,
                    base: 1,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Количество людей в группах по инструкторам"
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            stepSize: 1,
                        },
                    }],
                }
            }
        };

        const stackedBar = new Chart(ctx, config);
    }
)
()
