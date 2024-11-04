var activitiesChart = echarts.init(
  document.getElementById("demands-per-activities")
);

fetch("home/demandsPerActivities")
  .then((response) => response.json())
  .then((data) => {
    const activities = Object.keys(data);
    const quantities = Object.values(data);

    var option = {
      title: {
        text: "Quantidade de Demandas por Atividade",
      },
      tooltip: {},
      xAxis: {
        data: activities,

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
          data: quantities,
          colorBy: "data",
        },
      ],
    };

    activitiesChart.setOption(option);
  })
  .catch((error) => console.error("Error fetching data:", error));
