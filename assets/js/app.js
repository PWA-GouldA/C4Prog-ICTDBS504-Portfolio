$(document).ready(function () {
    showGraph();
});


function showGraph()
{
    {
        $.post("tags-api.php",
            function (data)
            {
                Chart.defaults.global.legend.display = false;
                Chart.defaults.global.animation.easing='easeInOutExpo';

                console.log(data);
                let aDate = [];
                let taggings = [];

                for (let i in data) {
                    aDate.push(data[i].theDate);
                    taggings.push(data[i].totalTags);
                }

                let chartdata = {
                    labels: aDate,
                    datasets: [
                        {
                            backgroundColor: '#28a745',
                            borderColor: '#23853c',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: taggings
                        }
                    ],
                };

                let graphTarget = $("#graphCanvas");

                let barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        tooltips: {
                            callbacks: {
                                label: tooltipItem => ` ${tooltipItem.yLabel}`,
                                title: () => null,
                            }
                        },
                        scales: {
                            xAxes: [{
                                barPercentage: 0.8,
                                minBarLength: 2,
                                gridLines: {
                                    offsetGridLines: true
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                                }
                            }]
                        }
                    }
                });
            });
    }
}
