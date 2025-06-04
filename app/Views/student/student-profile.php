<?= $this->extend("student/stdlayouts/master") ?>
<?= $this->section("student-content"); ?>
<?php
use App\Models\Employee_model;
$employee_model = new Employee_model();

use App\Models\Student_publication_author_model;
$student_publication_author_model = new Student_publication_author_model();

use App\Models\Student_bookchapter_author_model;
$student_bookchapter_author_model = new Student_bookchapter_author_model();

use App\Models\Student_patent_author_model;
$student_patent_author_model = new Student_patent_author_model();

use App\Models\Student_copyright_author_model;
$student_copyright_author_model = new Student_copyright_author_model();

?>

<style>
    p,
    h3,
    h4,
    h5,
    h6 {
        margin: 0px;
        padding: 0px;
    }

    .flex-div {
        display: flex;
        justify-content: flex-start;
        /* align-items: center; */
    }

    .justify-div,.justify-div50 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .justify-div p {
        width: 30%;
        text-align: left;
    }
    .justify-div50 p {
        width: 50%;
        text-align: left;
    }
    .justify-div h6{
        color: #cf1c7e;
    }

    .resume-header img.header-profile-user {
        width: auto;
        height: 130px;
    }
    .student-personal-details{
        margin-left: 10px;
    }

    .resume-summery {
        margin-top: 20px;
    }

    .resume-summery h5 {
        margin-bottom: 10px;
        color: #00366d;
        border-bottom: 2px solid #00366d;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th{
        font-size: 12px;
        font-weight: 500;
        color: #000;
    }
    .resume-content-box{
        margin-bottom: 10px;
    }
    .signature{
        margin-top: 60px;
    }
    .content-box{
        margin-bottom: 20px;
    }
    .normal-flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .normal-flex div{
        padding-right: 30px;
        font-weight: 500;
        margin-bottom: 15px;
        color: #cf1c7e;
    }
    .normal-flex h6{
        width: 300px;
        text-align: right;
        color: #cf1c7e;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body p-1" id="print_profile">
            <div class="resume-header flex-div">
                <div class="student-image">
                    <?php if (!empty($studentData['profile_image']) && file_exists('public/admin/uploads/students/' . $studentData['profile_image'])): ?>
                        <img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['profile_image'] ?>" alt="" class="header-profile-user">
                    <?php else: ?>
                        <img class="header-profile-user" src="<?= base_url() ?>public/assets/image/avatar.png"
                        alt="Header Avatar">
                    <?php endif; ?>
                </div>
                <div class="student-personal-details">
                    <h4><?= $studentData['first_name']. " " . $studentData['middle_name']. " " . $studentData['last_name'] ?></h4>
                    <p>Email : <?= $studentData['personal_mail'] ?></p>
                    <p>Phone : <?= $studentData['phone_no'] ?></p>
                    <p>Father's Name : <?= $studentData['father_name'] ?></p>
                    <p>Address : <?= $studentData['permanent_address'] ?></p>
                    <p>LinkedIn : <a href="<?= $studentData['linkedin_id'] ?>" target="_blank" rel="noopener noreferrer"><?= $studentData['linkedin_id'] ?></a></p>
                </div>
            </div>
            <div class="resume-summery">
                <h5>Career Objective</h5>
                <p><?= $studentData['career_objective'] ?></p>
            </div>
            <?php if ($studentAcademicDetails){ ?>
            <div class="resume-summery">
                <h5>Academic Details</h5>
                <table>
                    <tr>
                        <th>Degree Type</th>
                        <th>Board/Institute Name</th>
                        <th>Subjects Studied</th>
                        <th>Marks Type</th>
                        <th>Marks Obtained</th>
                        <th>Result Declaration Date</th>
                        <th>Date of Degree</th>
                    </tr>
                <?php foreach ($studentAcademicDetails as $detail): ?>
                    <tr>
                        <td><?= $detail['degree_type'] ?></td>
                        <td><?= $detail['board_institute_name'] ?></td>
                        <td><?= $detail['subject_studied'] ?></td>
                        <td><?= $detail['marks_type'] ?></td>
                        <td><?= $detail['marks_obtained'] ?></td>
                        <td><?= date('M-Y', strtotime($detail['result_declaration_date'])) ?></td>
                        <td><?= date('M-Y', strtotime($detail['degree_date'])) ?></td>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
            <?php } ?>

            <?php if ($phdstudentData){ ?>

            <div class="resume-summery">
                <h5>PHD Details</h5>
            <?php foreach ($phdstudentData as $phd): ?>
                <div class="content-box">
                <div class="justify-div">
                    <h6><?= $phd['phd_title'] ?></h6>
                    <h6>Reg. Date : <?= $phd['registration_date'] ?></h6>
                </div>
                <div><?= $phd['description'] ?></div>
                <!-- <br> -->
                <p>Supervisor Name : <?php $emp = $employee_model->get($phd['supervisor_name']); if($emp) { echo $emp['first_name'] . " " . $emp['middle_name'] . " " . $emp['last_name']; }  ?></p>
                <p>Status : <?= $phd['current_status'] ?></p>
                <?php if(!empty($phd['submission_date']) && $phd['submission_date'] != '0000-00-00') {
                    echo '<p>Submission Date : '.$phd['submission_date'].'</p>';
                } ?>

                <?php if(!empty($phd['award_date']) && $phd['award_date'] != '0000-00-00') {
                    echo '<p>Award Date : '.$phd['award_date'].'</p>';
                } ?>
                <!-- SUbmit and Award date embed -->
                </div>
            <?php endforeach; ?>
            </div>
            <?php } ?>

            <?php if ($pubstudentData){ ?>
            <div class="resume-summery">
                <h5>Publication Details</h5>
            <?php foreach ($pubstudentData as $pub): ?>
                <div class="resume-content-box">
                    <div class="normal-flex">
                        <div>
                            <?= $pub['publication_title'] ?>
                        </div>
                        <h6>Pub. Year : <?= $pub['publication_year'] ?></h6>
                    </div>
                    <div><?= $pub['publication_description'] ?></div>
                    <div class="justify-div">
                        <p>Journal Name : <?= $pub['journal_name'] ?></p>
                        <p>Volume Number : <?= $pub['volume_number'] ?></p>
                        <p>Page Number : <?= $pub['page_number'] ?></p>
                    </div>
                    <div class="justify-div">
                        <p>Publication Type : <?= $pub['publication_type'] ?></p>
                        <p>ISSN no : <?= $pub['issn_no'] ?></p>
                        <p>ISBN no : <?= $pub['isbn_no'] ?></p>
                    </div>
                    <div class="justify-div">
                        <p>DOI Details : <?= $pub['doi'] ?></p>
                        <p>Impact Factor : <?= $pub['impact_factor'] ?></p>
                    </div>
                    <p><b>Author Name : </b>
                    <?php $authors = $student_publication_author_model->getByPublication($pub['id']); ?>
                    <?php if ($authors): ?>
                        <?php foreach ($authors as $author): ?>
                            <?= $author['author_name']."," ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        No Author Found
                    <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; ?>
            </div>

            <?php } ?>

            <?php if ($bookstudentData){ ?>
            <div class="resume-summery">
                <h5>Book Chapter Details</h5>
                <?php foreach ($bookstudentData as $pub): ?>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6><?= $pub['chapter_title'] ?></h6>
                            <span><?= $pub['book_title'] ?></span>
                        </div>
                        <h6>Pub. Year : <?= $pub['publication_year'] ?></h6>
                    </div>
                    <div><?= $pub['publication_description'] ?></div>
                    <div class="justify-div">
                        <p>Publisher Name : <?= $pub['publisher_name'] ?></p>
                        <p>Volume Number : <?= $pub['volume_number'] ?></p>
                        <p>Page Number : <?= $pub['page_number'] ?></p>
                    </div>
                    <div class="justify-div">
                        <p>ISSN no : <?= $pub['issn_no'] ?></p>
                        <p>ISBN no : <?= $pub['isbn_no'] ?></p>
                    </div>
                    <div class="justify-div">
                        <p>DOI Details : <?= $pub['doi'] ?></p>
                        <p>Impact Factor : <?= $pub['impact_factor'] ?></p>
                    </div>
                    <p><b>Author Name : </b>
                    <?php $authors = $student_bookchapter_author_model->getByBookchapter($pub['id']); ?>
                    <?php if ($authors): ?>
                        <?php foreach ($authors as $author): ?>
                            <?= $author['author_name']."," ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php } ?>

            <?php if ($patentstudentData): ?>
            <div class="resume-summery">
                <h5>Patent Details</h5>
            <?php foreach ($patentstudentData as $row): ?>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6><?= $row['patent_title'] ?></h6>
                        </div>
                        <h6>Filing Year : <?= date('d-m-Y', strtotime($row['patent_filing_date'])) ?></h6>
                    </div>
                    <div><?= $row['description'] ?></div>
                    <div class="justify-div">
                        <p>Patent Number : <?= $row['patent_number'] ?></p>
                        <p>Patent Status : <?= $row['patent_status'] ?></p>
                    </div>
                    <div class="justify-div">
                        <?php if(!empty($row['patent_grant_date']) && $row['patent_grant_date'] != '0000-00-00') {
                            echo '<p>Patent Grant Date : '.$row['patent_grant_date'].'</p>';
                        } ?>
                        <p>Patent Level : <?= $row['patent_level'] ?></p>
                        <p>Fund Generated : <?= $row['fund_generated'] ?></p>
                    </div>
                    <p><b>Author Name : </b></p>
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($confstudent_data): ?>
            <div class="resume-summery">
                <h5>Conference/Workshop Details</h5>
                <?php foreach ($confstudent_data as $value): ?>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6><?= $value['conference_title'] ?></h6>
                        </div>
                        <h6>Date : <?= date('d-m-Y', strtotime($value['conference_date'])) ?></h6>
                    </div>
                    <div><?= $value['description'] ?></div>
                    <div class="justify-div">
                        <p>Duration of Conference/ Workshop : <?= $value['conference_duration'] ?></p>
                        <p>Paper details : <?= $value['paper_datils'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($copystudentData): ?>
            <div class="resume-summery">
                <h5>Copyright Details</h5>
                <?php foreach ($copystudentData as $key => $copyright): ?>
                <div class="resume-content-box">
                    <h6><?= $copyright['copyright_title'] ?></h6>
                    <div><?= $copyright['description'] ?></div>
                    <div class="justify-div">
                        <p>Copyright Number : <?= $copyright['copyright_number'] ?></p>
                        <p>Copyright Status : <?= $copyright['copyright_status'] ?></p>
                    </div>
                    <div class="justify-div">
                        <p>Copyright Filing Date : <?= date('d-m-Y', strtotime($copyright['copyright_filing_date'])) ?></p>
                        <?php if(!empty($copyright['copyright_grant_date']) && $copyright['copyright_grant_date'] != '0000-00-00') {
                            echo '<p>Copyright Grant Date : '.$copyright['copyright_grant_date'].'</p>';
                        } ?>
                        
                    </div>
                    <p><b>Author Name : </b>
                    <?php $authors = $student_copyright_author_model->getByPaCopyright($copyright['id']); ?>
                    <?php if ($authors): ?>
                        <?php foreach ($authors as $author): ?>
                            <?= $author['author_name']."," ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($student_acchievement): ?>
            <div class="resume-summery">
                <h5>Achievements Details</h5>
                <?php foreach ($student_acchievement as $achievement): ?>
                <div class="resume-content-box">
                    <div class="justify-div">
                        <div>
                            <h6><?= $achievement['achievement_title'] ?></h6>
                        </div>
                        <h6>Date : <?= date('d-m-Y', strtotime($achievement['award_date'])) ?></h6>
                    </div>
                    <div><?= $achievement['description'] ?></div>
                    <div class="justify-div">
                        <p>Awarded Agency : <?= $achievement['awarded_agency'] ?></p>
                        <p>Award Level : <?= $achievement['award_level'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($student_experience): ?>
            <div class="resume-summery">
                <h5>Experience Details</h5>
                <table>
                    <tr>
                        <th>Designation</th>
                        <th>Name of Organization</th>
                        <th>Organization Type</th>
                        <th>Date of Joining</th>
                        <th>Date of Relieving</th>
                    </tr>
                    <?php foreach ($student_experience as $experience): ?>
                        <tr>
                            <td><?= $experience['designation'] ?></td>
                            <td><?= $experience['organization_name'] ?></td>
                            <td><?= $experience['organization_type'] ?></td>
                            <td><?= date('d-m-Y', strtotime($experience['joining_date'])) ?></td>
                            <td><?= date('d-m-Y', strtotime($experience['releiving_date'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>

            <div class="resume-summery">
                <h5>Additional Details</h5>
                <div class="resume-content-box">
                <?php if (isset($studentSkills)) { ?> <p><b>Skills : </b>
                    <?php foreach ($studentSkills as $skill){ ?>
                        <?= $skill['skills']."," ?>
                    <?php } ?>
                </p>
                <?php } ?>
                <?php if (isset($studentAreaInterest)) { ?> <p><b>Area of Interest : </b>
                    <?php foreach ($studentAreaInterest as $skill){ ?>
                        <?= $skill['area_interest']."," ?>
                    <?php } ?>
                </p>
                <?php } ?>
                <?php if (isset($studentLanguage)) { ?> <p><b>Language : </b>
                    <?php foreach ($studentLanguage as $skill){ ?>
                        <?= $skill['language']."," ?>
                    <?php } ?>
                </p>
                <?php } ?>
                <?php if (isset($studentHobbies)) { ?> <p><b>Hobbies : </b>
                    <?php foreach ($studentHobbies as $skill){ ?>
                        <?= $skill['hobbies']."," ?>
                    <?php } ?>
                </p>
                <?php } ?>
                    
                </div>
            </div>

            <div class="resume-summery">
                <h5>Personal Details</h5>
                <div class="resume-content-box">
                    <div class="justify-div50">
                        <p>Father's Name : <?= $studentData['father_name'] ?></p>
                        <p>Mother's Name : <?= $studentData['mother_name'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Date of Birth : <?= $studentData['date_of_birth'] ?></p>
                        <p>Blood Group : <?= $studentData['blood_group'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Offical Email ID : <?= $studentData['official_mail'] ?></p>
                        <p>Gender : <?= $studentData['gender'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Permanent Address : <?= $studentData['permanent_address'] ?></p>
                        <p>Correspondence Address : <?= $studentData['correspondence_address'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Category : <?= $studentData['category'] ?></p>
                        <p>Religion : <?= $studentData['relegion'] ?> <?php echo $studentData['other_relegion'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Department : <?= $studentDataCourses['department_name'] ?? '' ?></p>
                        <p>Course : <?= $studentDataCourses['program_name'] ?? '' ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Semester : <?= $studentDataCourses['semester'] ?? '' ?></p>
                        <p>Batch : <?= ($batchName['batch_start'] ?? '') . " - " . ($batchName['batch_end'] ?? '') ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>State : <?= $studentData['state'] ?></p>
                        <p>City : <?= $studentData['city'] ?></p>
                    </div>
                    <div class="justify-div50">
                        <p>Pincode : <?= $studentData['pincode'] ?></p>
                    </div>

                    <div class="signature">
                        <p>Signature:</p>
                        <?php if (!empty($studentData['signature']) && file_exists('public/admin/uploads/students/' . $studentData['signature'])){ ?>
                           <img src="<?= base_url() ?>public/admin/uploads/students/<?= $studentData['signature'] ?>" alt="" height="40px">
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="print-button">
            <button type="button" class="btn btn-primary" onclick="PrintMe('print_profile')">Print</button>
        </div>
    </div>
</div>

<script language="javascript">
function PrintMe(DivID) {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=550, height=600, left=100, top=25";
   var content_vlue = document.getElementById(DivID).innerHTML;
   var docprint=window.open("","",disp_setting);
   docprint.document.open();
   docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
   docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
   docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
   docprint.document.write('<head><title>Internal Marks</title>');
   docprint.document.write('<style type="text/css">body{ margin:0px;');
   docprint.document.write('font-family:verdana,Arial;color:#000;');
   docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
   docprint.document.write('p, h3, h4, h5, h6 { margin: 0px; padding: 0px; } .flex-div { display: flex; justify-content: flex-start; /* align-items: center; */ } .justify-div,.justify-div50 { display: flex; justify-content: space-between; align-items: center; } .justify-div p { width: 30%; text-align: left; } .justify-div50 p { width: 50%; text-align: left; } .justify-div h6{ color: #cf1c7e; font-size : 12px } .resume-header img.header-profile-user { width: auto; height: 130px; } .student-personal-details{ margin-left: 10px; } .resume-summery { margin-top: 20px; } .resume-summery h5 { margin-bottom: 10px; color: #00366d; border-bottom: 2px solid #00366d; } table { width: 100%; border-collapse: collapse; } table, th, td { border: 1px solid black; padding: 8px; text-align: left; } th{ font-size: 12px; font-weight: 500; color: #000; } .resume-content-box{ margin-bottom: 10px; } .signature{ margin-top: 60px; } .content-box{ margin-bottom: 20px; } .normal-flex{ display: flex; justify-content: space-between; align-items: center; } .normal-flex div{ padding-right: 30px; font-weight: 500; margin-bottom: 15px; color: #cf1c7e; } .normal-flex h6{ width: 300px; text-align: right; color: #cf1c7e; } .resume-content-box p { font-size: 10px; }');
   docprint.document.write('a{color:#000;text-decoration:none;} </style>');
   docprint.document.write('</head><body onLoad="self.print()">');
   docprint.document.write(content_vlue);
   docprint.document.write('</body></html>');
   docprint.document.close();
   docprint.focus();
 
}
</script>

<?= $this->endSection() ?>