<?php 
	include_once "../init.php";

	// User login checker
	if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
	}
	
	include_once 'skeleton.php'; 

	// Budget check before adding expense
	$budget_left = $getFromB->checkbudget($_SESSION['UserId']);
	if ($budget_left == NULL) {
        $budget_left = 0;
    } else {
        $currmonexp = $getFromE->Current_month_expenses($_SESSION['UserId']);
        if ($currmonexp == NULL) {
            $currmonexp = 0;
        }
        $budget_left = $budget_left - $currmonexp;
    }

	// Create an expense record
	if(isset($_POST['addexpense'])) {
		// Get the current date and time
		$dt = date("Y-m-d H:i:s"); // Automatically set the current timestamp
		$itemname = $_POST['item'];
		$itemcost = $_POST['costitem'];
		$category = $_POST['category'];  // Get the selected category

		// Check if expense exceeds the budget
		if (floatval($itemcost) > $budget_left) {
			// Show warning alert if expense exceeds budget
			echo '<script>
				Swal.fire({
					title: "Warning!",
					text: "Your expense exceeds the remaining budget!",
					icon: "warning",
					confirmButtonText: "Close"
				})
				</script>';
		} else {
			// Insert the expense record into the database, including category and current date
			$getFromE->create("expense", array(
				'UserId'=>$_SESSION['UserId'],
				'Item' => $itemname,
				'Cost'=>$itemcost,
				'Date' => $dt,  // Use the current date and time here
				'Category' => $category  // Add category to the insert
			));
			echo '<script>
				Swal.fire({
					title: "Done!",
					text: "Records Updated Successfully",
					icon: "success",
					confirmButtonText: "Close"
				})
				</script>';
		}
	}
?>

<div class="wrapper">
    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="counter" style="height: 60vh; display: flex; align-items: center; justify-content: center;">
                <form action="" method="post">
					<div>
						<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Category:</label><br>
						<select class="text-input" name="category" style="width: 100%; padding-top: 10px;" required>
							<option value="" disabled selected>Select a category</option>
							<option value="Food">Food</option>
							<option value="Entertainment">Entertainment</option>
							<option value="Transport">Transport</option>
							<option value="Utilities">Utilities</option>
							<option value="Others">Others</option>
						</select><br><br>
					</div>

					<div>
						<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Item:</label><br>
						<input type="text" class="text-input" name="item" value="" required="true" style="width: 100%; padding-top: 10px; "><br><br>
					</div>
					
					<div>
						<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">Cost of Item:</label><br>
						<input class="text-input" type="text" value="" required="true" name="costitem" onkeypress='validate(event)' style="width: 100%; padding-top: 10px; "><br><br>
					</div>
																
					<div><br>
						<button type="submit" class="pressbutton" name="addexpense">Add</button>
					</div>													
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../static/js/4-Set-Budget.js"></script>

