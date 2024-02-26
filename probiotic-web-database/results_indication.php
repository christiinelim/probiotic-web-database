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
			<h1>Search Results (by Indication)</h1>
			<!-- 
			<p>Lorem ipsum dolor sit amet, nonumes voluptatum mel ea, cu case ceteros cum. Novum commodo malorum vix ut. Dolores consequuntur in ius, sale electram dissentiunt quo te. Cu duo omnes invidunt, eos eu mucius fabellas. Stet facilis ius te, quando voluptatibus eos in. Ad vix mundi alterum, integre urbanitas intellegam vix in.</p> -->
		</article>
	</section>
 

	<section class='result-container'>
		<?php 

			$indication = $_GET['search_indication'];
			$usage = $_GET['search_usage'];
			$agegrp = $_GET['search_agegroup'];

			// name of indication selected
			$sql_indication_query = "SELECT * FROM indications WHERE indication_id ='".$indication."'";
			$sql_indication_query_db_connect = mysqli_query($conn, $sql_indication_query);
			$indication_name = mysqli_fetch_assoc($sql_indication_query_db_connect);

			// calling all unique products
			$sql_prod = "
			SELECT * FROM products WHERE products.product_id IN (
			SELECT bridge_product_id FROM psbridge WHERE psbridge.bridge_u_study_id IN (
			SELECT u_study_id FROM studies WHERE (studyIndication_id = '".$indication."' AND studyUse = '".$usage."' AND studyAgeGroup = '".$agegrp."') 
			)
			)
			";
			$result_prod = mysqli_query($conn, $sql_prod);   #product info only

			// no. of results
			$queryResult = mysqli_num_rows($result_prod);
			echo "<div class='result-header'><p>There are ".$queryResult." result(s).</p>";
 
			if ($queryResult != 0){

				echo "

				<p>The following are product(s) containing probiotic strain(s) that have published evidence for the <b>".$usage." of ".$indication_name['indication']." in ".$agegrp."</b>.</p>
				<p><b>Note: The order of products in the list below are not sorted in any particular manner.</b> Do exercise professional judgement while assessing the information.</p>
				</div>

				<div class='result-box-product-container'>";

				while($row_prod = mysqli_fetch_assoc($result_prod)){
					
					// displaying product information
					echo "<div class='result-box-product'>
						<a href = '".$row_prod['imageLink']."'>
							<img src = '".$row_prod['imageLink']."'>
						</a>
						<h2>".$row_prod['brandName']."</h2>
						<br>					
						<h5>Key Product Details:</h5>
						<ul class='resultsinfo-indication'>
							<li>Marketed Indication(s): ".$row_prod['marketedIndications']."</li>
							<li>Probiotic Strain: ".$row_prod['productStrain']." <i>(Contains ".$row_prod['noOfProbiotics']." type(s) of probiotics)</i></li>
							<li>Total Strength: ".$row_prod['totalStrength']."</li>
							<li>Dosage Form: ".$row_prod['dosageForm']."</li>
							<li>Contains Prebiotics: ".$row_prod['prebiotic']."</li>
						</ul>";

					$counter_total = 0;
					$counter_effective = 0;
					$counter_uncertain = 0;
					$counter_ineffective = 0;

					// calling all relevant study info
					$sql_full = "
					SELECT studyConclusion FROM studies WHERE (studies.u_study_id IN(
					SELECT bridge_u_study_id FROM psbridge WHERE bridge_product_id = '".$row_prod['product_id']."') AND (studyIndication_id = '".$indication."') AND (studyUse = '".$usage."') AND (studyAgeGroup = '".$agegrp."'))
					";
					$result_full = mysqli_query($conn, $sql_full);

					while ($row_full = mysqli_fetch_assoc ($result_full)){
						if ($row_full['studyConclusion'] == 'Efficacious'){
							$counter_total += 1;
							$counter_effective += 1;
						} elseif ($row_full['studyConclusion'] == 'Uncertain'){
							$counter_total += 1;
							$counter_uncertain += 1;
						} elseif ($row_full['studyConclusion'] == 'Inefficacious'){
							$counter_total += 1;
							$counter_ineffective += 1;
						} else{continue;}
					}
					
		//			$sql_full = "
		//			SELECT p.product_id, s.studyConclusion
		//			FROM psbridge ps 
		//				JOIN studies s ON ps.bridge_u_study_id = s.u_study_id 
		//				JOIN products p ON ps.bridge_product_id = p.product_id
		//			WHERE (s.studyIndication_id = '".$indication."' AND s.studyUse = '".$usage."' AND s.studyAgeGroup = '".$agegrp."')
		//			ORDER BY s.ocebmLevel
		//			";
		//			$result_full = mysqli_query($conn, $sql_full);   #all relevant info, including relevant studies

					#counting number of studies for that specific product
		//			while($row_full = mysqli_fetch_assoc($result_full)){
		//				if (($row_full['product_id'] == $row_prod['product_id']) AND ($row_full['studyConclusion'] == 'Efficacious')){
		//					$counter_total += 1;
		//					$counter_effective += 1;
		//				} elseif(($row_full['product_id'] == $row_prod['product_id']) AND ($row_full['studyConclusion'] == 'Uncertain')){
		//					$counter_total += 1;
		//					$counter_uncertain += 1;
		//				} elseif(($row_full['product_id'] == $row_prod['product_id']) AND ($row_full['studyConclusion'] == 'Inefficacious')){
		//					$counter_total += 1;
		//					$counter_ineffective += 1;
		//				} else {continue;}
		//				}

					echo "<h5>Key Study Details:</h5>
						<ul class='resultsinfo-indication'>
							<li>Total no. of relevant studies: ".$counter_total." (Efficacious: ".$counter_effective."; Uncertain: ".$counter_uncertain."; Inefficacious: ".$counter_ineffective.")</li>
						</ul>";

					echo "<a href='details_indication.php?proid=".$row_prod['product_id']."&indid=".$indication."&usage=".$usage."&agegrp=".$agegrp."' class='details-button'>Details</a>
						</div>";

				}

				echo "</div>";

			} else {

				echo "
						<p>There are no results matching your search.<p>
						<p>Currently, there might not be any products available in the Singapore market which contain probiotic strains with published evidence for the <b>".$usage." of ".$indication_name['indication']." in ".$agegrp.".</b></p>
						<p>However, there might be probiotic products containing probiotic strains with evidence for <b>other uses/age groups</b> in the management of ".$indication_name['indication'].". (refer to below)<p/>
					</div>";

				#putting the selected options into an array
				$input_options = array($usage,$agegrp);

				#possible combinations
				$input_combinations = array(
					array('Treatment','Adults'),
					array('Treatment','Children'),
					array('Prevention','Adults'),
					array('Prevention','Children')
				); 

				#array with the unselected combinations
				$input_alternative = array();
				foreach($input_combinations as $option){
					if($option === $input_options){
						continue;
					} else {array_push($input_alternative,$option);}
				} 

				echo "<div class = 'alternative-results'>
				<h2>Alternative Search Options:</h2>
				";

				foreach($input_alternative as $altoption){

					$usage_alt = $altoption[0];
					$agegrp_alt = $altoption[1];

					#alternative SQL query
					$sql_prod_alt = "
					SELECT * FROM products WHERE products.product_id IN (
					SELECT bridge_product_id FROM psbridge WHERE psbridge.bridge_u_study_id IN (
					SELECT u_study_id FROM studies WHERE (studyIndication_id = '".$indication."' AND studyUse = '".$usage_alt."' AND studyAgeGroup = '".$agegrp_alt."') 
					))"; 
					$result_prod_alt = mysqli_query($conn, $sql_prod_alt);

					// no. of alternative results
					$queryResult_alt = mysqli_num_rows($result_prod_alt);

					if ($queryResult_alt != 0){
						echo "
						<p><b>".$usage_alt."/".$agegrp_alt.":</b> There are ".$queryResult_alt." alternative(s) available. &nbsp<a href='results_indication.php?search_indication=".$indication."&search_usage=".$usage_alt."&search_agegroup=".$agegrp_alt."' class='alt-search-button'>Search for Alternatives (".$usage_alt.", ".$agegrp_alt.")</a></p>
						";
					} else {echo"<p><b>".$usage_alt."/".$agegrp_alt.":</b> There are ".$queryResult_alt." alternative(s) available.<p>";}
				} 

				echo "</div>";
					
			}

		 ?>
	</section>


<?php include('templates/footer.php'); ?> 

</html>