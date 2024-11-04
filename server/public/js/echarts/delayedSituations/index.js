var delayedChart = echarts.init(document.getElementById("delayed-situations"));

// TROCAR COR DESSE ECHART

fetch("home/delayedSituations")
  .then((response) => response.json())
  .then((data) => {
    const yAxisData = Object.keys(data);

    const seriesData = [
      {
        name: "Atrasado",
        type: "bar",
        data: yAxisData.map((status) => data[status].atrasado),
        color: "#b3010c",
      },
      {
        name: "Em Dia",
        type: "bar",
        data: yAxisData.map((status) => data[status].nao_atrasado),
        color: "#01b34f",
      },
    ];

    var option = {
      title: {
        text: "Situações Em Atraso",
      },
      tooltip: {
        trigger: "axis",
        axisPointer: {
          type: "shadow",
        },
      },
      legend: {},
      grid: {
        left: "3%",
        right: "4%",
        bottom: "3%",
        containLabel: true,
      },
      xAxis: {
        type: "value",
        boundaryGap: [0, 0.01],
      },
      yAxis: {
        type: "category",
        data: yAxisData,
      },
      series: seriesData,
    };

    delayedChart.setOption(option);
  })
  .catch((error) => console.error("Error fetching data:", error));
