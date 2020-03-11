/**
 * @file
 */
(() => {
  var result = [];
  var labels = [];
  let everyResult = [];
  let everyLabel = ['Deadline', 'Took'];
  let everyTtitle = [];
  let counter = 0;

  (function ($, Drupal, drupalSettings) {
    Drupal.behaviors.my_custom_behavior = {
      attach: function (context, settings) {

        var data = drupalSettings.statistic;
        let deadline = 0;
        let took = 0;
        for (var i = 0; i < data.length; i++) {
          if(data[i][0] != null && data[i][1] != null){
            deadline += parseInt(data[i][0]);
            took += parseInt(data[i][1]);
          }
        }
        result.push(deadline);
        result.push(took);
        labels.push('Deadline')
        labels.push('Took')


        for (var i = 0; i < data.length; i++) {
          if (data[i][0] != null && data[i][1] != null) {
            everyResult.push(data[i][0]);
            everyResult.push(data[i][1]);
            everyTtitle.push(data[i][2]);
            counter += 1;

          }
        }
        chart();
        chartTask(counter, everyResult, everyTtitle);


      }
    }
    function chart() {
      var location = document.querySelector('#statistics-chart');
      var myChart = new Chart(location, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            data: result,
            backgroundColor: [
              'rgba(255, 0, 0, 0.2)',
              'rgba(0, 0, 255, 0.4)',
            ],
            borderColor: [
              'rgb(0,56,255)',
              'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
          }]
        },
        options: {
          title: {
            display: true,
            text: 'All tasks'
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    }

    function chartTask(i, res, tit){
      var temp = res.slice();
      var arr = [];
      while (temp.length) {
        arr.push(temp.splice(0,2));
      }

      for(var k = 1; k <= i; k++){
        temp = arr[k-1];
        t = tit[k-1];
        chartCreator(k, temp, t);
        temp = [];
      }

    }

    function chartCreator(k, res, tit){

      var location = document.querySelector('#statistics-chart-' + k);
      var myChart = new Chart(location, {
        type: 'bar',
        data: {
          labels: everyLabel,
          datasets: [{
            data: res,
            backgroundColor: [
              'rgba(255, 0, 0, 0.2)',
              'rgba(0, 0, 255, 0.4)',
            ],
            borderColor: [
              'rgb(0,56,255)',
              'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
          }]
        },
        options: {
          title: {
            display: true,
            text: tit,
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });





    }

  })(jQuery, Drupal, drupalSettings);


})();
