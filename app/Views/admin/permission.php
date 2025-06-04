<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php
    use App\Models\Module_category_model;
    use App\Models\Permission_model;

    $module_category_model = new Module_category_model();
    $Permission_model = new Permission_model();
?>

<div class="row">
    <!-- Form Section for Adding <?= $title ?> -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('status')): ?>
                    <div class="alert alert-success">
                        <?= esc(session()->getFlashdata('status')) ?>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-border">
                        <tbody>
                            <?php foreach ($modules as $key => $value) { 
                                $module_category = $module_category_model->get_by_module_id($value['id']); ?>
                                <tr style="background-color: #fca996; color : #000; font-weight : bold">
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td>View</td>
                                    <td>Add</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                                <?php foreach ($module_category as $value2) { 
                                    if ($value['id'] == $value2['module_id']) { ?>
                                    <?php $permission = $Permission_model->get_by_employee_and_module_id($emp_id,$value2['id']); 

                                        $view_checked = $permission && $permission['view_permission'] == 1 ? 'checked' : '';
                                        $add_checked = $permission && $permission['add_permission'] == 1 ? 'checked' : '';
                                        $edit_checked = $permission && $permission['edit_permission'] == 1 ? 'checked' : '';
                                        $delete_checked = $permission && $permission['delete_permission'] == 1 ? 'checked' : '';
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?= $value2['name'] ?></td>
                                            <td><?php if($value2['c_view'] == 1){ ?><label for=""><input type="checkbox"  class="status-checkbox" name="model_view" value="<?= $value2['id']."#view#".$emp_id ?>" <?= $view_checked ?>></label> <?php } ?></td>
                                            <td><?php if($value2['c_add'] == 1){ ?><label for=""><input type="checkbox"  class="status-checkbox" name="model_add" value="<?= $value2['id']."#add#".$emp_id ?>" <?= $add_checked ?>></label> <?php } ?></td>
                                            <td><?php if($value2['c_edit'] == 1){ ?><label for=""><input type="checkbox"  class="status-checkbox" name="model_edit" value="<?= $value2['id']."#edit#".$emp_id ?>" <?= $edit_checked ?>></label> <?php } ?></td>
                                            <td><?php if($value2['c_delete'] == 1){ ?><label for=""><input type="checkbox"  class="status-checkbox" name="model_delete" value="<?= $value2['id']."#delete#".$emp_id ?>" <?= $delete_checked ?>></label> <?php } ?></td>
                                        </tr>
                                    <?php } 
                                } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>