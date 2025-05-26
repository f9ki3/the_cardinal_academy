var options = {
  chart: {
    type: "bar",
    height: 350,
    toolbar: {
      show: false, // ❌ hides download/export button
    },
  },
  series: [
    {
      name: "1st Quarter",
      data: [3, 4, 3, 3, 4, 2, 3],
    },
    {
      name: "2nd Quarter",
      data: [4, 5, 3, 4, 5, 2, 4],
    },
  ],
  xaxis: {
    categories: [
      "Math",
      "Science",
      "Filipino",
      "English",
      "P.E.",
      "Religion",
      "T.L.E.",
    ],
  },
  plotOptions: {
    bar: {
      horizontal: true,
      borderRadius: 4,
      barHeight: "70%",
    },
  },
  colors: ["rgba(111, 2, 2, 0.6)", "rgb(111, 2, 2)"],
  dataLabels: {
    enabled: false, // no numbers inside bars
  },
  legend: {
    position: "top",
  },
};

var chart = new ApexCharts(document.querySelector("#grading-chart"), options);
chart.render();
