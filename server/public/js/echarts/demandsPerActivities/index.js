var myChart = echarts.init(document.getElementById("demands-per-activities"));

fetch("home/demandsPerActivities")
  .then((response) => response.json())
  .then((data) => {
    var option = {
      title: {
        text: "Quantidade de Demandas por Situação",
      },
      tooltip: {},
      xAxis: {
        data: data.activities,

        axisLabel: {
          fontSize: 10,
          overflow: "truncate",
          width: 70,
          hideOverlap: false,
          interval: 0,
        },
      },
      yAxis: {},
      series: [
        {
          name: "Demandas",
          type: "bar",
          data: data.quantities,
          colorBy: "data",
        },
      ],
    };

    myChart.setOption(option);
  })
  .catch((error) => console.error("Error fetching data:", error));
