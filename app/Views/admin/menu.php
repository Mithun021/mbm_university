<!-- app/Views/recruiterdetails_form.php -->
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<?php
    use App\Models\Employee_model;
    use App\Models\Menu_pages_model;

    $employee_model = new Employee_model();
    $menu_pages_model = new Menu_pages_model();

    $viewsPath = ROOTPATH . 'app/Views/';

    $viewFiles = array_map(function ($file) {
        return pathinfo($file, PATHINFO_FILENAME);
    }, array_filter(scandir($viewsPath), function ($file) use ($viewsPath) {
        $filePath = $viewsPath . DIRECTORY_SEPARATOR . $file;
        return is_file($filePath) && pathinfo($file, PATHINFO_EXTENSION) === 'php';
    }));
?>
<style>
    .ui-state-highlight {
        background-color: #ffeb3b;
        height: 40px;
        line-height: 40px;
    }
    .mytable,.mytable2{
        width: 100%;
        border-collapse: collapse;
    }
    .mytable tr td, .mytable tr th{
        border: 1px solid #ddd;
        padding: 5px;
    }
    .mytable2 tr td, .mytable2 tr th{
        border: 1px solid #ddd;
        padding: 5px;
    }
    .page_lists{
        position: relative;
        width: 100%;
    }
    .page_lists span{
        float: left;
        width: 31%;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <?php if (session()->getFlashdata('status')): ?>
            <?= session()->getFlashdata('status') ?>
        <?php endif; ?>

        <?php  echo ""; //"<pre>"; print_r($viewFiles); ?>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> Name</h4>
            </div>
            <div class="card-body">
                <!-- Form Start -->
                <form action="<?= base_url() ?>admin/menu" method="post">
                    <!-- Recruiter Title -->
                    <div class="form-group">
                        <span for="Recruitertitle">Menu Title<span class="text-danger">*</span>:</span>
                        <input type="text" name="menu_name" id="menu_name" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save Menu" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h4 class="card-title m-0"><?= $title ?> Details</h4></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Menu Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($menu_name as $key => $value) { ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $value['name'] ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                        <a href="#" class="btn btn-primary waves-effect waves-light"><i class="fas fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger waves-effect waves-light"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
    <div id="accordion" class="custom-accordion mb-4">
        <?php $heading = 1; $collapse = 1; ?>
        <?php foreach ($menu_name as $key => $value): ?>
            <div class="card custom-card mb-2">
                <div class="card-header" id="heading<?= $heading ?>">
                    <h5 class="m-0 font-size-15">
                        <a class="d-block m-0 text-dark" data-toggle="collapse" href="#collapse<?= $collapse?>" aria-expanded="true" aria-controls="collapse<?= ++$key ?>">
                            <?= $value['name'] ?> <span class="float-right"><i class="mdi mdi-chevron-down accordion-arrow"></i></span>
                        </a>
                    </h5>
                </div>
                <div id="collapse<?= $collapse ?>" class="collapse" aria-labelledby="heading<?= $heading ?>" data-parent="#accordion">
                    <div class="card-body">
                        <form action="<?= base_url() ?>admin/menu-heading" method="post">
                            <input type="hidden" name="menu_id" value="<?= $value['id'] ?>" class="form-control form-control-sm">
                            <div class="input-group">
                                <input type="text" name="heading" id="heading" class="form-control form-control-sm" placeholder="Menu Heading *" required>
                                <select name="custom_link" id="custom_link" class="form-control form-control-sm">
                                    <option value="">Custom Link</option>
                                    <?php foreach ($viewFiles as $webpage): ?>
                                        <option value="<?= $webpage ?>"><?= $webpage ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Save Heading" class="btn btn-sm btn-primary">
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="mytable2" id="sortableTable<?= $collapse ?>" data-collapse-id="<?= $collapse ?>" data-menu-id="<?= $value['id'] ?>">
                                <thead>
                                    <tr>
                                        <td>SN</td>
                                        <td>Heading</td>
                                        <td colspan="2">
                                            <span class="d-flex justify-content-between">
                                                <span>Pages</span>
                                                <span><i class="fa fa-plus" onclick="openAssignPage(<?= $value['id'] ?>)"></i></span>
                                            </span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1; foreach ($menu_heading as $pages_heading): ?>
                                        <?php if ($value['id'] == $pages_heading['menu_id']): ?>
                                            <?php $page_name = $menu_pages_model->getPagesByMenuAndHeading($value['id'], $pages_heading['id']); ?>
                                            <tr data-heading-id="<?= $pages_heading['id'] ?>">
                                                <td><?= $num ?></td>
                                                <td>
                                                    <a href="<?php
                                                        if (empty($pages_heading['custom_link'])) {
                                                            echo "javascript:void(0)";
                                                        } elseif ($pages_heading['custom_link'] == "index") {
                                                            echo base_url();
                                                        } else {
                                                            echo base_url() . $pages_heading['custom_link'];
                                                        }
                                                    ?>" target="_blank"><?= $pages_heading['heading'] ?></a>
                                                </td>
                                                <td>
                                                    <table class="mytable">
                                                        <?php foreach ($page_name as $pages): ?>
                                                            <tr data-page-id="<?= $pages['id'] ?>">
                                                                <td width="85%">
                                                                    <a href="<?= base_url() ?><?php echo ($pages['page_name'] === 'index' || empty($pages['page_name'])) ? null : $pages['page_name']; ?>" target="_blank"><?= $pages['page_name'] ?></a>
                                                                </td>
                                                                <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php $num++; endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        <?php $heading++; $collapse++; endforeach; ?>
    </div> <!-- end custom accordions-->
</div> <!-- end col -->


</div>


<!-- Add Pages Model -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="assign_page_model">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myExtraLargeModalLabel">Assign Page</h5>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>admin/save_pages" method="post">
                <div class="modal-body">
                    <input type="text" class="form-control form-control-sm" name="assign_menu_id" id="assign_menu_id" value="" hidden>
                    <div class="form-group">
                        <span>Page Heading</span>
                        <select name="heading_id" id="heading_id" class="form-control form-control-sm">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group page_lists">
                    <?php foreach ($viewFiles as $key => $pages) { ?>
                        <span><input type="checkbox" name="page_name[]" value="<?= $pages ?>"> <?= $pages ?></span>
                    <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save Pages">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>


<script>
    function openAssignPage(menu_id) {
        // alert(menu_id); return false;
        $('#assign_menu_id').val(menu_id);
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>fetch_menu_heading",
            data: {menu_id : menu_id},
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response) {
                    let dataList = $('#heading_id');
                    dataList.empty();
                    dataList.append('<option value="">Select Page Heading</option>');
                    $.each(response, function(index, item) {
                        dataList.append('<option value="'+ item.id +'">'+ item.heading +'</option>');
                    });   
                    $('#assign_page_model').modal('show');
                }
            }
        });
        
     }
</script>

<?= $this->endSection() ?>