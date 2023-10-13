<?php 
  error_reporting(1);
  session_set_cookie_params(0);
  
  include("config/config.php");
  session_start();
  
  
  if (!(isset($_SESSION['user']) && $_SESSION['login']==true)) {
      echo '<script type="text/javascript">';
      echo 'window.top.location.href = "index.php"';
      echo '</script>';
      exit();
      
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles/dashboard.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>BBM Admin Dashboard</title>
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
        <h2>Filters</h2>
            <div>
            <div>
                    <label for="start-date">Start Date</label>
                    <?php
                        $query = "SELECT MIN(date_created) as min_date, MAX(date_created) as max_date FROM bbm_data";
                        $result = mysqli_query($conn, $query);
                        
                        while($row=mysqli_fetch_assoc($result)){
                        ?>
                    <input type="date" name="start-date" id="start-date" min="<?php echo $row['min_date'] ?>" max="<?php echo $row['max_date'] ?>">
                    <?php } ?>
                    <br>
                    <label for="end-date">End Date</label>
                    <?php
                        $query = "SELECT MIN(date_created) as min_date, MAX(date_created) as max_date FROM bbm_data";
                        $result = mysqli_query($conn, $query);
                        
                        while($row=mysqli_fetch_assoc($result)){
                        ?>
                    <input type="date" name="start-date" id="end-date" min="<?php echo $row['min_date'] ?>" max="<?php echo $row['max_date'] ?>">
                    <?php } ?>

                

            </div>
                <label for="category">Categories</label>
                <br>
                <select name="category" id="category">
                    <option>Select a Category</option>
                    <?php   
                                $query = "SELECT DISTINCT TRIM(category) as category from bbm_data";
                                $result = mysqli_query($conn, $query); 
                                while($row = mysqli_fetch_assoc($result)){
                                      
                                    ?> 
                                    <option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
                                    <?php } ?> 
                </select>
            </div>
            <div>
                <label for="product">Products</label>
                    <br>
                    <select name="product" id="product">
                        <option>Select a Product</option>
                    </select>
            </div>
       
            <div>
                 <label for="region">Region</label>
                    <br>
                    <select name="region" id="region">
                        <option>Select a Region</option>
                        <?php   
                                $query = "SELECT DISTINCT TRIM(region) as region from bbm_data";
                                $result = mysqli_query($conn, $query); 
                                while($row = mysqli_fetch_assoc($result)){
                                      
                                    ?> 
                                    <option value="<?php echo $row['region'] ?>"><?php echo $row['region'] ?></option>
                                    <?php } ?> 
                    </select>
            </div>
            <div>
                 <label for="market">Market</label>
                    <br>
                    <select name="market" id="market">
                        <option value="null">Select a Market</option>
                    </select>
            </div>
        </div>
        <!-- end of sidebar -->
        <div class="sub-container">

            <div class="input-data">
                <div>
                    <h1><a href="dashboard.php">Admin Dashboard</a></h1>

                </div>
                <div class="queries-download">
                    
                    <button name="export" id="export">Download Queries</button>
                </div>
                <div class="data-input">
                    
                    <button><a href="input_data.php"> Add Products </a></button>
                </div>

                <div class="logout-button">
                    
                    <button><a href="php/logout.php"> Logout </a></button>
                </div>
            </div>
              <!-- input date -->                       
        
            <div class="graphs-container">
                <div class="top-graph">

                    <div class="first-line-graph">
                         <canvas id="chart1"></canvas>
                    </div>
                    <div class="first-bar-graph">
                        <canvas id="chart2"></canvas>
                    </div>
               </div>

               <div class="bottom-graph">
                   <div class="second-line-graph">
                        <canvas id="chart3"></canvas>
                    </div>
                       
                    <div class="second-bar-graph">
                         <canvas id="chart4"></canvas>
                    </div>
                </div>
            </div>
            <!-- end of graph-container-->
            <div class="summary-container">
                <div class="avg-per-reg">
                    <div class="title">
                        <h3>High and Low Price of <span id="product-reg"> Ampalaya </span> in   <span id="filter-region"> NCR</span></h3>
                    </div>
                    <div class="critical">
                        <h5 id="critical-text-region"><h5>
                    </div>
                    <div class="high">
                        <div class="high-price">

                            <h3>Highest Price</h3>
                            <p id="region-highest-price"></p>
                        </div>
                        <div>
                            <h3>Lowest Price</h3>
                            <p id="region-lowest-price"></p>
                        </div>
                    </div>
                </div>
                <div class="avg-per-market">
                    <div class="title">
                        <h3>High and Low Price of  <span id="product-market"> Ampalaya </span>  in   <span id="filter-market"> Pasay City Wet Market</span></h3>
                    </div>
                    <div class="critical">
                        <h5 id="critical-text-market"><h5>
                    </div>
                    <div class="high">
                        <div class="high-price">

                             <h3>Highest Price</h3>
                            <p id="market-highest-price"></p>
                        </div>
                        <div>
                            <h3>Lowest Price</h3>
                            <p id="market-lowest-price"></p>
                         </div>
                    </div>
                </div>
                
                <div class="avg-per-market">
                    <div class="title">
                        <h3>High and Low Volume of <span id="product-volume"> Ampalaya </span> in <span id="filter-volume"> Pasay City Wet Market</span></h3>
                    </div>
                    <div class="critical">
                        <h5 id="critical-text-volume"><h5>
                    </div>
                    <div class="high">
                    <div class="high-price">

                        <h3>Highest Volume</h3>
                        <p id="market-highest-volume"></p>
                    </div>
                    <div>
                        <h3>Lowest Volume</h3>
                        <p id="market-lowest-volume"></p>
                    </div>
                 </div>
                </div>
            </div>
    </div>

    <script>
    $(document).ready(function(){     

        
        $("#export").click(function(){
            var selectedCategory  = $('#category').val(); 
            var selectedProduct = $('#product').val(); 
            var startDate = $('#start-date').val(); 
            var endDate = $('#end-date').val();
            var selectedRegion = $('#region').val();
            var selectedMarket = $('#market').val();

            $.ajax({
                    url: 'php/queriesDownload.php', // Replace with your JSON data source
                    data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                    method: 'GET',
                    success: function(jsonData) {
                        var parsedData = JSON.parse(jsonData);
                          // Convert JSON to CSV
                         var csvContent = "data:text/csv;charset=utf-8,";
                        var header = Object.keys(parsedData[0]).join(",") + "\r\n";
                        csvContent += header;
                        parsedData.forEach(function(row) {
                            var values = Object.values(row).join(",") + "\r\n";
                            csvContent += values;
                        });

                        // Create a download link
                        var encodedUri = encodeURI(csvContent);
                        var link = document.createElement("a");
                        link.setAttribute("href", encodedUri);
                        link.setAttribute("download", "exported_data.csv");
                        document.body.appendChild(link);

                        // Trigger the download
                        link.click();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
    

        });
     
        var ctx = document.getElementById('chart1').getContext('2d');
                var chart1 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Prices in Market',
                            data:[],
                            backgroundColor: '',
                            borderColor: '',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        plugins :{
                            title:{
                                display: true, 
                                text: "Prices Of Product in Market",
                                font: {
                                    size:24
                                }
                    
                            }
                        
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                            
                            }
                        },

                        responsive: true, // Enable responsive mode
                        maintainAspectRatio: false
                    }
                });
            
            
    var ctx = document.getElementById('chart2').getContext('2d');
                var chart2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: [{
                            axis: 'y',
                            label: 'Volume',
                            data:[],
                            backgroundColor: '',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        indexAxis:'y',
                        plugins :{
                            legend:{
                                display: false
                            },
                            title:{
                                display: true, 
                                text: "Volume of Product in the Market",
                                font: {
                                    size:24
                                }
                    
                            }
                        
                        },
                        scales: {
                            y: {
                                beginAtZero: false
                            }
                        },

                        responsive: true, // Enable responsive mode
                        maintainAspectRatio: false
                    }
                });


                var ctx = document.getElementById('chart3').getContext('2d');
                var chart3 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Prices in Region',
                            data: [],
                            backgroundColor: '',
                            borderColor: '',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        plugins :{
                            title:{
                                display: true, 
                                text: "Prices of Product in Region",
                                font: {
                                    size:24
                                }
                    
                            }
                        
                        },
                        scales: {
                            y: {
                                beginAtZero: false
                            }
                        },

                        responsive: true, // Enable responsive mode
                        maintainAspectRatio: false
                    }
                });

                var ctx = document.getElementById('chart4').getContext('2d');
                var chart4 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets: [{
                            axis: 'y',
                            label: 'Average Volume',
                            data: [],
                            backgroundColor:  [
                            "#C7E498", "#FFECB3", "#A7C8E3", "#CBBE9E", "#FFD9C7",
                            "#BFD9FF", "#D4E6F9", "#B5BAD6", "#A1EFD7", "#C9F7E7",
                            "#FFB5B5", "#FFDFA6", "#FFD0A1", "#FFBBB2", "#BEBEBE",
                            "#D9C7E4", "#FFCCBE", "#C4C6D5", "#BACDE8", "#D8EDC7",
                            "#C2A77B", "#8EC59E", "#CDB393", "#DCCCA8", "#A5B47E",
                            "#E3CF8E", "#B7CFAF", "#C7B6A0", "#E3A5CC", "#B4C484"
                            ],
                            borderColor: '',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        indexAxis:'y',
                        plugins :{
                            legend:{
                                display: false
                            },
                            title:{
                                display: true, 
                                text: "Volume of Product in the Region",
                                font: {
                                    size:24
                                }
                    
                            }
                        
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                    
                        responsive: true, // Enable responsive mode
                        maintainAspectRatio: false
                    }
                });

        $('#category').on('change', function(){

            var selectedCategory  = $('#category').val(); 


            $.ajax({
                url:'php/fetchProducts.php', 
                method: 'GET', 
                data:{category:selectedCategory},
                success: function(data){

                    $('#product').empty();
                    var parsedData = JSON.parse(data);
                    
                    var product = parsedData.map(function(item){
                        return item.products;
                    });
                    $('#product').append(`<option>Select a Product</option>`)
                
                    for(var products of product){
                        $('#product').append(`<option value="${products}">
                                ${products} 
                            </option>`);
                    }

                },
                error: function() {
                    // If there's an error, display an error message
                    $('#test').html('<p>An error occurred while fetching data.</p>');
                }

            })

        })
        $('#region').on('change', function(){

            var selectedRegion = $('#region').val(); 


            $.ajax({
                url:'php/fetchMarket.php', 
                method: 'GET', 
                data:{region:selectedRegion},
                success: function(data){

                    $('#market').empty();
                    var parsedData = JSON.parse(data);
                    
                    var market = parsedData.map(function(item){
                        return item.market;
                    });
                    $('#market').append(`<option>Select a Market</option>`)
                
                    for(var markets of market){
                        $('#market').append(`<option value="${markets}">
                                ${markets}
                            </option>`);
                    }

                },
                error: function() {
                    // If there's an error, display an error message
                    $('#test').html('<p>An error occurred while fetching data.</p>');
                }

            })

        })
        $.ajax({
                url:'php/allMarket.php', 
                method: 'GET', 
                success: function(result){
                 
                    var parsedData = JSON.parse(result); 
                    var date = parsedData.map(function(item){
                        var jsDate = new Date(item.date_created);
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var formattedDate = jsDate.toLocaleDateString('en-US', options);
                        return formattedDate; 
                    });
                    var price = parsedData.map(function(item){
                    return item.product_price;
                })

                    var volume = parsedData.map(function(item){
                        return item.product_qty;
                    })
                    var labels = parsedData.map(function(item){
                        return item.shop_name;
                    })
                    
                

                    chart1.data.labels = date; 
                    chart1.data.datasets[0].data = price; 
                    chart1.options.plugins.title.text = "Prices of Ampalaya in the Pasay City Wet Market";
                    chart2.data.labels = date; 
                    chart2.data.datasets[0].data = volume;
                    chart2.options.plugins.title.text = "Volume of Ampalaya in the Pasay City Wet Market";
                   
                    if(Number(price[price.length - 1]) > Number(price[price.length-2])){
                       chart1.data.datasets[0].backgroundColor = 'rgb(255, 69, 0)';
                       chart1.data.datasets[0].borderColor = 'rgb(255, 69, 0)';
                       $('#critical-text-market').text("Price Increasing!");
                       $('#critical-text-market').css("color", "red");
                       
                    }else{
                        chart1.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                        chart1.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                        $('#critical-text-market').text("Price Decreasing!");
                        $('#critical-text-market').css("color", "green");
                       
                    }

                    if(Number(volume[volume.length - 1]) > Number(volume[volume.length-2])){
                        chart2.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                        chart2.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                        $('#critical-text-volume').text("Volume Increasing!");
                        $('#critical-text-volume').css("color", "green");
                    }else if(Number(volume[volume.length - 1]) == Number(volume[volume.length-2])){
                        chart2.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                        chart2.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                        $('#critical-text-volume').text("No changes");
                        $('#critical-text-volume').css("color", "green");
                    }else{
                        chart2.data.datasets[0].borderColor = 'rgb(255, 69, 0)';
                        chart2.data.datasets[0].backgroundColor = 'rgb(255, 69, 0)';
                        $('#critical-text-volume').text("Volume Decreasing!");
                        $('#critical-text-volume').css("color", "red");
                    }
                    chart1.update();
                    chart2.update();
    
                    $('#market-highest-price').text("₱" + Math.max(...price));
                    $('#market-lowest-price').text("₱" + Math.min(...price));


                    $('#market-highest-volume').text( Math.max(...volume));
                    $('#market-lowest-volume').text( Math.min(...volume));
                
                
                    
                },
                error: function() {
                    // If there's an error, display an error message
                    $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                }
                
            });


            $.ajax({
                url:'php/allRegion.php', 
                method: 'GET', 
                success: function(result){
                 
                    var parsedData = JSON.parse(result); 
                    var date = parsedData.map(function(item){
                        var jsDate = new Date(item.date_created);
                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                        var formattedDate = jsDate.toLocaleDateString('en-US', options);
                        return formattedDate; 
                    })
                    var price = parsedData.map(function(item){
                    return item.product_price;
                })
                
                    var volume = parsedData.map(function(item){
                        return item.product_qty;
                    })
                    var labels = parsedData.map(function(item){
                        return item.shop_name;
                    })
                
                    chart3.data.labels = labels; 
                    chart3.data.datasets[0].data = price; 
                    chart3.options.plugins.title.text = " Prices of Ampalaya in NCR";
                    chart4.data.labels = labels; 
                    chart4.data.datasets[0].data = volume;
                    chart4.options.plugins.title.text = "Volume of Ampalaya in NCR";
                

                    if(Number(price[price.length - 1]) > Number(price[price.length-2])){
                        chart3.data.datasets[0].backgroundColor = 'rgb(255, 69, 0)';
                        chart3.data.datasets[0].borderColor = 'rgb(255, 69, 0)';
                        $('#critical-text-region').text("Price Increasing!");
                        $('#critical-text-region').css("color", "Red");
                    }else{
                        chart3.data.datasets[0].backgroundColor = 'rgba(75, 192, 192, 0.2)';
                        chart3.data.datasets[0].borderColor = 'rgba(75, 192, 192, 0.2)';
                        $('#critical-text-region').text("Price Decreasing!");
                        $('#critical-text-region').css("color", "green");
                    }

               

                    chart3.update();
                    chart4.update();

                    $('#region-highest-price').text("₱" + Math.max(...price));
                    $('#region-lowest-price').text("₱" + Math.max(...price));
                
                    
                },
                error: function() {
                    // If there's an error, display an error message
                    $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                }
                
            });

        $('#market, #product').on('change', function(){
         
                var selectedCategory  = $('#category').val(); 
                var selectedProduct = $('#product').val(); 
                var startDate = $('#start-date').val(); 
                var endDate = $('#end-date').val();
                var selectedRegion = $('#region').val();
                var selectedMarket = $('#market').val();
                var x = new Date(startDate); 
                var y = new Date(endDate); 
                var difference = Math.abs(y.getTime() - x.getTime()) / (1000 * 60 * 60 *24);



                if(startDate < endDate || startDate == endDate){
                    if(difference < 30){
                                    $.ajax({
                                    url:'php/marketPrice.php', 
                                    method: 'GET', 
                                    data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                                    success: function(data){
                                    
                                        var parsedData = JSON.parse(data); 
                                        var labels = parsedData.map(function(item){
                                        var jsDate = new Date(item.date_created);
                                        var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                        var formattedDate = jsDate.toLocaleDateString('en-US', options);
                                            return formattedDate; 
                                        })
                                        var price = parsedData.map(function(item){
                                        return item.product_price;
                                    })
                                        chart1.data.labels = labels; 
                                        chart1.data.datasets[0].data = price; 
                        
                                        if(Number(price[price.length - 1]) > Number(price[price.length-2])){
                                            chart1.data.datasets[0].backgroundColor = 'rgb(255, 69, 0)';
                                            chart1.data.datasets[0].borderColor = 'rgb(255, 69, 0)';
                                            $('#critical-text-market').text("Price Increasing!");
                                            $('#critical-text-market').css("color", "red");
                                        }else if (Number(price[price.length - 1]) < Number(price[price.length-2])){
                                            chart1.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                                            chart1.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                                            $('#critical-text-market').text("Price Decreasing!");
                                            $('#critical-text-market').css("color", "green");

                                        }else{
                                            chart1.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                                            chart1.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                                            $('#critical-text-market').text("Nothing Changed!");
                                            $('#critical-text-market').css("color", "green");
                                        }

                                        chart1.update();
                                        
                                    },
                                    error: function() {
                                        // If there's an error, display an error message
                                        $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                    }
                                    
                                });

                                    $.ajax({
                                        url:'php/regionPrice.php', 
                                        method: 'GET', 
                                        data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                                        success: function(data){
                                            var parsedData = JSON.parse(data); 
                                            var labels = parsedData.map(function(item){
                                                var jsDate = new Date(item.date_created);
                                                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                                var formattedDate = jsDate.toLocaleDateString('en-US', options);
                                                return formattedDate; 
                                            })
                                            var price = parsedData.map(function(item){
                                                return item.product_price;
                                            })

                                            var market = parsedData.map(function(item){
                                                return item.shop_name;
                                            })

                                            
                                            chart3.data.labels = market; 
                                            chart3.data.datasets[0].data = price; 
                                      
                                            if(Number(price[price.length-1]) > Number(price[price.length-2])){
                                                chart3.data.datasets[0].backgroundColor = 'rgb(255, 69, 0)';
                                                chart3.data.datasets[0].borderColor = 'rgb(255, 69, 0)';
                                                $('#critical-text-region').text("Price Increasing!");
                                                $('#critical-text-region').css("color", "Red");
                                            }else if(Number(price[price.length-1])  < Number(price[price.length-2])){
                                                chart3.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                                                chart3.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                                                $('#critical-text-region').text("Price Decreasing!");
                                                $('#critical-text-region').css("color", "green");
                        
                                            }else{
                                                chart3.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                                                chart3.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                                                $('#critical-text-region').text("Nothing Changed!");
                                                $('#critical-text-region').css("color", "green");
                                            }
                                            
                                            chart3.update();
                                        },
                                        error: function() {
                                            // If there's an error, display an error message
                                            $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                        }

                                    });

                                    $.ajax({
                                        url:'php/volMarket.php', 
                                        method: 'GET', 
                                        data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                                        success: function(data){
                                            var parsedData = JSON.parse(data); 
                                            var labels = parsedData.map(function(item){
                                            var jsDate = new Date(item.date_created);
                                            var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                            var formattedDate = jsDate.toLocaleDateString('en-US', options);
                                                return formattedDate; 
                                            })
                                            var volume = parsedData.map(function(item){
                                                return item.product_qty;
                                            })

                                            
                                            chart2.data.labels = labels; 
                                            chart2.data.datasets[0].data = volume; 
                                        

                                            if(Number(volume[volume.length - 1]) > Number(volume[volume.length-2])){
                                                chart2.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                                                chart2.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                                                $('#critical-text-volume').text("Volume Increasing!");
                                                $('#critical-text-volume').css("color", "green");
                                            }else if (Number(volume[volume.length - 1])  <  Number(volume[volume.length-2])){
                                                chart2.data.datasets[0].backgroundColor = 'rgb(255, 69, 0)';
                                                chart2.data.datasets[0].borderColor = 'rgb(255, 69, 0)';
                                                $('#critical-text-volume').text("Volume Decreasing!");
                                                $('#critical-text-volume').css("color", "green");
                                            }else{
                                                chart2.data.datasets[0].backgroundColor = 'rgb(0, 128, 0)';
                                                chart2.data.datasets[0].borderColor = 'rgb(0, 128, 0)';
                                                $('#critical-text-volume').text("Nothing Changed!");
                                                $('#critical-text-volume').css("color", "green");
                                            }

                                            chart2.update();
                                    
                                        },
                                        error: function() {
                                            // If there's an error, display an error message
                                            $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                        }

                                    });


                                    $.ajax({
                                        url:'php/volRegion.php', 
                                        method: 'GET', 
                                        data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                                        success: function(data){
                                            var parsedData = JSON.parse(data); 
                                            var dates = parsedData.map(function(item){
                                            var jsDate = new Date(item.date_created);
                                            var options = { year: 'numeric', month: 'long', day: 'numeric' };
                                            var formattedDate = jsDate.toLocaleDateString('en-US', options);
                                                return formattedDate; 
                                            })
                                            var price = parsedData.map(function(item){
                                                return item.product_qty;
                                            })
                                            
                                            var labels = parsedData.map(function(item){
                                                return item.shop_name;
                                            })
                                            chart4.data.labels = labels; 
                                            chart4.data.datasets[0].data = price; 
                                            chart1.options.plugins.title.text = "Price of " + selectedProduct + " in " + selectedMarket;
                                            chart2.options.plugins.title.text = "Volume of " + selectedProduct + " in " + selectedMarket;
                                            chart3.options.plugins.title.text = "Price of " + selectedProduct + " in " + selectedRegion;
                                            chart4.options.plugins.title.text = "Volume of " + selectedProduct + " in " + selectedRegion;
                                            chart1.update();
                                            chart2.update();
                                            chart3.update();
                                            chart4.update();
                                            
                                            
                                        },
                                        error: function() {
                                            // If there's an error, display an error message
                                            $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                        }

                                    });
                            
                            $.ajax({
                            url:'php/fetchAvgMarket.php', 
                            method: 'GET', 
                            data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                            success: function(data){
                                var parsedData = JSON.parse(data); 
                                
                                var product_name = parsedData.map(function(item){
                                    return item.product_name;
                                    
                                });

                                var market_name = parsedData.map(function(item){
                                    return item.shop_name;
                                    
                                });

                                var mar_avg_price = parsedData.map(function(item){
                                    return item.avg_price;
                                    
                                });
                                
                                var max_price = parsedData.map(function(item){
                                    return item.high_price;
                                    
                                });
                                
                                var min_price = parsedData.map(function(item){
                                    return item.low_price;
                                });

                                    
                                    $('#product-market').text(product_name);
                                    $('#filter-market').text(market_name);  
                                    $('#market-highest-price').text("₱" + max_price);
                                    $('#market-lowest-price').text("₱" + min_price);
                                    
                                
                                    },
                                    error: function() {
                                        // If there's an error, display an error message
                                        $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                    }

                                });
                            $.ajax({
                                url:'php/fetchAllRegAvggPrice.php', 
                                method: 'GET', 
                                data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                                success: function(data){
                                var parsedData = JSON.parse(data); 
                                
                                var product_name = parsedData.map(function(item){
                                    return item.product_name;
                                    
                                });

                                var region= parsedData.map(function(item){
                                    return item.region;
                                    
                                });

                                var mar_avg_price = parsedData.map(function(item){
                                    return item.avg_price;
                                    
                                });
                                
                                var max_price = parsedData.map(function(item){
                                    return item.high_price;
                                    
                                });
                                
                                var min_price = parsedData.map(function(item){
                                    return item.low_price;
                                });


                                    $('#product-reg').text(product_name);
                                    $('#filter-region').text(region);  
                                    $('#region-highest-price').text("₱" +max_price);
                                    $('#region-lowest-price').text("₱" +min_price);
                                },
                                error: function() {
                                    // If there's an error, display an error message
                                    $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                }
                                });

                            $.ajax({
                            url:'php/fetchAvgMarket.php', 
                            method: 'GET', 
                            data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                            success: function(data){;
                                
                                var parsedData = JSON.parse(data); 
                                
                                var product_name = parsedData.map(function(item){
                                    return item.product_name;
                                    
                                });

                                var market_name = parsedData.map(function(item){
                                    return item.shop_name;
                                    
                                });

                                var mar_avg_vol = parsedData.map(function(item){
                                    return item.product_qty;
                                    
                                });
                                
                                var max_vol = parsedData.map(function(item){
                                    return item.high_vol;
                                    
                                });
                                
                                var min_vol = parsedData.map(function(item){
                                    return item.low_vol;
                                });
                                    $('#product-volume').text(product_name);
                                    $('#filter-volume').text(market_name);  
                                    $('#market-highest-volume').text(max_vol);
                                    $('#market-lowest-volume').text( min_vol);
                                    },
                                    error: function() {
                                        // If there's an error, display an error message
                                        $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                                    }

                                });

                            //     $.ajax({
                            // url:'php/fetchAvgMarket.php', 
                            // method: 'GET', 
                            // data:{category:selectedCategory, product: selectedProduct, firstDate: startDate, lastDate:endDate, region: selectedRegion, market: selectedMarket},
                            // success: function(data){;
                                
                            //     var parsedData = JSON.parse(data); 
                                
                            //     var product_name = parsedData.map(function(item){
                            //         return item.product_name;
                                    
                            //     });

                            //     var market_name = parsedData.map(function(item){
                            //         return item.shop_name;
                                    
                            //     });

                            //     var mar_avg_vol = parsedData.map(function(item){
                            //         return item.product_qty;
                                    
                            //     });
                                
                            //     var max_vol = parsedData.map(function(item){
                            //         return item.high_vol;
                                    
                            //     });
                                
                            //     var min_vol = parsedData.map(function(item){
                            //         return item.low_vol;
                            //     });
                            //         $('#product-name-market-vol').text(product_name);
                            //         $('#market-name-vol').text(market_name);  
                            //         $('#avg-volume-market').text(mar_avg_vol); 
                            //         $('#market-highest-volume').text(max_vol);
                            //         $('#market-lowest-volume').text( min_vol);
                            //         },
                            //         error: function() {
                            //             // If there's an error, display an error message
                            //             $('#sec-section').html('<p>An error occurred while fetching data.</p>');
                            //         }

                            // });
                    }else{
                        alert("The maximum limit of date filter is 30 days");
                    }
                   

            }else{
                    alert("Please fix the order of dates!")
            }
     }); 

 });
  


</script>
</body>
</html>