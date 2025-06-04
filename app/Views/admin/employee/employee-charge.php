<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
use App\Models\Employee_additioonal_charge_model;
$employee_additioonal_charge_model = new Employee_additioonal_charge_model();
?>
<style>
    .designation_data {
        position: relative;
        width: 100%;
    }
    .designation_data span{
        float: left;
        width: 30%;
    }


</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title; ?> List</h4>
            </div>
            <div class="card-body">
                <?php
                    if(session()->getFlashdata('msg')){
                        echo session()->getFlashdata('msg');
                    }
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="basic-datatable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Emp. ID</td>
                                <td>Emp. Name</td>
                                <td>Emp. Phone</td>
                                <td>Additional Charge Details</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if (!is_array($employee)) {
                                    die('Error: $employee must be an array.');
                                }
                            ?>
                        <?php foreach ($employee as $key => $value) {?>
                            <?php  
                                $checked_designations = $employee_additioonal_charge_model
                                ->select('designation.name') // Specify columns to select
                                ->join('designation', 'designation.id = employee_additional_charge.designation_id') // Join condition
                                ->where('employee_additional_charge.employee_id', $value['id']) // Specify the condition
                                ->findAll();
                            ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['employee_unique_id'] ?></td>
                                <td><?= $value['first_name']." ".$value['middle_name']." ".$value['last_name'] ?></td>
                                <td><?php if($value['authority']!=="admin"){ ?> <?= $value['mobile_no'] ?>  <?php }else { echo "_____"; } ?></td>
                                <td>
                                <?php if (!empty($checked_designations)): ?>
                                    <ul>
                                        <?php foreach ($checked_designations as $emp_designation): ?>
                                            <li><?= htmlspecialchars($emp_designation['name']) ?></li> <!-- Adjust to the actual column name -->
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                </td>
                                <td><button type="button" class="btn btn-sm btn-dark" onclick="add_emp_charge_btn(<?= $value['id'] ?>,'<?= $value['first_name'].' '.$value['middle_name'].' '.$value['last_name'] ?>')">Manage Charge</button></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="add_emp_charge_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Manage Additional Charge <span id="employee_name" class="text-danger"></span></h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/employee-charge" method="post">
            <div class="modal-body">
                <input type="hidden" class="form-control" id="employee_id" name="employee_id">
                <div class="designation_data">
                <?php foreach ($designation as $key => $value) { ?>
                    <span><input type="checkbox" name="designation[]" id="designation" value="<?= $value['id'] ?>"> &nbsp;&nbsp; <?= htmlspecialchars($value['name']) ?></span>
                <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
<script>
    // function add_emp_charge_btn(emp_id,emp_name) { 
    //     $('#employee_id').val(emp_id);
    //     $('#employee_name').text("("+emp_name+")");
    //     console.log(emp_name);
    //     $('#add_emp_charge_modal').modal('show');

        
    //  }
    function add_emp_charge_btn(emp_id, emp_name) { 
        $('#employee_id').val(emp_id);
        $('#employee_name').text("(" + emp_name + ")");
        console.log(emp_name);

        // Fetch designations via AJAX
        $.ajax({
            url: "<?= base_url('admin/get-employee-designations') ?>/" + emp_id,
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Clear all previous selections
                $('input[name="designation[]"]').prop('checked', false);

                // Loop through the response and check the matching designations
                response.forEach(function(designation) {
                    $('input[name="designation[]"][value="' + designation.designation_id + '"]').prop('checked', true);
                });

                // Show the modal
                $('#add_emp_charge_modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching designations:", error);
            }
        });
    }

</script>

<?= $this->endSection() ?>