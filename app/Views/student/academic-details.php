<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <form action="<?= base_url() ?>student/academic-details" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <?php if (session()->getFlashdata('status')): ?>
                        <?= session()->getFlashdata('status') ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Degree Type <span class="text-danger">*</span></span>
                                <select class="form-control form-control-sm" name="degree_type" id="degree_type" required>
                                    <option value="">Select Degree Type</option>
                                    <option value="10th">10th</option>
                                    <option value="12th">12th</option>
                                    <option value="Under Graduate">Under Graduate</option>
                                    <option value="Post Graduate">Post Graduate</option>
                                    <option value="Other">Other</option>
                                </select>

                                <input type="text" class="form-control form-control-sm mt-2" name="other_degree_name" id="other_degree_name" placeholder="Enter Other Degree Name" style="display: none;">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Board/ Institute	Name<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="board_institute_name" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Subjects Studied<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="subject_studied" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Marks Type <span class="text-danger">*</span></span>
                                <select class="form-control form-control-sm" name="marks_type" value="" required>
                                    <option value="">Select Marks Type</option>
                                    <option value="CGPA">CGPA</option>
                                    <option value="GPA">GPA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Marks Obtained<span class="text-danger">*</span></span>
                                <input type="text" class="form-control form-control-sm" name="marks_obtained" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Date of Result Declaration<span class="text-danger">*</span></span>
                                <input type="month" class="form-control form-control-sm" name="result_declaration_date" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>Date of Degree <span class="text-danger">*</span></span>
                                <input type="month" class="form-control form-control-sm" name="degree_date" value="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <span>File Upload Option(.pdf)<span class="text-danger">*</span></span>
                                <input type="file" class="form-control form-control-sm" name="upload_file" accept=".pdf">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="datatable-buttons">
                        <thead>
                            <tr>
                                <td>Degree Type</td>
                                <td>Board/ Institute Name</td>
                                <td>Subjects Studied</td>
                                <td>Marks Type</td>
                                <td>Marks Obtained</td>
                                <td>Date of Result Declaration</td>
                                <td>Date of Degree</td>
                                <td>File Upload</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($studentAcademicDetails): ?>
                                <?php foreach ($studentAcademicDetails as $detail): ?>
                                    <tr>
                                        <td><?= $detail['degree_type'] ?></td>
                                        <td><?= $detail['board_institute_name'] ?></td>
                                        <td><?= $detail['subject_studied'] ?></td>
                                        <td><?= $detail['marks_type'] ?></td>
                                        <td><?= $detail['marks_obtained'] ?></td>
                                        <td><?= date('M-Y', strtotime($detail['result_declaration_date'])) ?></td>
                                        <td><?= date('M-Y', strtotime($detail['degree_date'])) ?></td>
                                        <td><a href="<?= base_url() ?>public/admin/uploads/students/<?= $detail['upload_file'] ?>" target="_blank">View File</a></td>
                                        <td>
                                            <a href="<?= base_url() ?>student/delete-academic-details/<?= $detail['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="8" class="text-center">No records found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('degree_type').addEventListener('change', function() {
        var otherInput = document.getElementById('other_degree_name');
        if (this.value === 'Other') {
            otherInput.style.display = 'block';
            otherInput.required = true; // Make it required if shown
        } else {
            otherInput.style.display = 'none';
            otherInput.value = ''; // Clear previous value
            otherInput.required = false;
        }
    });
</script>

<?= $this->endSection() ?>