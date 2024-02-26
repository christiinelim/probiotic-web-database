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
			<h1>Search Results (by Strain)</h1>
		</article>
	</section>


	<section class='result-container'>
		<?php 
				#check no of strains inputted
				$counter = 1;
				$strainno = '2';

				#check no of strains
				while ($_GET['strain'.$strainno] != null){ 
					$counter = $counter + 1;
					$strainno = (int)$strainno + 1;
					$strainno = strval($strainno);
					if ($counter == 4){
						break;
					}
				}

				#putting searches of strains into array
				if ($counter == 1){
					$search_array = array($_GET['strain1']);
				}elseif ($counter == 2){	
					$search_array = array();
					array_push($search_array, $_GET['strain1'], $_GET['strain2']);
				}elseif ($counter == 3){	
					$search_array = array();
					array_push($search_array, $_GET['strain1'], $_GET['strain2'], $_GET['strain3']);
				}else{	
					$search_array = array();
					array_push($search_array, $_GET['strain1'], $_GET['strain2'], $_GET['strain3'], $_GET['strain4']);
				}

			
				$search1 = mysqli_real_escape_string($conn, $_GET['strain1']); #prevent code injection
				$search2 = mysqli_real_escape_string($conn, $_GET['strain2']); #prevent code injection
				$search3 = mysqli_real_escape_string($conn, $_GET['strain3']); #prevent code injection
				$search4 = mysqli_real_escape_string($conn, $_GET['strain4']); #prevent code injection


				if ($_GET['search_strain'] == 'No'){
					if ($counter == 1){
						$sql = "SELECT * FROM products WHERE productStrain LIKE '%$search_array[0]%'";
					}elseif ($counter == 2){
						$sql = "SELECT * FROM products WHERE (productStrain LIKE '%$search_array[0]%') and (productStrain LIKE '%$search_array[1]%')";
					}elseif ($counter == 3){
						$sql = "SELECT * FROM products WHERE (productStrain LIKE '%$search_array[0]%') and (productStrain LIKE '%$search_array[1]%') and (productStrain LIKE '%$search_array[2]%')";
					}else{
						$sql = "SELECT * FROM products WHERE (productStrain LIKE '%$search_array[0]%') and (productStrain LIKE '%$search_array[1]%') and (productStrain LIKE '%$search_array[2]%') and (productStrain LIKE '%$search_array[3]%')";
					}
				} else{
					if ($counter == 1){
						$sql = "SELECT * FROM products WHERE (productStrain LIKE '%$search_array[0]%') and (noOfProbiotics = 1 or noOfSpecies = 1)";
					}elseif ($counter == 2){
						$sql = "SELECT * FROM products WHERE ((productStrain LIKE '%$search_array[0]%') and (productStrain LIKE '%$search_array[1]%')) and (noOfProbiotics = 2  or noOfSpecies = 2)";
					}elseif ($counter == 3){
						$sql = "SELECT * FROM products WHERE ((productStrain LIKE '%$search_array[0]%') and (productStrain LIKE '%$search_array[1]%') and (productStrain LIKE '%$search_array[2]%')) and (noOfProbiotics = 3  or noOfSpecies = 3)";
					}else{
						$sql = "SELECT * FROM products WHERE ((productStrain LIKE '%$search_array[0]%') and (productStrain LIKE '%$search_array[1]%') and (productStrain LIKE '%$search_array[2]%') and (productStrain LIKE '%$search_array[3]%')) and (noOfProbiotics = 4 or noOfSpecies = 4)";
					}
				}
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
				}else{
					echo "<p>There are no results matching your search.<p/>
						<p>You may try again with a more general search term (eg. search using only the probiotic genus and species).</p>
						<a href='search_strain.php' class='alt-product-search-button'>Search another strain</a>
						</div>";
				}
			
		 ?>
	</section>


<?php include('templates/footer.php'); ?> 

</html>






 
