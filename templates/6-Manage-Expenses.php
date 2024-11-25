<?php 
    include_once "../init.php";

    // User login checker
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php'; 

    // Deletes expense record
    if(isset($_POST['delrec'])) {
        $getFromE->delexp($_POST['ID']);
        echo "<script>
                Swal.fire({
                    title: 'Done!',
                    text: 'Record deleted successfully',
                    icon: 'success',
                    confirmButtonText: 'Close'
                })
              </script>";
    }

    // Handle update request
    if (isset($_POST['updateExpense'])) {
        $id = $_POST['ID'];
        $item = $_POST['Item'];
        $category = $_POST['Category'];
        $cost = $_POST['Cost'];

        // Update the expense in the database
        $getFromE->updateExpense($id, $item, $category, $cost);
        echo "<script>
                Swal.fire({
                    title: 'Updated!',
                    text: 'Record updated successfully',
                    icon: 'success',
                    confirmButtonText: 'Close'
                })
              </script>";
    }
?>

<div class="wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-ellipsis-h"></i>
                    <h3 style="font-family:'Source Sans Pro'; font-size: 1.5em;">Expenses</h3>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Cost</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Fetch expenses along with categories
                                $totexp = $getFromE->allexpWithCategories($_SESSION['UserId']);
                                if ($totexp !== NULL) {
                                    $len = count($totexp);
                                    for ($x = 1; $x <= $len; $x++) {
                                        $item = $totexp[$x-1]->Item;
                                        $category = $totexp[$x-1]->Category;
                                        $cost = $totexp[$x-1]->Cost;
                                        $date = date("d-m-Y", strtotime($totexp[$x-1]->Date));
                                        $id = $totexp[$x-1]->ID;
                                        echo "<tr id='row$id'>
                                            <td>$x</td>
                                            <td class='editable' id='item$id'>$item</td>
                                            <td class='editable' id='category$id'>$category</td>
                                            <td class='editable' id='cost$id'>$cost</td>
                                            <td>$date</td>
                                            <td>
                                                <button class='editBtn' data-id='$id'>Edit</button>
                                                <button class='saveBtn' style='display:none;' data-id='$id'>Save</button>
                                                <button class='btn btn-default' style='background:none; color:#8f8f8f; font-size:1em;' onclick='deleteConfirmation($id)'>
                                                    <i class='far fa-trash-alt' style='color:red;'></i>
                                                </button>
                                            </td>
                                        </tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../static/js/jquery.min.js"></script>
<script>
    // Delete confirmation using SweetAlert
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form with the record ID
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // same page
                var hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = 'ID';
                hiddenField.value = id;
                form.appendChild(hiddenField);
                
                var hiddenDelField = document.createElement('input');
                hiddenDelField.type = 'hidden';
                hiddenDelField.name = 'delrec';
                hiddenDelField.value = true;
                form.appendChild(hiddenDelField);
                
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Inline edit functionality
    $(document).on('click', '.editBtn', function() {
        var id = $(this).data('id');
        
        // Make the fields editable
        $('#item' + id).html('<input type="text" id="editItem' + id + '" value="' + $('#item' + id).text() + '">');
        $('#category' + id).html('<input type="text" id="editCategory' + id + '" value="' + $('#category' + id).text() + '">');
        $('#cost' + id).html('<input type="text" id="editCost' + id + '" value="' + $('#cost' + id).text() + '">');
        
        // Hide the edit button and show save button
        $(this).hide();
        $('#row' + id + ' .saveBtn').show();
    });

    $(document).on('click', '.saveBtn', function() {
        var id = $(this).data('id');
        var item = $('#editItem' + id).val();
        var category = $('#editCategory' + id).val();
        var cost = $('#editCost' + id).val();

        // Send the updated data to the server to save in the database
        $.ajax({
            url: 'path_to_update_script.php', // Specify the script that handles the update
            method: 'POST',
            data: {
                updateExpense: true,
                ID: id,
                Item: item,
                Category: category,
                Cost: cost
            },
            success: function(response) {
                // Update the table without reloading
                $('#item' + id).text(item);
                $('#category' + id).text(category);
                $('#cost' + id).text(cost);
                
                // Hide the save button and show the edit button
                $('#row' + id + ' .saveBtn').hide();
                $('#row' + id + ' .editBtn').show();
            }
        });
    });
</script>


