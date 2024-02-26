<!DOCTYPE html>
<html lang="en">

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

	<section class="pageTopContent">

		<div class="welcome-message">
			<h2>Welcome to the Probiotic Reference Guide</h2>
			<p>Please familiarise yourself with the information below as well as the <a href="disclaimer.php">Standard Terms & Conditions</a>  before using this website.</p>
<!-- 			<h3>This site is for authorised users only.</h3>	 -->
		</div>

	</section>

	<section class="pageContent">

		<div class= "mainpage-content-container">

			<div class="mainpage-content">

				<article>
					<p>The Probiotic Reference Guide is an informational resource designed to provide healthcare professionals with information related to probiotic products in Singapore, as well as the published evidence available for each product. It aims to assist healthcare professionals, especially community pharmacists practising in the retail setting, in providing relevant and evidence-based probiotic therapy recommendations to consumers in Singapore.</p>

					<table class='about-table'>
						<tr>
							<th>What this guide does</th>
							<th>What this guide does NOT do</th>
						</tr>
						<tr>
							<td>
								<ul>
									<li>Identify probiotic product(s) containing probiotic strain(s) with published clinical evidence (for both efficacy and/or inefficacy).</li>
									<li>Include probiotic products available in the Singapore market (online and/or physical stores including retail pharmacies and health supplement retail stores).</li>
									<li>Links published clinical studies to probiotic products containing the same type(s) of probiotic strain as that used in the studies.</li>
									<li>Provide key probiotic product information (including probiotic strains, strength, dosage form) that are obtained from the package label.</li>
									<li>Highlight key conclusions from published clinical studies on the efficacy of the studied probiotic(s).</li>
								</ul>
							</td>
							<td>
								<ul>
									<li>Provide a basis for therapeutic decisions or is a substitute for professional judgement.</li>
									<li>Provide an exhaustive list of all the probiotic products available in the Singapore market and all the clinical evidence available on probiotics.</li>
									<li>Provide all the information available about a given probiotic product or clinical study – users should still refer to the physical product label (if available) or refer to the study cited.</li>
									<li>Extrapolate current data and recommendations to different combinations of probiotic strains. (Evidence of probiotics are strain- & disease-specific, and can only be applied to products containing exactly the same combination of probiotics as that used in the clinical study cited.)</li>
								</ul>
							</td>
						</tr>
					</table>

<!-- 					<p>The Probiotic Reference Guide is currently in development and therefore access is restricted only to authorised users. Please <a href="loginform.php">log in</a> to access the features of this application.</p>
					<p>Please contact the administrators if you currently do not have an account and would like to access the website.</p> -->
					
				</article>

			</div>	

			<div class="mainpage-content-side">

				<h4>DISCLAIMER:</h4>
				<p><b>Products, clinical study references and other content provided in the Probiotic Reference Guide are for informational and educational purposes only. It is not a basis for therapeutic decisions, nor a substitute for professional judgement.</b></p>
				<p>Information on probiotic products are based on the respective product labels and may not be evaluated by the Health Sciences Authority. Clinical reference information provided on this Guide is reflective of published evidence available to date. It does not represent an endorsement of any specific product. The presence of published clinical evidence for a given probiotic or probiotic combination does not indicate that a product containing the same probiotic or probiotic combination is safe, effective or appropriate for any given patient.</p>
				<p>Users are urged to read our <a href='disclaimer.php'>terms and conditions of use</a> for detailed information. By using this Guide, the user acknowledges that he/she has been made aware of and agrees with the disclaimers in this agreement.</p>

			</div>			

		</div>

		<div id= "homepage-content-container">

			<div>

				<h2>Search by Indication</h2>
				<p>Search the database for products that contain probiotic strain(s) with clinical evidence for a specific indication, usage (Treatment/Prevention) & age group (Adult/Children). This feature may be useful if you want to know about what are the probiotic products available for a given customer with a specific profile (indication, usage, age group).</p>
				<a href="search_indication.php">Search</a>

			</div>	

			<div>

				<h2>Search by Product</h2>
				<p>Search the database for a specific probiotic product. This feature may be useful if you want to know the key information (including probiotic content, dosage form, dosage regimen) for a specific product, or whether there are any published literature available for the probiotic(s) that constitute the product.</p>
				<a href="search_product.php">Search</a>

			</div>	
			
			<div>

				<h2>Search by Strain</h2>
				<p>Search the database for a product containing specific probiotic(s). This feature may be useful if you want to look for products containing a specific combination of probiotic(s) and is available in Singapore.</p>
				<a href="search_strain.php">Search</a>
			
			</div>

			<div>
				<h3>About Us</h3>
				<p>Find out more about the team behind this application.</p>
				<a href="aboutus.php">Go</a>
			</div>
			<div>
				<h3>About the Project</h3>
				<p>Find out more about why we are embarking on this project, and our methods in extracting product & clinical study information.</p>
				<a href="abouttheproject.php">Go</a>
			</div>
			<div>
				<h3>Terms & Conditions</h3>
				<p>Please familarise yourself with the Standard Terms And Conditions before using this application.</p>
				<a href="disclaimer.php">Go</a>
			</div>
		</div>

	</section>

<!-- 	<section class="pageContent">



	</section> -->


<?php include('templates/footer.php'); ?>

</html>