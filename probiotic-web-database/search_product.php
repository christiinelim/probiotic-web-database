<?php include 'dbconnect.php';?>
<!DOCTYPE html>
<html>

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

<body>
    <section class="pageTopContent" id="search-header">

        <article>
            <h2>Search by Product</h2>
            <p>Please type in the name of the product you want to search for in the field below.</p>
            <p>Tip: Keep your search terms general (eg. by just searching for the brand name of a product) and avoid searching with many words.</p>
        </article>

    </section>

    <section class="searchform">
        <?php
            $sql_products = "SELECT brandName from products";
            
            $sql_products1 = mysqli_query($conn, $sql_products);

            $results_array = [];

            while ($row = mysqli_fetch_assoc($sql_products1)){
                array_push($results_array, $row['brandName']);
            }
            sort($results_array);

            echo"
                <div class='wrapper'>
                    <div class='search-input'>
                        <form action='results_product.php' method='POST'>
                            <input id='product_search' type='text' name='search' placeholder='Search' required>
                            <button type='submit' name='submit-search'>Submit</button>
                            <div class='autocom-box'>
                            </div>
                        </form>
                    </div>
                </div>
            ";
        ?>
    </section>

    <script>
        var obj = <?php echo json_encode($results_array); ?>;
    </script>
    <script src="js/script.js"></script>
    <script src="js/products_suggestions.js"></script>

</body>

<?php include('templates/footer.php'); ?>

</html>