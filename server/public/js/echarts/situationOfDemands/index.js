var situationsChart = echarts.init(
  document.getElementById("situation-of-demands")
);

fetch("home/situationOfDemands")
  .then((response) => response.json())
  .then((data) => {
    const result = Object.entries(data).map(([name, value]) => ({
      value: value,
      name: name,
    }));
    var option = {
      title: {
        text: "Situação das Demandas",
      },
      tooltip: {
        trigger: "item",
      },
      legend: {
        orient: "vertical",
        left: "right",
      },
      series: [
        {
          name: "Situação",
          type: "pie",
          radius: "50%",
          data: result,
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: "rgba(0, 0, 0, 0.5)",
            },
          },
          label: {
            formatter: "{d}%",
            position: "outside",
            textStyle: {
              fontSize: 14,
              fontWeight: "bold",
            },
          },
        },
      ],
    };
    situationsChart.setOption(option);
  })
  .catch((error) => console.error("Error fetching data:", error));
