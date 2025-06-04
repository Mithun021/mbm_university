<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>

<style>
    .resumt-list{
        border: 1px solid #5e5959;
    }
    .skills-list{
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px;
        border-bottom: 1px solid #5e5959;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <?php if (session()->getFlashdata('status')): ?>
            <?= session()->getFlashdata('status') ?>
        <?php endif; ?>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Add Skills</h4>
            </div>
            <form action="<?= base_url() ?>student/student-skills" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <div class="form-group">
                        <span for="skills" class="form-span">Skills</span>
                        <input type="text" class="form-control" id="skills" name="skills" placeholder="Enter your skills">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add Skills">
                    </div>
                </div>
            </form>

            <div class="resumt-list">
                <?php if (isset($studentSkills)) { ?>
                    <?php foreach ($studentSkills as $skill){ ?>
                        <div class="skills-list">
                            <p class="m-0"><?= $skill['skills'] ?></p>
                            <a href="<?= base_url() ?>student/delete-skills/<?= $skill['id'] ?>">X</a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Area of Interest</h4>
            </div>
            <form action="<?= base_url() ?>student/student-area-interest" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <div class="form-group">
                        <span for="skills" class="form-span">Area Interest</span>
                        <input type="text" class="form-control" id="area_interest" name="area_interest" placeholder="Enter your insterest">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
            <div class="resumt-list">
                <?php if (isset($studentAreaInterest)) { ?>
                    <?php foreach ($studentAreaInterest as $skill){ ?>
                        <div class="skills-list">
                            <p class="m-0"><?= $skill['area_interest'] ?></p>
                            <a href="<?= base_url() ?>student/delete-area-interest/<?= $skill['id'] ?>">X</a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Language</h4>
            </div>
            <form action="<?= base_url() ?>student/student-language" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <div class="form-group">
                        <span for="skills" class="form-span">Language</span>
                        <input type="text" class="form-control" id="language" name="language" placeholder="Englis,Hindi...">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
            <div class="resumt-list">
                <?php if (isset($studentLanguage)) { ?>
                    <?php foreach ($studentLanguage as $skill){ ?>
                        <div class="skills-list">
                            <p class="m-0"><?= $skill['language'] ?></p>
                            <a href="<?= base_url() ?>student/delete-language/<?= $skill['id'] ?>">X</a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title m-0">Hobbies</h4>
            </div>
            <form action="<?= base_url() ?>student/student-hobbies" method="post" enctype="multipart/form-data">
                <div class="card-body p-1">
                    <div class="form-group">
                        <span for="skills" class="form-span">Hobbies</span>
                        <input type="text" class="form-control" id="hobbies" name="hobbies" placeholder="Cricket, Football...">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
            <div class="resumt-list">
                <?php if (isset($studentHobbies)) { ?>
                    <?php foreach ($studentHobbies as $skill){ ?>
                        <div class="skills-list">
                            <p class="m-0"><?= $skill['hobbies'] ?></p>
                            <a href="<?= base_url() ?>student/delete-hobbies/<?= $skill['id'] ?>">X</a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>