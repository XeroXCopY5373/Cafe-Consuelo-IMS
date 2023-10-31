<?php
require_once('includes/load.php');
$dataPointsBar = array();
$dataPointsPie = array();
$dataPointsLine = array();
$dataPointsLineMonthly = array();
$dataPointsLineDaily = array();

// Retrieve sales data for the bar chart
$queryBar = "SELECT p.name AS product, SUM(s.qty) AS total_qty
          FROM sales s
          LEFT JOIN products p ON s.product_id = p.id
          GROUP BY p.id, p.name
          ORDER BY total_qty DESC LIMIT 10";
$resultBar = $db->query($queryBar);

if ($resultBar) {
    while ($row = $db->fetch_assoc($resultBar)) {
        $dataPointsBar[] = array("label" => $row['product'], "y" => (int)$row['total_qty']);
    }
}

// Retrieve category sales data
$queryCategorySales = "SELECT c.name AS category, SUM(s.qty) AS total_sales
                      FROM sales s
                      LEFT JOIN products p ON s.product_id = p.id
                      LEFT JOIN categories c ON p.categorie_id = c.id
                      GROUP BY c.id, c.name";
$resultCategorySales = $db->query($queryCategorySales);

if ($resultCategorySales) {
    while ($row = $db->fetch_assoc($resultCategorySales)) {
        $dataPointsPie[] = array("label" => $row['category'], "y" => (int)$row['total_sales']);
    }
}

// Fetch "Sales by Date" data from the database
$querySalesByDate = "SELECT UNIX_TIMESTAMP(date) AS x, SUM(qty) AS y FROM sales GROUP BY DATE(date)";
$resultSalesByDate = $db->query($querySalesByDate);
if ($resultSalesByDate) {
    while ($row = $db->fetch_assoc($resultSalesByDate)) {
        $dataPointsLine[] = array("x" => (int)$row['x'], "y" => (int)$row['y']);
    }
}

// Fetch "Monthly Sales" data from the database
$queryMonthlySales = "SELECT UNIX_TIMESTAMP(date) AS x, SUM(qty) AS y FROM sales GROUP BY YEAR(date), MONTH(date)";
$resultMonthlySales = $db->query($queryMonthlySales);
if ($resultMonthlySales) {
    while ($row = $db->fetch_assoc($resultMonthlySales)) {
        $dataPointsLineMonthly[] = array("x" => (int)$row['x'], "y" => (int)$row['y']);
    }
}

// Fetch "Daily Sales" data from the database
$queryDailySales = "SELECT UNIX_TIMESTAMP(date) AS x, SUM(qty) AS y FROM sales GROUP BY DATE(date)";
$resultDailySales = $db->query($queryDailySales);
if ($resultDailySales) {
    while ($row = $db->fetch_assoc($resultDailySales)) {
        $dataPointsLineDaily[] = array("x" => (int)$row['x'], "y" => (int)$row['y']);
    }
}

?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
  var barChart = new CanvasJS.Chart("barContainer", {
    animationEnabled: true,
    theme: "dark2",
    title: {
      text: "Top 10 Best Selling Products"
    },
    axisY: {
      title: "Total Quantity Sold"
    },
    data: [{
      type: "column",
      dataPoints: <?php echo json_encode($dataPointsBar, JSON_NUMERIC_CHECK); ?>
    }]
  });
  barChart.render();

  var pieChart = new CanvasJS.Chart("pieContainer", {
    animationEnabled: true,
    theme: "dark2",
    title: {
      text: "Category Distribution"
    },
    data: [{
      type: "pie",
      showInLegend: true,
      toolTipContent: "{label}: <strong>#percent% (#y)</strong>",
      indexLabel: "{label} - #percent%",
      dataPoints: <?php echo json_encode($dataPointsPie, JSON_NUMERIC_CHECK); ?>
    }]
  });
  pieChart.render();

  var lineChart = new CanvasJS.Chart("lineContainer", {
    animationEnabled: true,
    theme: "dark2",
    title: {
      text: "Sales Over Time"
    },
    axisX: {
  title: "Date",
  valueFormatString: "DD MMM YYYY",
  labelFormatter: function (e) {
    var date = new Date(e.value);
    if (date.getFullYear() >= 2023) {
      return new Intl.DateTimeFormat('en-US', {
        month: 'short',
        year: 'numeric',
      }).format(date);
    }
    return null; // Return null for dates before 2023
  }
},




    axisY: {
      title: "Sales Amount",
    },
    legend: {
      cursor: "pointer",
      itemclick: function (e) {
        toggleDataSeries(e.dataSeries);
      }
    },
    data: [
      {
        type: "spline",
        showInLegend: true,
        name: "Sales by Date",
        dataPoints: <?php echo json_encode($dataPointsLine, JSON_NUMERIC_CHECK); ?>
      },
      {
        type: "spline",
        showInLegend: true,
        name: "Monthly Sales",
        dataPoints: <?php echo json_encode($dataPointsLineMonthly, JSON_NUMERIC_CHECK); ?>
      },
      {
        type: "spline",
        showInLegend: true,
        name: "Daily Sales",
        dataPoints: <?php echo json_encode($dataPointsLineDaily, JSON_NUMERIC_CHECK); ?>
      }
    ]
  });
  lineChart.render();

  // Function to toggle data series visibility
  function toggleDataSeries(dataSeries) {
    if (typeof dataSeries.visible === "undefined" || dataSeries.visible) {
      dataSeries.visible = false;
    } else {
      dataSeries.visible = true;
    }
    lineChart.render();
  }
}

</script>
</head>
<body>
<div id="barContainer" style="height: 370px; width: 60%; float: left; margin-right: 5%; margin-bottom: 2%;"></div>
<div id="pieContainer" style="height: 370px; width: 35%; float: left;"></div>
<div id="lineContainer" style="height: 370px; width: 100%; float: left;"></div>
</body>
</html>
