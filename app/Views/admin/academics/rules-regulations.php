<?= $this->extend("admin/layouts/master") ?>

<?= $this->section("body-content"); ?>
<style>

</style>
<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Rules & Regulations </h4>
            </div>
            <div class="card-body">
                <?php
                if (session()->getFlashdata('status')) {
                    echo session()->getFlashdata('status');
                }
                ?>
                <form method="post" action="<?= base_url() ?>admin/rules-regulations" enctype="multipart/form-data">
                    <div class="form-group">
                        <span for="">Title<span class="text-danger">*</span></span>
                        <input type="text" class="form-control form-control-sm" name="title" value="<?= $rules_regulations['title'] ?>" required>
                    </div>

                    <div class="form-group">
                        <span for="">Desription</span>
                        <textarea id="editor" name="description"><?= $rules_regulations['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <span for="">Upload file(.pdf)<span class="text-danger">*</span></span>
                        <input type="file" class="form-control form-control-sm" name="upload_file">
                        <?php if (!empty($rules_regulations['upload_file']) && file_exists('public/admin/uploads/rules_regulation/' . $rules_regulations['upload_file'])): ?>
                            <a href="<?= base_url() ?>public/admin/uploads/rules_regulation/<?= $rules_regulations['upload_file'] ?>" target="_blank"><img src="<?= base_url() ?>public/admin/assets/images/pdf.png" alt="" height="30px"></a>
                        <?php else: ?>
                            <img src="<?= base_url() ?>public/admin/uploads/rules_regulation/invalid_image.png" alt="" height="40px">
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="submitBtn">Save</button>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>