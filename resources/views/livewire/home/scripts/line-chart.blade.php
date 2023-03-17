<script>
    events = ['livewire:load', 'update']
    events.forEach(event => {
        document.addEventListener(event, function(e) {


            if (register) {
                var graphGradient = document.getElementById("registerUserLine").getContext('2d');
                var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
                saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
                saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
                data_label = Object.keys(register)
                data_register = Object.values(register)

                var salesTopData = {
                    labels: data_label.reverse(),
                    datasets: [{
                        label: 'Data Device Masuk',
                        data: data_register.reverse(),
                        backgroundColor: saleGradientBg,
                        borderColor: [
                            '#1F3BB3',
                        ],
                        borderWidth: 1.5,
                        fill: true, // 3: no fill
                        pointBorderWidth: 1,
                        pointRadius: [4, 4, 4, 4, 4, 4, 4],
                        pointHoverRadius: [2, 2, 2, 2, 2, 2, 2],
                        pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3',
                            '#1F3BB3)', '#1F3BB3', '#1F3BB3'
                        ],
                        pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff',
                            '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff',
                        ],
                    }]
                };

                var salesTopOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                color: "#F0F0F0",
                                zeroLineColor: '#F0F0F0',
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 4,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                    },
                    legend: false,
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<div class="chartjs-legend"><ul>');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            console.log(chart.data.datasets[i]); // see what's inside the obj.
                            text.push('<li>');
                            text.push('<span style="background-color:' + chart.data.datasets[i]
                                .borderColor + '">' + '</span>');
                            text.push(chart.data.datasets[i].label);
                            text.push('</li>');
                        }
                        text.push('</ul></div>');
                        return text.join("");
                    },

                    elements: {
                        line: {
                            tension: 0.4,
                        }
                    },
                    tooltips: {
                        backgroundColor: 'rgba(31, 59, 179, 1)',
                    }
                }
                var salesTop = new Chart(graphGradient, {
                    type: 'line',
                    data: salesTopData,
                    options: salesTopOptions
                });

                document.getElementById('register-user-line').innerHTML = salesTop.generateLegend();
            }

            if (monthly) {

                monthly_label = Object.keys(monthly)
                monthly_value = Object.values(monthly)

                var marketingOverviewChart = document.getElementById("monthly-register").getContext(
                    '2d');
                var marketingOverviewData = {
                    labels: monthly_label,
                    datasets: [{
                        label: 'Data masuk perbulan',
                        data: monthly_value,
                        backgroundColor: "#52CDFF",
                        borderColor: [
                            '#52CDFF',
                        ],
                        borderWidth: 0,
                        fill: true, // 3: no fill

                    }]
                };

                var marketingOverviewOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                color: "#F0F0F0",
                                zeroLineColor: '#F0F0F0',
                            },
                            ticks: {
                                beginAtZero: true,
                                autoSkip: true,
                                maxTicksLimit: 5,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            barPercentage: 0.35,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 12,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                    },
                    legend: false,
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<div class="chartjs-legend"><ul>');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            console.log(chart.data.datasets[i]); // see what's inside the obj.
                            text.push('<li class="text-muted text-small">');
                            text.push('<span style="background-color:' + chart.data.datasets[i]
                                .borderColor + '">' + '</span>');
                            text.push(chart.data.datasets[i].label);
                            text.push('</li>');
                        }
                        text.push('</ul></div>');
                        return text.join("");
                    },

                    elements: {
                        line: {
                            tension: 0.4,
                        }
                    },
                    tooltips: {
                        backgroundColor: 'rgba(31, 59, 179, 1)',
                    }
                }
                var marketingOverview = new Chart(marketingOverviewChart, {
                    type: 'bar',
                    data: marketingOverviewData,
                    options: marketingOverviewOptions
                });
                document.getElementById('monthly-register-legend').innerHTML = marketingOverview
                    .generateLegend();
            }

        });

    });
</script>
