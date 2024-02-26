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
			<h2>Search by Strain</h2>
			<p>Please type in the name of the probiotic(s) you want to search for in the field(s) below. Do type in only one probiotic in each field.</p>
			<p>Note: Please type in <b>both the genus and species</b> of the probiotics in full. You may or may not specify the strain.</p>
            <ul style="padding-left:20px">
                <li style="color: green;font-size: 13px">Correct example: Lactobacillus acidophilus NCFM or Lactobacillus acidophilus</li>
                <li style="color: red;font-size: 13px">Wrong example: L. acidophilus</li>
            </ul>
		</article>

	</section>

	<section class="searchstrainform">

        <?php
            $sql_probiotics = "SELECT probiotics from probiotics";
            
            $sql_probiotics1 = mysqli_query($conn, $sql_probiotics);

            $results_array = [];

            while ($row = mysqli_fetch_assoc($sql_probiotics1)){
                array_push($results_array, $row['probiotics']);
            }

            sort($results_array);

            echo"
                
                        <form action='results_strain.php' method='get'>
                            <div class='wrapper'>
                                <div class='search-input'>
                                    <label for='strain2'>Strain 1:</label><br>
                                    <input type='text' id='strain1' name='strain1' placeholder='Insert probiotic here (required)' required>
                                    <div class='autocom-box'>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class='wrapper2'>
                                <div class='search-input2'>
                                    <label for='strain2'>Strain 2:</label><br>
                                    <input type='text' id='strain2' name='strain2' placeholder='Insert additional probiotic here (optional)'>
                                    <div class='autocom-box2'>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            
                            <div class='wrapper3'>
                                <div class='search-input3'>
                                    <label for='strain3'>Strain 3:</label><br>
                                    <input type='text' id='strain3' name='strain3' placeholder='Insert additional probiotic here (optional)'>
                                    <div class='autocom-box3'>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            
                            <div class='wrapper4'>
                                <div class='search-input4'>
                                    <label for='strain4'>Strain 4:</label><br>
                                    <input type='text' id='strain4' name='strain4' placeholder='Insert additional probiotic here (optional)'>
                                    <div class='autocom-box4'>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <p>Show products containing only the above probiotics?</p>

                            <div class='radiobutton'>
                                <input type='radio' name='search_strain' value='Yes' id='strain_yes' required>
                                <label for='strain_yes'>Yes</label>
                            
                                <input style='margin-left: 80px;' type='radio' name='search_strain' value='No' id='strain_no' required>
                                <label for='strain_no'>No</label>
                            </div>
                            <div>
                                <button type='submit' name='submit-search'>Submit</button>
                            </div>
                        </form>
                    
            ";
        ?>

	</section>
    
    <script>
        var obj = <?php echo json_encode($results_array); ?>;
    </script>
    <script src="js/script.js"></script>
    <script src="js/strains_suggestions.js"></script>

</body>

<?php include('templates/footer.php'); ?>

</html>