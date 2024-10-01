const baranggayData = [50, 40, 30, 20, 10, 5, 0];
const baranggays = [
  "Acmonan",
  "Bololmala",
  "Bunao",
  "Cebuano",
  "Crossing Rubber",
  "Kablon",
  "Kalkam",
  "Linan",
];

const youthData = [50, 80];
const youthLabels = ["Yes", "No"];

const sexData = [50, 50];
const sexLabels = ["Male", "Female"];

const ageData = [50, 40, 30, 20, 10, 5, 0];
const ageLabels = ["0-9", "10-19", "20-29", "30-39", "40-49", "50-59", "60+"];

const ageClassificationData = [50, 40, 30];
const ageClassificationLabels = [
  "CHILD YOUTH (15-17 YEARS OLD)",
  "CORE YOUTH(15-24 YEARS OLD)",
  "ADULT YOUTH(25-30 YEARS OLD)",
];

const genderPrefData = [50, 40, 30];
const genderPrefLabels = ["Girl", "Boy", "Lesbian", "Gay", "Prefer Not Say"];

const civilStatusData = [50, 40, 30, 20, 10];
const civilStatusLabels = [
  "Single",
  "Married",
  "Widowed",
  "Separated",
  "In Relationship",
];

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

// Create pie charts
createPieChart("#chart-barangay-population", baranggayData, baranggays);
createPieChart("#chart-school-youth-members", youthData, youthLabels);
createPieChart("#chart-sex", sexData, sexLabels);
createPieChart("#chart-age", ageData, ageLabels);
createPieChart(
  "#chart-age-classification",
  ageClassificationData,
  ageClassificationLabels
);
createPieChart("#chart-gender-pref", genderPrefData, genderPrefLabels);
createPieChart("#chart-civil-status", civilStatusData, civilStatusLabels);
