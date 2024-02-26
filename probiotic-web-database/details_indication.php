<?php 
	include 'dbconnect.php';
 ?>

<!DOCTYPE html>
<html>

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

<!-- 	<section id="pageContent">
		<h1>Search Details</h1>
	</section> -->

	<section class='list-container'>
		
		<?php

			$productid = mysqli_real_escape_string($conn, $_GET['proid']);
			$indicationid = mysqli_real_escape_string($conn, $_GET['indid']);
			$usage = mysqli_real_escape_string($conn, $_GET['usage']);
			$agegrp = mysqli_real_escape_string($conn, $_GET['agegrp']);
			
			$sql = "
			SELECT *
			FROM psbridge ps 
				JOIN studies s ON ps.bridge_u_study_id = s.u_study_id 
				JOIN products p ON ps.bridge_product_id = p.product_id
			WHERE (p.product_id = ".$productid." AND s.studyIndication_id = '".$indicationid."' AND s.studyUse = '".$usage."' AND s.studyAgeGroup = '".$agegrp."')
			ORDER BY s.ocebmLevel
			";

			$result_product = mysqli_query($conn, $sql);
			$result_study = mysqli_query($conn, $sql);

			$numQueryResults = mysqli_num_rows($result_product);

			$resultarray = mysqli_fetch_assoc($result_product);

			if ($numQueryResults > 0) {

				echo "<div class='details-box'>
					<a href = '".$resultarray['imageLink']."'>
						<img src = '".$resultarray['imageLink']."'>
					</a>
					<h1>".$resultarray['brandName']."</h1>
					<br>
					<h3>Product Details:</h3>					
					<table class = 'details-product-table'>
						<tr>
							<th>Probiotic Strain(s):</th>
							<td colspan='2'>".$resultarray['productStrain']." <i>(Contains ".$resultarray['noOfProbiotics']." type(s) of probiotics)</i></td>
						</tr>
						<tr>
							<th>Total Strength:</th>
							<td colspan='2'>".$resultarray['totalStrength']."</td>
						</tr>
						<tr>
							<th>Marketed Indications:</th>
							<td colspan='2'>".$resultarray['marketedIndications']."</td>
						</tr>
						<tr>
							<th rowspan='2'>Dosage Regimen:</th>
							<td class='inner-table-dosereg'>Dosage:</td>
							<td>".$resultarray['dosageRegimen']."</td>
						</tr>
						<tr>
							<td class='inner-table-dosereg'>Duration:</td>
							<td>".$resultarray['duration']."</td>
						</tr>

						<tr>
							<th>Minimum Age:</th>
							<td colspan='2'>".$resultarray['minimumAgeGroup']."</td>
						</tr>	
						<tr>
							<th>Suitable for:</th>
							<td colspan='2'>
								<ul id='suitability'>
									<li>Pregnancy: ".$resultarray['pregnancy']."</li>
									<li>Lactation: ".$resultarray['lactation']."</li>
									<li>Vegetarian: ".$resultarray['vegetarian']."</li>
									<li>Halal: ".$resultarray['halal']."</li>
								</ul>
							</td>
						</tr>
						<tr>
							<th>Storage:</th>
							<td colspan='2'>".$resultarray['storage']."</td>
						</tr>
						<tr>
							<th>Flavour:</th>
							<td colspan='2'>".$resultarray['flavour']."</td>
						</tr>
						<tr>
							<th>Prebiotics:</th>
							<td colspan='2'>".$resultarray['prebioticContent']."</td>
						</tr>
						<tr>
							<th>Other Key Ingredients:</th>
							<td colspan='2'>".$resultarray['keyIngredients']."</td>
						</tr>
						<tr>
							<th>Other Inactive Ingredients:</th>
							<td colspan='2'>".$resultarray['otherIngredients']."</td>
						</tr>																	
					</table>

					<br><br>
					<h3>Study Details (for Selected Indication, Use & Age Group):</h3>

					<table class='details-study-table'>";

				$counter = 1;
				while ($row = mysqli_fetch_assoc($result_study)) {
					echo "
						<tr>
							<th colspan='3' class='details-study-table-header'>Study ".$counter.": ".$row['studyUse']." of ".$row['studyIndication']." in ".$row['studyAgeGroup']."
							</th>
						</tr>
						<tr>
							<th>Efficacy:</th>
							<td colspan='2'>".$row['studyConclusion']." (<span class='tooltip'><a href='abouttheproject.php#ocebminfo'>OCEBM Level</a>
							<span id='tooltipText'>
								<table class='ocebmPopup'>
									<tr>
										<td class='firstcolumn'><b>Level of evidence</b></td>
										<td><b>Study Design</b></td>
									</tr>
									<tr>
										<td class='firstcolumn'>1</td>
										<td class='secondcolumn'>Systematic review or meta-analysis of randomised controlled trials</td>
									</tr>
									<tr>
										<td class='firstcolumn'>2</td>
										<td class='secondcolumn'>Randomised controlled trials</td>
									</tr>
									<tr>
										<td class='firstcolumn'>3</td>
										<td class='secondcolumn'>Non-randomized controlled cohort/follow-up studies</td>
									</tr>
									<tr>
										<td class='firstcolumn'>4</td>
										<td class='secondcolumn'>Case-series, case-control studies, or historically controlled studies</td>
									</tr>
									<tr>
										<td class='firstcolumn'>5</td>
										<td class='secondcolumn'>Mechanism-based reasoning</td>
									</tr>
								</table>
							</span></span>
							: ".$row['ocebmLevel'].")</td>
						</tr>
						<tr>
							<th>Strain(s) studied:</th>
							<td>".$row['studyStrainDetails']." </td>
						</tr>
					";

					echo "
					<th>
						<span class='tooltip_linkstrength'>
							<a href='abouttheproject.php#matchinginfo'>Strength of Link</a>:
								<span id='tooltipText_linkstrength'>
									<p>Matching of Probiotic Products to Published Clinical Studies<p>
									<p>Identified probiotic products were matched to relevant studies where the studied probiotic genus and species were identical. As the efficacy of probiotics is strain-specific, strength of link based on matching by strain is also provided. Four different cases based on matching by strain were identified, namely:</p>
									<ul>
										<li>Case 1: Complete match (all strains of product matched those of study)</li>
										<li>Case 2: Partial match (at least one strain of product matched those of study and at least one strain of product did not match those of study)</li>
										<li>Case 3: No match (all strains of product did not match those of study)</li>
										   <li>Case 4: Unknown (strains of product may not match those of study due to unspecified strains of study/product)</li>
									   </ul>
									   <p>The strength of link decreases from Case 1 to Case 3, while the strength of link of Case 4 is unknown.</p>
								  </span>
						 </span>
					   </th>
					";

					if ($row['linkMatch'] == 'Genus, species and strains matched'){
						if ($row['disclaimer'] == 'Yes') {
							echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Complete match (all strains of product matched those of study)</li>
										<li>Disclaimer: This study assessed the efficacy of probiotics, without the presence of any prebiotics. Since the product is a synbiotic containing both probiotics and prebiotics, its efficacy may differ from the study's conclusion.</li>
									</ul>
								</td>
							";
						} else {
							echo "
								
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Complete match (all strains of product matched those of study)</li>
									</ul>
								</td>
							";
						}
					} elseif ($row['linkMatch'] == 'Genus and species matched, some strains did not match'){
						if ($row['disclaimer'] == 'Yes') {
							echo "
								
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Partial match (at least one strain of product matched those of study and at least one strain of product did not match those of study)</li>
										<li>Disclaimer: This study assessed the efficacy of probiotics, without the presence of any prebiotics. Since the product is a synbiotic containing both probiotics and prebiotics, its efficacy may differ from the study's conclusion.</li>
									</ul>
								</td>
							";
						} else {
							echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Partial match (at least one strain of product matched those of study and at least one strain of product did not match those of study)</li>
									</ul>
								</td>
							";
						}
					} elseif ($row['linkMatch'] == 'Genus and species matched, all strains did not match'){
						if ($row['disclaimer'] == 'Yes') {
							echo "
								
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): No match (all strains of product did not match those of study)</li>
										<li>Disclaimer: This study assessed the efficacy of probiotics, without the presence of any prebiotics. Since the product is a synbiotic containing both probiotics and prebiotics, its efficacy may differ from the study's conclusion.</li>
									</ul>
								</td>
							";
						} else {
							echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): No match (all strains of product did not match those of study)</li>
									</ul>
								</td>
							";
						}
					} elseif ($row['linkMatch'] == 'Genus and species matched, some strains may not match due to unspecified product/study strains'){
						if ($row['disclaimer'] == 'Yes') {
							echo "
								
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Unknown (strains of product may not match those of study due to unspecified strains of study/product)</li>
										<li>Disclaimer: This study assessed the efficacy of probiotics, without the presence of any prebiotics. Since the product is a synbiotic containing both probiotics and prebiotics, its efficacy may differ from the study's conclusion.</li>
									</ul>
								</td>
							";
						} else {
							echo "
								
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Unknown (strains of product may not match those of study due to unspecified strains of study/product)</li>
									</ul>
								</td>
							";
						}
					} elseif ($row['linkMatch'] == 'Genus, species and strains matched. Prebiotic content matched.'){
						echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Complete match (all strains of product matched those of study)</li>
										<li>Prebiotic(s): Complete match</li>
									</ul>
								</td>
						";
					} elseif ($row['linkMatch'] == 'Genus and species matched, some strains did not match. Prebiotic content matched.'){
						echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Partial match (at least one strain of product matched those of study and at least one strain of product did not match those of study)</li>
										<li>Prebiotic(s): Complete match</li>
									</ul>
								</td>
						";
					} elseif ($row['linkMatch'] == 'Genus and species matched, all strains did not match. Prebiotic content matched.'){
						echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): No match (all strains of product did not match those of study)</li>
										<li>Prebiotic(s): Complete match</li>
									</ul>
								</td>
						";
					} else {
						echo "
							
								<td>
									<ul id='suitability'>
										<li>Genus: Complete match</li>
										<li>Species: Complete match</li>
										<li>Strain(s): Unknown (strains of product may not match those of study due to unspecified strains of study/product)</li>
										<li>Prebiotic(s): Complete match</li>
									</ul>
								</td>
						";	
					}
					
					echo "
						<tr>
							<th>Group(s) studied:</th>
							<td>".$row['studyGroups']."</td>
						</tr>
						<tr>
							<th>Remarks:</th>
							<td>".$row['studyRemarks']."</td>
						</tr>
					";

					if ($row['studyQuality'] == 'Not assessed.'){
						echo "
							<tr>
								<th>Assessment of Study Quality:</th>
								<td>".$row['studyQuality']."</td>
							</tr>
						";
					} else {
						echo "
							<tr>
								<th>Assessment of Study Quality:</th>
								<td>Assessed with Cochrane Risk of Bias Version 2.0<br>
								<b>".$row['overallQuality']."</b><br><br>
								".$row['studyQuality']."
								<br><a href='".$row['robLink']."'>Click here to view the full RoB assessment</a>
								</td>
							</tr>
						";
					}
		
					echo "
						<tr>
							<th>Reference:</th>
							<td class='table-study-references'>".$row['studyReference']." (<a href = '".$row['referenceLink']."'>Link to Article</a>)</td>
						</tr>
					";							
					$counter += 1;
				}

				echo "</table>
					<br><p class='lastinfoupdate'>Information updated on: 23 Aug 2022</p>
					<br><a href='details_full.php?id=".$resultarray['product_id']."' class='details-button'>Full Details (all indications)</a>
					</div>";

			} else {
					echo "There are no results matching your search.";
			}
		 ?>

		 <!-- #include anchor link to explore full list of indications, apart from that selected -->

	</section>

<?php include('templates/footer.php'); ?> 

</html>


