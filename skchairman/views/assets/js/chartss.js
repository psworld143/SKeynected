const pieHeight = 250;

function createPieChart(containerId, seriesData, labels) {
  const options = {
    chart: {
      type: "pie",
      height: pieHeight,
    },
    series: seriesData,
    labels: labels,
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: "100%",
          },
        },
      },
    ],
  };

  const chart = new ApexCharts(document.querySelector(containerId), options);
  chart.render();
}
fetch("././api/api.php")
  .then((response) => response.json())
  .then((data) => {
    // Create pie charts with the fetched data
    createPieChart("#chart-barangay", data.baranggayData, data.baranggays);
    createPieChart(
      "#chart-school-youth-members",
      data.youthData,
      data.youthLabels
    );
    createPieChart("#chart-sex", data.sexData, data.sexLabels);
    createPieChart("#chart-age", data.ageData, data.ageLabels);
    createPieChart(
      "#chart-age-classification",
      data.ageClassificationData,
      data.ageClassificationLabels
    );
    createPieChart(
      "#chart-gender-pref",
      data.genderPrefData,
      data.genderPrefLabels
    );
    createPieChart(
      "#chart-civil-status",
      data.civilStatusData,
      data.civilStatusLabels
    );
  })
  .catch((error) => console.error("Error fetching data:", error));
