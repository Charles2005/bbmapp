<?php 

include("config/config.php") 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/input_data.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Input Products</title>
</head>
<body>
    <div class="main-container">

        <div class="sub-container">
            <div class="inputs">
                <form action="php/inputDataAction.php" method="POST">
                <h2>Add New Product</h2>
                    <label for="category">Category:</label>
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
                                
                                <label for="product"> Product: </label>
                                
                                <select name="product" id="product" required>

                                </select>
                        
                        
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" step="0.1" required>
                        
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" required>
                        
                        <label for="region">Region:</label>
                        <select name="region" id="region" required>
                        <option>Select a Region</option>
                        <?php   
                                $query = "SELECT DISTINCT TRIM(region) as region from bbm_data";
                                $result = mysqli_query($conn, $query); 
                                while($row = mysqli_fetch_assoc($result)){
                                    
                                    ?> 
                                    <option value="<?php echo $row['region'] ?>"><?php echo $row['region'] ?></option>
                                    <?php } ?> 
                                    
                                </select>

                                <label for="Market"> Market: </label>
                                <select name="market" id="market" required>
                                    </select>
                                    
        
                <button type="submit" name='add' id='add'>Add</button>
             </form>
         </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
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


    })

    $(document).ready(function(){
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


    })

    </script> 
</body>
</html>