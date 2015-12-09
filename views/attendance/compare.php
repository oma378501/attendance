<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use sjaakp\gcharts\PieChart;


/* @var $this yii\web\View */
/* @var $model app\models\Attendance */

$this->title = 'Compare Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    <html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
    
    <!-- Undefined variable: dataProvider
    https://github.com/sjaakp/yii2-gcharts/blob/master/README.md -->
    <!--?= PieChart::widget([
    'height' => '400px',
    'dataProvider' => $dataProvider,
    'columns' => [
        'student_module:int',
        'present'
    ],
    'options' => [
        'title' => 'Countries by Population'
    ],
]) ?-->
    
    
    <?php echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Sample title - pie chart'],
        'plotOptions' => [
            'pie' => [
                'cursor' => 'pointer',
            ],
        ],
        'series' => [
            [ // new opening bracket
                'type' => 'pie',
                'name' => 'Elements',
                'data' => [
                    ['Firefox', 45.0],
                    ['IE', 26.8],
                    ['Safari', 8.5],
                    ['Opera', 6.2],
                    ['Others', 0.7]
                ],
            ] // new closing bracket
        ],
    ],
]); ?>


    
    <!-- INFO FOR COMPARING AND CHARTING ATTENDANCE - NOTHING YET WORKING -->
    <!-- http://www.yiiframework.com/extension/yii2-highcharts-widget/ 
    http://www.yiiframework.com/doc/guide/1.1/en/database.query-builders
    
    select student from students where studentid in (select studentid from studentmodule where moduleid = @moduleid)
    select module from modules where moduleid in (select moduleid from studentmodule where studentid = @studentid)
    -->
    <!-- http://www.ponomaryov.org/yii-tutorials/handling-statistics-pulling-data-from-yii-and-displaying-with-highcharts/ -->
    <!-- Wrap javascript in div -->
    <div> <script language ="javascript"> $(function () {
    $('#container').highcharts({
        title: {
            text: 'Monthly Average Temperature',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
    }); </script></div>
    
    <!-- http://stackoverflow.com/questions/10817783/using-yii-with-dynamic-data-and-highcharts -->
    <!-- https://github.com/miloschuman/yii2-highcharts -->
    <?php echo Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Fruit Consumption'],
      'xAxis' => [
         'categories' => ['Apples', 'Bananas', 'Oranges']
      ],
      'yAxis' => [
         'title' => ['text' => 'Fruit eaten']
      ],
      'series' => [
          // Add  query result here instead of array??
         ['name' => 'Jane', 'data' => [1, 0, 4]],
         ['name' => 'John', 'data' => [5, 7, 3]]
      ]
   ]
]); ?>
    
      <?php echo Highcharts::widget([
   'options' => [
      'title' => ['text' => 'Attendance'],
      'xAxis' => [
         'categories' => ['Present', 'Absent']
      ],
      'yAxis' => [
         'title' => ['text' => 'Number']
      ],
      'series' => [
          // Add  query result here instead of array??
         ['name' => 'Jane', 'data' => [1, 0]],
         ['name' => 'John', 'data' => [5, 7]]
      ]
   ]
]); ?>
    
    <!-- http://www.highcharts.com/demo/pie-basic 
    "encode data with json_ecode and use in that in plugin?" to get data into pie chart?
    http://www.yiiframework.com/forum/index.php/topic/24743-providing-query-data-to-highchart/-->
   <div> <script language ="javascript">$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Attendance'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Present',
            colorByPoint: true,
            data: [{
                name: 'True',
                y: 70
            }, {
                name: 'False',
                y: 30,
                sliced: true,
                selected: true
            }]  
        }]
    });
}); </script></div>
    
    
    
    <!--?php echo Highcharts::widget([
        'setupOptions' => [
                'global' => ['useUTC' => FALSE],
        ],
        'options' => [
                'chart' => [
                        'type' => 'bar', 
                        'width' => 800,
                        'height' => 700,
                        'zoomType' => 'x',
                ],
                'credits' => ['enabled' => FALSE],
                'title' => ['text' => NULL],
                'xAxis' => [
                        'type' => 'category',
                        'labels' => [
                                'style' => [
                                        'fontSize' => '12px',
                                        'fontFamily' => 'Verdana, sans-serif',
                                ]
                        ]
                ],
                'yAxis' => [
                        'title' => [
                                'enabled' => TRUE,
                                'text' => 'Message Count',
                        ],
                        'min' => 0,
                ],
                'legend' => ['enabled' => FALSE],
                'tooltip' => [
                        'pointFormat' => 'Messages: <b>{point.y:.1f}</b>'
                ],
                'plotOptions' => [
                        'bar' => [
                                'cropThreshold' => 100,
                        ],
                ],
                'series' => [
                        [
                                'name' => 'Messages', 
                                'color' => '#318233',
                                'data' => new SeriesDataHelper($dataProvider, ['feed','count:int']),
                        ],
                ],
        ],
]); ?> -->
    
    <!-- Possible query - find all from student_module where student_id = x and module_id = x, return the id.
    Then use this id to find all in attendance where present = 0.
    
    <!-- ?php echo '<pre>';
print_r(AttendanceController::xAxis());
echo '</pre>';
?> -->
    
    <!-- Object of class yii\db\Query could not be converted to string 
    http://stackoverflow.com/questions/32254582/how-can-i-return-a-query-object-in-yii2 
    $query = (new \yii\db\Query());
    // compose the query
    $query->select('id')
    ->from('student_module')
    ->where(['student_id' => '1'])
    ->limit(10);
       // build and execute the query
    $rows = $query->all(); -->
    
    <!-- http://www.yiiframework.com/doc-2.0/guide-db-active-record.html
    $modules = Studentmodule::find()
    ->where(['student_id' => '1'])
    ->orderBy('id')
    //Array to string conversion error on below line, tried ->asAray()
    ->all(); -->

 <!--// accessing the value 
 foreach ($rows as $row){
    echo $row['id'];
  } 
  
  $provider = new ArrayDataProvider([
    'allModels' => $yourArray,
    'sort' => [
        'attributes' => ['id', 'username', 'email'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
]);
  -->
  
</div>
