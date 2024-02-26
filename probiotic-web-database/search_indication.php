<!DOCTYPE html>
<html>

<?php 
include('templates/header.php');
include('templates/navbar.php');
?>

	<section class="pageTopContent" id="search-header">
		<article>
			<h2>Search by Indication</h2>
			<p>Please select the indication, intended use & age group below.</p>
		</article>
	</section>

	<section class="searchform">
		
		<form method="get" action="results_indication.php" name="searchform_indication">

			<!-- Note: Each indication is labelled with a value corresponding to the Indication ID in the SQL database-->
	        <label for="indication">Indication: </label>
	        <select name="search_indication" id="search_indication" required>
	        	<option value="" disabled selected hidden>--- Select an Option ---</option>
	        	<optgroup label="Gastrointestinal">
	        		<option value="g1">Constipation</option>
	            	<option value="g2">Diarrhoea (Acute)</option>
	            	<option value="g3">Diarrhoea (Antibiotic-associated)</option>
	            	<option value="g4">Diarrhoea (Traveller's)</option>
	            	<option value="g5">Dyspepsia</option>
	            	<option value="g6">Gastroenteritis</option>
	            	<option value="g7">H.pylori Infections</option>
	            	<option value="g8">Irritable Bowel Syndrome</option>
	            	<option value="g9">Lactose Intolerance</option>
	        	</optgroup>	        	
	        	<optgroup label="Genitourinary">
	        		<option value="u1">Bacterial Vaginosis</option>
	        		<option value="u2">Vulvovaginal Candidiasis</option>
	        		<option value="u3">Urinary Tract Infection</option>
	        	</optgroup>
	        	<optgroup label="Oral">
	        		<option value="o1">Bad breath (Halitosis)</option>
	        		<option value="o2">Gum disease (Gingivitis, Periodontitis)</option>
	        		<option value="o3">Oral Candida</option>
	        		<option value="o4">Tooth decay (Caries)</option>	        		
	        	</optgroup>
	        	<optgroup label="Respiratory">
	        		<option value="r1">Upper Respiratory Tract Infections (URTI)</option>
	        	</optgroup>
	        	<optgroup label="Skin">
	        		<option value="s1">Eczema</option>
	        	</optgroup>
	        	<optgroup label="Others">
	        		<option value="ot1">Infant Colic</option>
	        	</optgroup>
	        </select>

	        <br><br>

	        <p>Usage:</p>
	        <div class = "radiobutton">
	        	<input type="radio" name="search_usage" value="Treatment" id="Treatment" required>
	        	<label id="radiobuttonlabel" for="Treatment">Treatment</label>
			</div>
	        <div class = "radiobutton">
	        	<input type="radio" name="search_usage" value="Prevention" id="Prevention" required>
	        	<label id="radiobuttonlabel" for="Prevention">Prevention</label>
	        </div>

	       	<br><br><br>	

	        <p>Age Group:</p>
	        <div class = "radiobutton">
	        	<input type="radio" name="search_agegroup" value="Adults" id="Adults" required>
	        	<label id="radiobuttonlabel" for="Adults">Adults</label>
	        </div>
	        <div class = "radiobutton">
		       	<input type="radio" name="search_agegroup" value="Children" id="Children" required>
		       	<label id="radiobuttonlabel" for="Children">Children</label>	        	
	        </div>

	       	<br><br><br>

<!-- 	        <p>Only include product(s) with proven efficacy:</p>
	        <div class = "radiobutton-efficacy">
	        	<input type="radio" name="search_efficacy" value="Efficacious" id="Efficacious" required>
	        	<label for="Efficacious">Yes (Efficacious products only)</label>
	        	<br>
		       	<input type="radio" name="search_efficacy" value="All-in" id="All-in" required>
		       	<label for="All-in">No (Both Efficacious & Inefficacious products</label>	        	
	        </div>

	        <br><br><br><br><br><br> -->

	        <div class = "radiobutton-submit">
	        	<button type="submit-indication" name="submit-indication-search">Search</button>
	        </div>
	        

		</form>
	</section>


<?php include('templates/footer.php'); ?>

</html>