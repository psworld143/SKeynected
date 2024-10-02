const pieHeight = 250;
const ageClassificationPieHeight = 350; 


class PieChart {
  constructor(containerId, seriesData, labels, colors, chartHeight) {
    this.containerId = containerId;
    this.seriesData = seriesData;
    this.labels = labels;
    this.colors = colors; 
    this.options = {
      chart: {
        type: "pie",
        height: chartHeight || pieHeight, 
      },
      series: this.seriesData,
      labels: this.labels,
      colors: this.colors, 
      dataLabels: {
        style: {
          fontSize: '10px', 
        },
      },
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
  }

  create() {
    const chart = new ApexCharts(document.querySelector(this.containerId), this.options);
    chart.render();
  }
}


async function fetchData(apiUrl) {
  try {
    const response = await fetch(apiUrl);
    const data = await response.json();


    const colors = {
      baranggay: ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#FF8333", "#33FF83", "#A133FF"],
      youth: ["#FFC300", "#FF5733"],
      sex: ["#33FF57", "#FF33A1"],
      age: ["#FF5733", "#FF8333", "#33FF57", "#3357FF", "#FF33A1", "#A133FF", "#FFC300"],
      ageClassification: ["#FF5733", "#33FF57", "#3357FF"],
      genderPref: ["#FF33A1", "#FFC300", "#33FF57", "#3357FF", "#FF8333"],
      civilStatus: ["#FF5733", "#33FF57", "#3357FF", "#FF33A1", "#FFC300"],
    };


    new PieChart("#chart-barangay", data.baranggayData, data.baranggays, colors.baranggay).create();
    new PieChart("#chart-school-youth-members", data.youthData, data.youthLabels, colors.youth).create();
    new PieChart("#chart-sex", data.sexData, data.sexLabels, colors.sex).create();
    new PieChart("#chart-age", data.ageData, data.ageLabels, colors.age).create();
    
  
    new PieChart("#chart-age-classification", data.ageClassificationData, data.ageClassificationLabels, colors.ageClassification, ageClassificationPieHeight).create();
    
    new PieChart("#chart-gender-pref", data.genderPrefData, data.genderPrefLabels, colors.genderPref).create();
    new PieChart("#chart-civil-status", data.civilStatusData, data.civilStatusLabels, colors.civilStatus).create();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}


fetchData("././api/api.php");
