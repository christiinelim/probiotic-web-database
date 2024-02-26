<?php include 'dbconnect.php'; ?>

<!DOCTYPE html>
<html>

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

	<section class='list-container'>
		<?php

			$id = mysqli_real_escape_string($conn, $_GET['id']); #obtain product ID

			$sql_prod = "
			SELECT *
			FROM products p
			WHERE (p.product_id ='".$id."')
			";

			# this query will return something, only if there is study evidence available for selected product
			$sql_study = "
			SELECT *
			FROM psbridge ps
				JOIN studies s ON ps.bridge_u_study_id = s.u_study_id 
			WHERE (ps.bridge_product_id ='".$id."')
			ORDER BY s.category, s.studyIndication_id, s.ocebmLevel
			";

			$result_product = mysqli_query($conn, $sql_prod);
			$result_study = mysqli_query($conn, $sql_study);
			$result_study1 = mysqli_query($conn, $sql_study);

			$resultarray = mysqli_fetch_assoc($result_product);

			$numQueryResults = mysqli_num_rows($result_study);



				echo "<div class='details-box'>
					<a href = '".$resultarray['imageLink']."'>
						<img src = '".$resultarray['imageLink']."'>
					</a>
					<h1>".$resultarray['brandName']."</h1>
					<br>
					<h3>Product Details:</h3>
					
					<table class='details-product-table'>
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
			";

			#if there are evidence available for the selected product
			if ($numQueryResults != 0) { 

				$disease_id = 'g0';
				$full_counter_array = array();
				while ($row = mysqli_fetch_assoc($result_study1)) {
					if ($disease_id != $row['studyIndication_id']) {
						if ($disease_id != 'g0') {
							$individual_counter_array = ['total_counter' => $total_counter, 'efficacious_counter' => $efficacious_counter, 'uncertain_counter' => $uncertain_counter, 'inefficacious_counter' => $inefficacious_counter];
							$full_counter_array[$disease_id] = $individual_counter_array;
						}
						
						$disease_id = $row['studyIndication_id'];
						$total_counter = 0;
						$efficacious_counter = 0;
						$uncertain_counter = 0;
						$inefficacious_counter = 0;
						
					}

					if ($row['studyConclusion'] == 'Efficacious') {
						$efficacious_counter += 1;
						$total_counter += 1;
					} elseif ($row['studyConclusion'] == 'Uncertain') {
						$uncertain_counter += 1;
						$total_counter += 1;
					} elseif ($row['studyConclusion'] == 'Inefficacious') {
						$inefficacious_counter += 1;
						$total_counter += 1;
					} else {continue;}
				}
				

				$individual_counter_array = ['total_counter' => $total_counter, 'efficacious_counter' => $efficacious_counter, 'uncertain_counter' => $uncertain_counter, 'inefficacious_counter' => $inefficacious_counter];
				$full_counter_array[$disease_id] = $individual_counter_array;

				

				echo "
				<br><br>
				<h3>Study Details:</h3>
				";

				$disease_id = 'g0';
				while ($row = mysqli_fetch_assoc($result_study)) {
					#this if wil be carried out for each new studyIndication_id
					if ($disease_id != $row['studyIndication_id']){

						#this if will be carried out for each new studyIndication_id except the very first one (to close the accordion of previous indication)
						if ($disease_id != 'g0'){
							echo "
							</div>
							</div>
							</div>
							";
						}

						$counter = 1;
						$disease_id = $row['studyIndication_id'];
						
						#query to get the indication for each accordion header
						$sql_disease = "
						SELECT indication FROM indications WHERE indications.indication_id = '".$disease_id."'
					    ";
					    $sql_disease_query = mysqli_query($conn, $sql_disease);
					    $disease = mysqli_fetch_assoc($sql_disease_query);

						echo "
						<div class='accordion'>
							<div class='contentBx'>
								<div class='label'>
								<p>".$disease['indication']."</p>
								<p>Total Studies: ".$full_counter_array[$disease_id]['total_counter']." (Efficacious: ".$full_counter_array[$disease_id]['efficacious_counter'].", Uncertain: ".$full_counter_array[$disease_id]['uncertain_counter'].", Inefficacious: ".$full_counter_array[$disease_id]['inefficacious_counter'].")</p>
								</div>
								<div class='content'>
						";

					}

					echo "

						<table class='details-study-table'>
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
								<td>".$row['studyStrainDetails']."</td>
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
						</table>														
					";

					$counter += 1;
						
				}

				echo "
					</div>
					</div>
					</div>
					<br><p class='lastinfoupdate'>Information updated on: 23 Aug 2022</p>
					</div>
				"; 
				
				echo"
					<script>
						const accordion = document.getElementsByClassName('contentBx');

						for (i = 0; i<accordion.length; i++ ){
							accordion[i].addEventListener('click', function(){
								this.classList.toggle('active')
							})
						}
					</script>
								
				";
				
			} else {
				# alternative query, if there is no study evidence available for selected product
				echo "	
					<div class='no-study-info'>
						<h3>Study details:</h3>
						<p>There are currently no published evidence available for the probiotic or blend of probiotics that constitute this product. However, the absence of published clinical evidence for a given probiotic or probiotic combination does not indicate that a product containing the same probiotic or probiotic combination is unsafe, ineffective or inappropriate for a given patient with the selected condition. Professional judgement is strongly recommended when providing product recommendations to customers.</p>
					</div>

					<br><p class='lastinfoupdate'>Information updated on: 23 Aug 2022</p>

				</div>";
			}
		 ?>

	</section>

<?php include('templates/footer.php'); ?> 

</html>