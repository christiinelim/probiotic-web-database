<!DOCTYPE html>
<html lang="en">

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

	<section class="pageTopContent" id="aboutus">

		<article>
			<h2>About the Project</h2>
			<p>The Probiotic Reference Guide Web Application was developed in February 2020 as part of an undergraduate final year project. The project aims to develop a user-friendly web application that can efficiently assist healthcare professionals, especially community and retail pharmacists, in providing relevant and evidence-based recommendations on probiotics to consumers.</p>

			<br>

			<h3>Original Publication</h3> <!-- reserved for our original publications -->
			<p>Goh ADY, Ng CSM, Toh YG, Chong JBK, Chew EH, Yap KY. Development of a Probiotics Practice E-Reference Database for Health Care Professionals. Clin Ther. 2021 Dec;43(12):e364-e376.e3. doi: 10.1016/j.clinthera.2021.10.007. Epub 2021 Nov 15. PMID: 34794833.</p>
			<p><a href="https://www.sciencedirect.com/science/article/pii/S0149291821004100"> <b>Read the Article here</b></a></p>

		</article>

<!-- 		<article>
			<h3>Find out more about this project through our publication!</h3>
			<p>Link: <a href="url">**List Title of Study here**</a></p>
			<p>Cite: **Citation here**</p>
		</article> -->

		<article>
			<h3>Why was this application developed?</h3>
			<p>Probiotics are often used as health supplements for the prevention and treatment of a wide range of medical conditions, including various gastrointestinal, dermatological, oral, genitourinary and respiratory conditions. However, the efficacy of probiotics are strain- and disease- specific. Hence, not every probiotic product may be suitable for a given consumer. In order to effectively manage their health condition, consumers should consume a product containing a probiotic or combination of probiotics with proven efficacy in preventing or treating that specific condition.</p>
			<p>With the increasing popularity of probiotics across the world and in Singapore, the number of probiotic products available have also increased. As probiotics are considered as health supplements, the Health Sciences Authority do not require probiotic products to demonstrate efficacy to be marketed in Singapore. As such, there may be products available in the Singapore market that contain a probiotic or combination of probiotics without clinical evidence or efficacy for managing the marketed condition. Therefore, it is necessary to assess the clinical evidence available for each product to determine its effectiveness and suitability for a consumer with a given health condition. However, currently available references do not provide in-depth product-specific information or might not be regularly updated.</p>
			<p>The Probiotic Reference Guide aims to address this by providing comprehensive, up-to-date and product-specific probiotic information in a quick and easy manner (via this Web Application).  In doing so, to efficiently assist healthcare professionals in providing relevant and evidence-based recommendations on probiotics to consumers.</p>		

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
		</article>

		<article>
			<h3>How was this application developed?</h3>
			<h4>A. Review of Published Literature</h4>
			<p>A systematic literature search using pre-defined inclusion criteria was undertaken on the PubMed database to identify relevant clinical studies published from 2008 to June 2022 (refer to Table 1).</p>
			<table class="about-table" id="incl-excl-criteria">
				<tr>
					<th colspan="2">Table 1: Inclusion & exclusion criteria used in the systematic literature search</th>
				</tr>
				<tr>
					<th>Inclusion Criteria</th>
					<th>Exclusion Criteria</th>
				</tr>
				<tr>
					<td>
						<ul>
							<li>Clinical studies – including systematic reviews/meta-analysis, randomised controlled trials, follow-up studies & case-control studies.</li>
							<li>Evaluated efficacy of probiotics for prevention/treatment of disease Human subjects.</li>
							<li>Clearly defined probiotic intervention (genus & species)</li>
							<li>Clearly defined indication or medical condition being treated</li>
						</ul>
					</td>
					<td>
						<ul>
							<li>Narrative Reviews</li>
							<li>Case reports</li>
							<li>Pre-clinical studies</li>
							<li>Mechanistic studies</li>
							<li>Safety studies</li>
							<li>Clinical Trial protocols</li>
							<li>Veterinary studies</li>
							<li>Articles not in English</li>
							<li>Articles without full-text available</li>
						</ul>
					</td>
				</tr>
			</table>
			<p id="ocebminfo">Relevant information, including indication(s), usage (treatment or prevention), age and study groups, details of probiotic treatment (strain, dose and duration) and conclusion of efficacy (efficacious, uncertain, inefficacious), were extracted from selected studies. Risk of bias was evaluated for randomised controlled trials. Each study was then assigned an OCEBM (Oxford Centre for Evidence-based Medicine) Levels of Evidence Score, which stratifies evidence from strongest (Level 1) to weakest (Level 5) based on the quality of the study design (refer to Table 2).</p>
			<table class="about-table" id="ocebm-table">
				<tr>
					<th colspan="2">Table 2: Criteria for the OCEBM 2011 Levels of Evidence</th>
				</tr>
				<tr>
					<th>Level of Evidence</th>
					<th>Study Design</th>
				</tr>
				<tr>
					<td id="ocebm-number">1</td>
					<td>Systematic review or meta-analysis of randomised controlled trials</td>
				</tr>
				<tr>
					<td id="ocebm-number">2</td>
					<td>Randomised controlled trials</td>
				</tr>
				<tr>
					<td id="ocebm-number">3</td>
					<td>Non-randomized controlled cohort/follow-up studies</td>
				</tr>
				<tr>
					<td id="ocebm-number">4</td>
					<td>Case-series, case-control studies, or historically controlled studies</td>
				</tr>
				<tr>
					<td id="ocebm-number">5</td>
					<td>Mechanism-based reasoning</td>
				</tr>
			</table>

			<h4>B. Review of Probiotic Products Available in Singapore</h4>
			<p id="matchinginfo">To identify probiotic products available in Singapore, physical visits to retail or hospital outpatient pharmacies were conducted. Online retail stores were also screened (refer to Table 3).</p>
			<table class="about-table">
				<tr>
					<th colspan="2">Table 3: List of Retail Stores sourced for probiotic products</th>
				<tr>
					<th>Physical Retail Stores</th>
					<th>Online Retail Stores</th>
				</tr>
				<tr>
					<td>
						<ul>
							<li>Watson's Personal Care Stores</li>
							<li>Guardian Health and Beauty</li>
							<li>Unity</li>
							<li>Cold Storage</li>
							<li>Nature's Farm</li>
							<li>Lac Nutrition for Life</li>
							<li>Holland & Barrett</li>
							<li>Nishino Pharmacy</li>
						</ul>
					</td>
					<td>
						<ul>
							<li>GNC</li>
							<li>iHerb</li>
							<li>Glovida</li>
							<li>Vitamin Mall</li>
							<li>Nature's Glory</li>
							<li>Lac Nutrition for Life</li>
							<li>Holland & Barrett</li>
						</ul>
					</td>
				</tr>
			</table>
			<p>Information extracted were based on that provided on the product packaging and product leaflet (if available). Key product details, including brand name, probiotic formulation and strains, dosage regimen and marketed indications were recorded.</p>
			<br>
			<h4>C. Matching of Probiotic Products to Published Clinical Studies</h4>
			<p>Identified probiotic products were matched to relevant studies where the studied probiotic genus and species were identical. As the efficacy of probiotics is strain-specific, strength of link based on matching by strain is also provided. Four different cases based on matching by strain were identified, namely:</p>
			<ul style="padding-left:20px; padding-bottom:5px">
				<li style="font-size:14px">Case 1: Complete match (all strains of product matched those of study)</li>
				<li style="font-size:14px">Case 2: Partial match (at least one strain of product matched those of study and at least one strain of product did not match those of study)</li>
				<li style="font-size:14px">Case 3: No match (all strains of product did not match those of study)</li>
				<li style="font-size:14px">Case 4: Unknown (strains of product may not match those of study due to unspecified strains of study/product)</li>
			</ul>
			<p>The strength of link decreases from Case 1 to Case 3, while the strength of link of Case 4 is unknown.</p>
		
		</article>

		<article>
			<h3>DISCLAIMER:</h3>
			<p><b>Products, clinical study references and other content provided in the Probiotic Reference Guide are for informational and educational purposes only. It is not a basis for therapeutic decisions, nor a substitute for professional judgement. </b></p>
			<p>Information on probiotic products are based on the respective product labels and may not be evaluated by the Health Sciences Authority. Clinical reference information provided on this Guide is reflective of published evidence available to date. It does not represent an endorsement of any specific product. The presence of published clinical evidence for a given probiotic or probiotic combination does not indicate that a product containing the same probiotic or probiotic combination is safe, effective or appropriate for any given patient. By using this Guide, the user acknowledges that he/she has been made aware of and agrees with the disclaimers in this agreement.</p>		
		</article>


	</section>



<?php include('templates/footer.php'); ?>

</html>