<script>
    var dom = document.getElementById("chart_c"),
            myChart = echarts.init(dom),
            app = {},
            dataAxis = ['tt', 'tt', 'ee', 'sss', 'ss', 'ds', 'dz', 'wxw', 'xw', 'x', 'x', 'x', 'D', 'd', 'd', 'd', 'd', 'Z', 'z', 'Z'],
            data = [220, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90, 149, 210, 122, 133, 334, 198, 123, 125, 220],
            yMax = 500,
            dataShadow = [];

    for (var i = 0; i < data.length; i++) {
        dataShadow.push(yMax);
    }

    var option = {
        title: {
            text: 'Feature Sample',
            subtext: 'Gradient Color, Shadow, Click Zoom'
        },
        xAxis: {
            data: dataAxis,
            axisLabel: {
                inside: true,
                textStyle: {
                    color: '#fff'
                }
            },
            axisTick: {
                show: false
            },
            axisLine: {
                show: false
            },
            z: 10
        },
        yAxis: {
            axisLine: {
                show: false
            },
            axisTick: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#999'
                }
            }
        },
        dataZoom: [
            {
                type: 'inside'
            }
        ],
        series: [
            { // For shadow
                type: 'bar',
                itemStyle: {
                    normal: {color: 'rgba(0,0,0,0.05)'}
                },
                barGap:'-100%',
                barCategoryGap:'40%',
                data: dataShadow,
                animation: false
            },
            {
                type: 'bar',
                itemStyle: {
                    normal: {
                        color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#F44336'},
                                    {offset: 0.5, color: '#F44336'},
                                    {offset: 1, color: '#E53935'}
                                ]
                        )
                    },
                    emphasis: {
                        color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#C62828'},
                                    {offset: 0.7, color: '#C62828'},
                                    {offset: 1, color: '#B71C1C'}
                                ]
                        )
                    }
                },
                data: data
            }
        ]
    };
    // Enable data zoom when user click bar.
    var zoomSize = 6;
    myChart.on('click', function (params) {
        console.log(dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)]);
        myChart.dispatchAction({
            type: 'dataZoom',
            startValue: dataAxis[Math.max(params.dataIndex - zoomSize / 2, 0)],
            endValue: dataAxis[Math.min(params.dataIndex + zoomSize / 2, data.length - 1)]
        });
    });
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
        $window.on('debouncedresize',function() {
            myChart.resize()
        });
    }
</script>