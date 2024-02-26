<?php 
	include 'dbconnect.php';
 ?>

<!DOCTYPE html>
<html>

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

	<section class="pageContent">
		<article>
			<h1>Search Results (by Product)</h1>
		</article>
	</section>


	<section class='result-container'>
		<?php 

			if (isset($_POST['submit-search'])) {
				$search = mysqli_real_escape_string($conn, $_POST['search']); #prevent code injection
				$sql = "SELECT * FROM products WHERE (brandName LIKE '%$search%') OR (productStrain LIKE '%$search%')";
				$result = mysqli_query($conn, $sql);
				$queryResult = mysqli_num_rows($result);

				echo "<div class='result-header'><p>There are ".$queryResult." result(s).</p>";

				if ($queryResult > 0){

					echo "<p><b>Note: The order of products in the list below are not sorted in any particular manner.</b> Do exercise professional judgement while assessing the information.</p>
						</div>

						<div class = 'result-box-product-container'>";

					while($row = mysqli_fetch_assoc($result)){
						echo "
						<div class='result-box-product'>
							<a href = '".$row['imageLink']."'>
								<img src = '".$row['imageLink']."'>
							</a>
							<h2>".$row['brandName']."</h2>
							<ul class='resultsinfo-product'>
								<li>Marketed Indication(s): ".$row['marketedIndications']."</li>
							    <li>Probiotic Strain: ".$row['productStrain']." <i>(Contains ".$row['noOfProbiotics']." type(s) of probiotics)</i></li>
								<li>Total Strength: ".$row['totalStrength']."</li>
								<li>Dosage Form: ".$row['dosageForm']."</li>
								<li>Contains Prebiotics: ".$row['prebiotic']."</li>
							</ul>
							<a href='details_full.php?id=".$row['product_id']."' class='details-button'>Full Details</a>
						</div>";
					}

					echo "</div>";

				} else {
					echo "<p>There are no results matching your search.<p/>
						<p>You may try again with a more general search term (eg. search using only the brand name of a product). If possible, try to limit your search to just 1 word.</p>
						<a href='search_product.php' class='alt-product-search-button'>Find another product</a>
						</div>";
				}

			}
			
		 ?>
	</section>


<?php include('templates/footer.php'); ?> 

</html>