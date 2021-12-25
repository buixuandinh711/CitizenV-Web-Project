var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55000000, 49000000, 44000000, 24000000, 15000000];
var barColors = "deepskyblue";

function createLocationChart(xValues, yValues) {
  new Chart("location-chart", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: { display: false },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          },
          scaleLabel: {
            display: true,
            labelString: 'Dân số'
          }
        }],
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Địa phương'
          },
        }],
      },
      title: {
        display: true,
        text: "Biểu đồ dân số theo địa phương"
      }
    }
  });
}

function createAgeChart(yValues) {
  let xValues = ["0-10", "11-20", "21-30", "31-40", "41-50", "51-60", "61-70", "71-80",
    "81-90", "91-100", "100+"];

  new Chart("age-chart", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: { display: false },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          },
          scaleLabel: {
            display: true,
            labelString: 'Số dân'
          }
        }],
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Độ tuổi'
          }
        }],
      },
      title: {
        display: true,
        text: "Biểu đồ dân số theo độ tuổi"
      }
    }
  });
}

function createGenderChart(yValues) {
  xValues = ["Nam", "Nữ"];
  let colors = ["deepskyblue", "white"];

  new Chart("gender-chart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: colors,
        data: yValues,
        borderColor: "deepskyblue",
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: true,
        text: "Biều đồ tỉ lệ giới tính"
      }
    }
  });
}

function loadLocationInfo() {
  fetch('get-general-info', {
    method: 'get',
    headers: {
      "Content-Type": "application/json",
    }
  }).then(function (response) {
    return response.json();
  }).then(function (data) {
    $("#info-name").html("Địa bản: " + data.name);
    $("#info-lowers").html("Số địa phương trực thuộc: " + data.lowerLocations);
    $("#info-population").html("Tổng dân số: " + data.population);
  });
}

function loadLocationPopulation() {
  fetch('get-location-chart', {
    method: 'get',
    headers: {
      "Content-Type": "application/json",
    }
  }).then(function (response) {
    return response.json();
  }).then(function (data) {

    createLocationChart(data.locations, data.population);
  });
}

function loadAgePopulation() {
  fetch('get-age-chart', {
    method: 'get',
    headers: {
      "Content-Type": "application/json",
    }
  }).then(function (response) {
    return response.json();
  }).then(function (data) {
    console.log(data);
    createAgeChart(data.population);
  });
}

function loadGender() {
  fetch('get-gender-chart', {
    method: 'get',
    headers: {
      "Content-Type": "application/json",
    }
  }).then(function (response) {
    return response.json();
  }).then(function (data) {
    createGenderChart([data.men * 100, 100 - data.men * 100]);
  });
}

loadLocationInfo();
loadLocationPopulation();
loadAgePopulation();
loadGender();