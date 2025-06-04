<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->post('fetch-programs', 'UniversalController::fetch_programs');
$routes->post('fetch_menu_heading', 'UniversalController::fetch_menu_heading');
$routes->post('get_event_fee_category', 'UniversalController::get_event_fee_category');
$routes->post('get_event_fee_subcategory', 'UniversalController::get_event_fee_subcategory');
$routes->post('getStates', 'UniversalController::getStates');
$routes->post('getCourseByDepartment', 'UniversalController::getCourseByDepartment');
$routes->post('getFacilitySection', 'UniversalController::getFacilitySection');
$routes->post('get-answer-options', 'UniversalController::get_answer_options');
$routes->post('findcity', 'UniversalController::findcity');
$routes->get('get-job-restult-stage/(:num)', 'UniversalController::get_job_restult_stage/$1');
$routes->post('fetch-instrument-by-department', 'UniversalController::fetch_instrument_by_department');
$routes->get('testmail', 'UniversalController::testmail');


$routes->match(['get','post'],'admin/login', 'AdminControllers::adminLogin');
$routes->group('admin',['filter'=>'adminLogin'], static function($routes){
    $routes->get('/', 'AdminControllers::adminDashboard');
    $routes->get('logout', 'AdminControllers::logout');

    $routes->match(['get','post'],'news-post', 'NewsController::news_post');
    $routes->match(['get','post'],'edit-news-post/(:num)', 'NewsController::edit_news_post/$1');
    $routes->get('delete-news-post/(:num)', 'NewsController::delete_news_post/$1');

    $routes->match(['get','post'],'event-post', 'EventsController::event_post');
    $routes->match(['get','post'],'edit-event-post/(:num)', 'EventsController::edit_event_post/$1');
    $routes->get('delete-event-post/(:num)', 'EventsController::delete_event_post/$1');

    $routes->match(['get','post'],'event-link', 'EventsController::event_link');
    $routes->match(['get','post'],'edit-event-link/(:num)', 'EventsController::edit_event_link/$1');
    $routes->get('delete-event-link/(:num)', 'EventsController::delete_event_link/$1');

    $routes->match(['get','post'],'event-video', 'EventsController::event_video');
    $routes->match(['get','post'],'edit-event-video/(:num)', 'EventsController::edit_event_video/$1');
    $routes->get('delete-event-video/(:num)', 'EventsController::delete_event_video/$1');

    $routes->match(['get','post'],'event-extension-notice', 'EventsController::event_extension_notice');
    $routes->match(['get','post'],'edit-event-extension-notice/(:num)', 'EventsController::edit_event_extension_notice/$1');
    $routes->get('delete-event-extension-notice/(:num)', 'EventsController::delete_event_extension_notice/$1');
    
    $routes->match(['get','post'],'event-members', 'EventsController::event_members');
    $routes->match(['get','post'],'edit-event-members/(:num)', 'EventsController::edit_event_members/$1');
    $routes->get('delete-event-members/(:num)', 'EventsController::delete_event_members/$1');

    $routes->match(['get','post'],'event-organizer', 'EventsController::event_organizer');
    $routes->match(['get','post'],'edit-event-organizer/(:num)', 'EventsController::edit_event_organizer/$1');
    $routes->get('delete-event-organizer/(:num)', 'EventsController::delete_event_organizer/$1');


    $routes->match(['get','post'],'event-fees', 'EventsController::event_fees');
    $routes->match(['get','post'],'edit-event-fees/(:num)', 'EventsController::edit_event_fees/$1');
    $routes->match(['get','post'],'delete-event-fees/(:num)', 'EventsController::delete_event_fees/$1');


    $routes->match(['get','post'],'event-highlight', 'EventsController::event_highlight');
    $routes->match(['get','post'],'edit-event-highlight/(:num)', 'EventsController::edit_event_highlight/$1');
    $routes->get('delete-event-highlight/(:num)', 'EventsController::delete_event_highlight/$1');

    $routes->match(['get','post'],'event-category', 'EventsController::event_category');
    $routes->match(['get','post'],'edit-event-category/(:num)', 'EventsController::edit_event_category/$1');
    $routes->get('delete-event-category/(:num)', 'EventsController::delete_event_category/$1');

    $routes->match(['get','post'],'event-fee-category', 'EventsController::event_fee_category');
    $routes->match(['get','post'],'edit-event-fee-category/(:num)', 'EventsController::edit_event_fee_category/$1');
    $routes->get('delete-event-fee-category/(:num)', 'EventsController::delete_event_fee_category/$1');

    $routes->match(['get','post'],'event-fee-subcategory', 'EventsController::event_fee_subcategory');
    $routes->match(['get','post'],'edit-event-fee-subcategory/(:num)', 'EventsController::edit_event_fee_subcategory/$1');
    $routes->match(['get','post'],'delete-event-fee-subcategory/(:num)', 'EventsController::delete_event_fee_subcategory/$1');

    $routes->match(['get','post'],'event-contact-info', 'EventsController::event_contact_info');
    $routes->match(['get','post'],'edit-event-contact-info/(:num)', 'EventsController::edit_event_contact_info/$1');
    $routes->get('delete-event-contact-info/(:num)', 'EventsController::delete_event_contact_info/$1');

    $routes->match(['get','post'],'member_type_category', 'EventsController::member_type_category');
    $routes->match(['get','post'],'edit_member_type_category/(:num)', 'EventsController::edit_member_type_category/$1');
    $routes->get('delete_member_type_category/(:num)', 'EventsController::delete_member_type_category/$1');
    
    $routes->match(['get','post'],'accouncement', 'AcademicControllers::accouncement');
    $routes->match(['get','post'],'classified-mou-value', 'AcademicControllers::classified_mou_value');
    $routes->match(['get','post'],'academic-details', 'AcademicControllers::academic_details');
    // $routes->match(['get','post'],'achievements', 'AdminControllers::achievements');
    $routes->match(['get','post'],'admission-brochure', 'AcademicControllers::admission_brochure');
    $routes->match(['get','post'],'testimonial', 'AdminControllers::testimonial');
    $routes->match(['get','post'],'research-publication', 'AcademicControllers::research_publication');
    $routes->match(['get','post'],'research-publication-type', 'AcademicControllers::research_publication_type');
    $routes->match(['get','post'],'faculty-awards', 'AchievementsController::faculty_awards');
    $routes->match(['get','post'],'awards-recognition', 'AchievementsController::awards_recognition');
    $routes->match(['get','post'],'student-achievements', 'AchievementsController::student_achievements');

    $routes->match(['get','post'],'employee', 'EmployeeController::employee');
    $routes->match(['get','post'],'edit-employee/(:num)', 'EmployeeController::edit_employee/$1');
    $routes->match(['get','post'],'delete-employee/(:num)', 'EmployeeController::delete_employee/$1');
    $routes->match(['get','post'],'employee-details/(:num)', 'EmployeeController::employee_details/$1');

    // $routes->match(['get','post'],'employee-department', 'AdminControllers::employee_department');
    $routes->match(['get','post'],'employee-experience', 'EmployeeController::employee_experience');
    $routes->match(['get','post'],'edit-employee-experience/(:num)', 'EmployeeController::edit_employee_experience/$1');
    $routes->match(['get','post'],'delete-employee-experience/(:num)', 'EmployeeController::delete_employee_experience/$1');

    $routes->match(['get','post'],'employee-projects', 'EmployeeController::employee_projects');
    $routes->match(['get','post'],'edit-employee-projects/(:num)', 'EmployeeController::edit_employee_projects/$1');
    $routes->match(['get','post'],'delete-employee-projects/(:num)', 'EmployeeController::delete_employee_projects/$1');

    $routes->match(['get','post'],'employee-publication', 'EmployeeController::employee_publication');
    $routes->match(['get','post'],'edit-employee-publication/(:num)', 'EmployeeController::edit_employee_publication/$1');
    $routes->get('delete-employee-publication/(:num)', 'EmployeeController::delete_employee_publication/$1');
    $routes->get('deletPubAuthor/(:num)', 'EmployeeController::deletPubAuthor/$1');
    $routes->post('addnewpubauthor', 'EmployeeController::addnewpubauthor');

    $routes->match(['get','post'],'employee-awards', 'EmployeeController::employee_awards');
    $routes->match(['get','post'],'edit-employee-awards/(:num)', 'EmployeeController::edit_employee_awards/$1');
    $routes->get('delete-employee-awards/(:num)', 'EmployeeController::delete_employee_awards/$1');

    $routes->match(['get','post'],'employee-charge', 'EmployeeController::employee_charge');
    $routes->get('get-employee-designations/(:num)', 'EmployeeController::getEmployeeDesignations/$1');
    $routes->match(['get','post'],'organisation-type', 'EmployeeController::organisation_type');
    $routes->match(['get','post'],'edit-organisation-type/(:num)', 'EmployeeController::edit_organisation_type/$1');
    $routes->get('delete-organisation-type/(:num)', 'EmployeeController::delete_organisation_type/$1');

    $routes->match(['get','post'],'work-nature', 'EmployeeController::work_nature');
    $routes->match(['get','post'],'edit-work-nature/(:num)', 'EmployeeController::edit_work_nature/$1');
    $routes->get('delete-work-nature/(:num)', 'EmployeeController::delete_work_nature/$1');

    $routes->match(['get','post'],'employee-nature', 'EmployeeController::employee_nature');
    $routes->match(['get','post'],'edit-employee-nature/(:num)', 'EmployeeController::edit_employee_nature/$1');
    $routes->get('delete-employee-nature/(:num)', 'EmployeeController::delete_employee_nature/$1');

    $routes->match(['get','post'],'book-chapter', 'EmployeeController::book_chapter');
    
    $routes->match(['get','post'],'employee-patent', 'EmployeeController::employee_patent');
    $routes->match(['get','post'],'edit-employee-patent/(:num)', 'EmployeeController::edit_employee_patent/$1');
    $routes->get('delete-employee-patent/(:num)', 'EmployeeController::delete_employee_patent/$1');

    $routes->match(['get','post'],'employee-academic-details', 'EmployeeController::employee_academic_details');
    $routes->match(['get','post'],'edit-employee-academic-details/(:num)', 'EmployeeController::edit_employee_academic_details/$1');
    $routes->get('delete-employee-academic-details/(:num)', 'EmployeeController::delete_employee_academic_details/$1');

    $routes->match(['get','post'],'emp-other-academic-details', 'EmployeeController::employee_other_academic_details');
    $routes->match(['get','post'],'edit-emp-other-academic-details/(:num)', 'EmployeeController::edit_emp_other_academic_details/$1');
    $routes->get('delete-emp-other-academic-details/(:num)', 'EmployeeController::delete_emp_other_academic_details/$1');

    $routes->match(['get','post'],'phd-detail', 'EmployeeController::phd_detail');
    $routes->match(['get','post'],'mphil-ug-pg-detail', 'EmployeeController::mphil_ug_pg_detail');
    $routes->match(['get','post'],'ongoing-phd', 'EmployeeController::ongoing_phd');
    $routes->match(['get','post'],'course-tought', 'EmployeeController::course_tought');
    $routes->match(['get','post'],'emp-fellowship', 'EmployeeController::emp_fellowship');
    $routes->match(['get','post'],'employee-seed-money', 'EmployeeController::employee_seed_money');
    $routes->match(['get','post'],'employee-collaboration', 'EmployeeController::employee_collaboration');
    $routes->match(['get','post'],'employee-mou', 'EmployeeController::employee_mou');
    $routes->match(['get','post'],'employee-seminar-conference', 'EmployeeController::employee_seminar_conference');
    $routes->match(['get','post'],'employee-talk-poster', 'EmployeeController::employee_talk_poster');

    $routes->match(['get','post'],'other-faculty', 'Adjunt_facultyController::other_faculty');
    $routes->match(['get','post'],'adjunt-faculty-webpage', 'Adjunt_facultyController::adjunt_faculty_webpage');
    $routes->match(['get','post'],'adjunt-faculty-notification', 'Adjunt_facultyController::adjunt_faculty_notification');
    $routes->match(['get','post'],'adjunt-faculty-video', 'Adjunt_facultyController::adjunt_faculty_video');

    $routes->match(['get','post'],'facility-page', 'FacilityController::facility_page');
    $routes->match(['get','post'],'edit-facility-page/(:num)', 'FacilityController::edit_facility_page/$1');
    $routes->match(['get','post'],'delete-facility-page/(:num)', 'FacilityController::delete_facility_page/$1');

    $routes->match(['get','post'],'facilty-services', 'FacilityController::facilty_services');
    $routes->match(['get','post'],'facility-notification', 'FacilityController::facility_notification');
    $routes->match(['get','post'],'facility-banner', 'FacilityController::facility_banner');
    $routes->match(['get','post'],'facility-instruments', 'FacilityController::facility_instruments');
    $routes->match(['get','post'],'facility-section', 'FacilityController::facility_section');
    $routes->match(['get','post'],'mapping-facility-page/(:num)', 'FacilityController::mapping_facility_page/$1');
    $routes->get('delete-mapping-facility-page/(:num)', 'FacilityController::delete_mapping_facility_page/$1');
    $routes->match(['get','post'],'facility-section-file', 'FacilityController::facility_section_file');
    $routes->match(['get','post'],'facility-section-image', 'FacilityController::facility_section_image');

    $routes->match(['get','post'],'images', 'AdminControllers::images');
    $routes->match(['get','post'],'photo-album', 'AdminControllers::photo_album');
    $routes->match(['get','post'],'media', 'AdminControllers::media');
    $routes->match(['get','post'],'contact', 'AdminControllers::contact');
    $routes->match(['get','post'],'download-forms', 'AdminControllers::download_forms');
    $routes->match(['get','post'],'quick-link', 'AdminControllers::quick_link');
    $routes->match(['get','post'],'assign-quick-link', 'AdminControllers::assign_quick_link');
    $routes->match(['get','post'],'youtube-link', 'AdminControllers::youtube_link');
    $routes->match(['get','post'],'rules-regulations', 'AcademicControllers::rules_regulations');
    $routes->match(['get','post'],'departments-section', 'DepartmentController::departments_section');
    $routes->match(['get','post'],'department-research-area', 'DepartmentController::department_research_area');
    $routes->match(['get','post'],'departments-photos', 'DepartmentController::departments_photos');
    $routes->match(['get','post'],'designation', 'DesignationController::designation');
    $routes->match(['get','post'],'program', 'ProgramController::program');
    $routes->match(['get','post'],'program-dept-mapping', 'ProgramController::program_dept_mapping');
    $routes->match(['get','post'],'membership', 'AdminControllers::membership');
    $routes->match(['get','post'],'banner-slider', 'AdminControllers::banner_slider');
    $routes->match(['get','post'],'tendor-details', 'TendorControllers::tendor_details');
    $routes->match(['get','post'],'tendor-page', 'TendorControllers::tendor_page');
    $routes->match(['get','post'],'tendor-corrigendum', 'TendorControllers::tendor_corrigendum');
    $routes->match(['get','post'],'admission', 'AdminControllers::admission');
    $routes->match(['get','post'],'act-rules', 'AdminControllers::act_rules');
    $routes->match(['get','post'],'act-rules-category', 'AdminControllers::act_rules_category');
    $routes->match(['get','post'],'policy-details', 'AdminControllers::policy_details');

    $routes->match(['get','post'],'governmental-link', 'AdminControllers::governmental_link');
    $routes->match(['get','post'],'edit-governmental-link/(:num)', 'AdminControllers::edit_governmental_link/$1');
    $routes->match(['get','post'],'delete-governmental-link/(:num)', 'AdminControllers::delete_governmental_link/$1');

    $routes->match(['get','post'],'newsletter', 'AdminControllers::newsletter');
    
    $routes->match(['get','post'],'flash-news', 'AdminControllers::flash_news');

    $routes->match(['get','post'],'achievements', 'AdminControllers::achievements');

    $routes->match(['get','post'],'job-details', 'JobControllers::job_details');
    $routes->match(['get','post'],'job-extension', 'JobControllers::job_extension');
    $routes->match(['get','post'],'job-web-link', 'JobControllers::job_web_link');
    $routes->match(['get','post'],'job-video', 'JobControllers::job_video');
    $routes->match(['get','post'],'job-result', 'JobControllers::job_result');
    $routes->match(['get','post'],'job-category', 'JobControllers::job_category');
    $routes->match(['get','post'],'result-category', 'JobControllers::result_category');

    $routes->match(['get','post'],'about', 'AdminControllers::about');
    $routes->match(['get','post'],'bog', 'AdminControllers::bog');
    $routes->match(['get','post'],'bog-member', 'AdminControllers::bog_member');
    $routes->match(['get','post'],'update-bog-member-order', 'AdminControllers::update_bog_member_order');
    $routes->match(['get','post'],'leadership-and-media-link', 'AdminControllers::leadership_and_media_link');

    $routes->match(['get', 'post'], 'collaboration', 'AcademicControllers::collaboration');
    $routes->match(['get', 'post'], 'committee-details', 'CommitteeController::committee_details');
    $routes->match(['get', 'post'], 'copyright-details', 'CopyrightController::copyright_details');
    $routes->match(['get', 'post'], 'patent-details', 'PatentController::patent_details');
    $routes->match(['get', 'post'], 'patent-web-page', 'PatentController::patent_web_page');
    $routes->match(['get', 'post'], 'patent-type', 'PatentController::patent_type');
    $routes->match(['get', 'post'], 'current-status', 'PatentController::current_status');

    // Admission Rotes ----------------------
    $routes->match(['get', 'post'], 'admission-page', 'AdmissionController::admission_page');
    $routes->match(['get', 'post'], 'admission-page-section', 'AdmissionController::admission_page_section');
    $routes->match(['get', 'post'], 'admission-section-image', 'AdmissionController::admission_section_image');
    $routes->match(['get', 'post'], 'admission-section-file', 'AdmissionController::admission_section_file');

    // Student Routes /----------------------------
    $routes->match(['get', 'post'], 'students', 'StudentController::students');
    $routes->match(['get','post'],'program-dept-std-mapping', 'StudentController::program_dept_std_mapping');
    $routes->post('export_student', 'StudentController::export_student');
    $routes->post('upload_student_csv', 'StudentController::upload_student_csv');

    // Placement Routes ----------------------
    $routes->match(['get', 'post'], 'placement-company-details', 'PlacementController::company_details');
    $routes->get('delete-placement-company-details/(:num)', 'PlacementController::delete_placement_company_details/$1');
    $routes->match(['get', 'post'], 'company-contact-person', 'PlacementController::company_contact_person');
    $routes->get('delete-company-contact-person/(:num)', 'PlacementController::delete_company_contact_person/$1');
    $routes->match(['get', 'post'], 'placement-job-details', 'PlacementController::job_details');
    $routes->get('delete-placement-job-details/(:num)', 'PlacementController::delete_placement_job_details/$1');
    $routes->match(['get', 'post'], 'result-details', 'PlacementController::result_details');
    $routes->get('delete-result-details/(:num)', 'PlacementController::delete_result_details/$1');
    $routes->match(['get', 'post'], 'job-student-mapping', 'PlacementController::job_student_mapping');
    $routes->match(['get', 'post'], 'job-result-stage-mapping', 'PlacementController::job_result_stage_mapping');
    $routes->get('delete-job-result-stage-mapping/(:num)', 'PlacementController::delete_job_result_stage_mapping/$1');
    $routes->match(['get', 'post'], 'student-result-mapping', 'PlacementController::student_result_mapping');
    $routes->get('delete-student-result-mapping/(:num)', 'PlacementController::delete_student_result_mapping/$1');
    $routes->match(['get', 'post'], 'placement-page-notification-details', 'PlacementController::page_notification_details');
    $routes->get('delete-placement-page-notification-details/(:num)', 'PlacementController::delete_placement_page_notification_details/$1');
    $routes->match(['get', 'post'], 'placement-page-section-details', 'PlacementController::page_section_details');
    $routes->get('delete-placement-page-section/(:num)', 'PlacementController::delete_placement_page_section/$1');
    $routes->match(['get', 'post'], 'placement-page-gallery', 'PlacementController::page_gallery');
    $routes->get('delete-placement-page-gallery/(:num)', 'PlacementController::delete_placement_page_gallery/$1');

    // Alumini Model
    $routes->match(['get', 'post'],'alumini-page-notification', 'AluminiController::alumini_page_notification');
    $routes->get('delete-alumini-page-notification/(:num)', 'AluminiController::delete_alumini_page_notification/$1');
    $routes->match(['get', 'post'],'alumini-page-section', 'AluminiController::alumini_page_section');
    $routes->get('delete-alumini-page-section/(:num)', 'AluminiController::delete_alumini_page_section/$1');
    $routes->match(['get', 'post'],'alumini-page-gallery', 'AluminiController::alumini_page_gallery');
    $routes->get('delete-alumini-page-gallery/(:num)', 'AluminiController::delete_alumini_page_gallery/$1');
    $routes->match(['get', 'post'],'alumini-page-video', 'AluminiController::alumini_page_video');
    $routes->get('delete-alumini-page-video/(:num)', 'AluminiController::delete_alumini_page_video/$1');
    $routes->match(['get', 'post'],'alumini-education-detail', 'AluminiController::alumini_education_detail');
    $routes->match(['get', 'post'],'alumini-job-details', 'AluminiController::alumini_job_details');
    // $routes->match(['get', 'post'],'export_student', 'AluminiController::export_student');

    // Instrument Slotes ----------------------
    $routes->match(['get', 'post'], 'create-instrument-slots', 'InstrumentSlotController::create_instrument_slots');
    $routes->get('fetch-instrument-slots', 'InstrumentSlotController::fetch_instrument_slots');
    $routes->get('delete-instrument-slots/(:num)', 'InstrumentSlotController::delete_instrument_slots/$1');
    $routes->match(['get', 'post'], 'instrument-booking-report', 'InstrumentSlotController::instrument_booking_report');

    $routes->match(['get', 'post'], 'convocation', 'ConvocationControllers::convocation');

    $routes->match(['get', 'post'], 'result', 'ResultGradeControllers::result');
    $routes->match(['get', 'post'], 'grades', 'ResultGradeControllers::grades');
    $routes->match(['get', 'post'], 'result-grades-notice', 'ResultGradeControllers::result_grades_notice');

    $routes->match(['get', 'post'], 'currecnt-session', 'AdminControllers::currecnt_session');
    $routes->match(['get', 'post'], 'ranking', 'RankingControllers::ranking');
    $routes->match(['get', 'post'], 'annual-report', 'AdminControllers::annual_report');
    $routes->match(['get', 'post'], 'placement-details', 'AdminControllers::placement_details');
    $routes->match(['get', 'post'], 'recuiter-details', 'AdminControllers::recuiter_details');
    $routes->match(['get', 'post'], 'instrument-facility', 'AdminControllers::instrument_facility');
    $routes->match(['get', 'post'], 'instrument-rates', 'AdminControllers::instrument_rates');
    $routes->match(['get', 'post'], 'private-research-labs', 'AdminControllers::private_research_labs');

    $routes->match(['get','post'],'form-details', 'DynamicformControllers::form_details');
    $routes->match(['get','post'],'form-section', 'DynamicformControllers::form_section');
    $routes->match(['get','post'],'question-type', 'DynamicformControllers::question_type');
    $routes->match(['get','post'],'mapping-question/(:num)', 'DynamicformControllers::mapping_question/$1');
    $routes->match(['get','post'],'manage-questions/(:num)', 'DynamicformControllers::manage_questions/$1');

    $routes->match(['get', 'post'], 'modules', 'AdminControllers::modules');
    $routes->match(['get', 'post'], 'roles-permissions', 'AdminControllers::roles_permissions');
    $routes->match(['get', 'post'], 'permission/(:num)', 'AdminControllers::permission/$1');
    $routes->match(['get', 'post'], 'menu', 'AdminControllers::menu');
    $routes->post('menu-heading', 'AdminControllers::menu_heading');
    $routes->post('save_menu_heading_sort_order', 'AdminControllers::save_menu_heading_sort_order');
    $routes->post('save_pages', 'AdminControllers::save_pages');
    $routes->post('save_menu_page_sort_order', 'AdminControllers::save_menu_page_sort_order');
    
    $routes->match(['get', 'post'], 'courseList', 'CourseController::courseList');
    $routes->match(['get', 'post'], 'assignCourseList', 'CourseController::assignCourseList');
    $routes->match(['get', 'post'], 'edit-assign-course/(:num)', 'CourseController::edit_assign_course/$1');
    $routes->get('delete-assign-course/(:num)', 'CourseController::delete_assign_course/$1');
    // Export and Import routes
    $routes->post('export_emp_experience_sample', 'EmployeeController::export_emp_experience_sample');
    $routes->post('upload_emp_experience_csv', 'EmployeeController::upload_emp_experience_csv');

    $routes->post('export_emp_project_sample', 'EmployeeController::export_emp_project_sample');
    $routes->post('upload_emp_project_csv', 'EmployeeController::upload_emp_project_csv');

    $routes->post('export_emp_award_sample', 'EmployeeController::export_emp_award_sample');
    $routes->post('upload_emp_award_csv', 'EmployeeController::upload_emp_award_csv');

    $routes->post('export_emp_publication_sample', 'EmployeeController::export_emp_publication_sample');
    $routes->post('upload_emp_publication_csv', 'EmployeeController::upload_emp_publication_csv');
    
});


$routes->match(['get','post'],'stdlogin/', 'student\AuthController::login');
$routes->match(['get','post'],'forget-password', 'student\AuthController::forget_password');
$routes->match(['get','post'],'reset-password/(:any)', 'student\AuthController::reset_password/$1');
$routes->group('student',['filter'=>'studentLogin'], static function($routes){
    $routes->get('/', 'student\StudentController::index');
    $routes->get('logout', 'student\AuthController::logout');

    $routes->get('student-profile', 'student\StudentController::student_profile');
    $routes->get('resume-details', 'student\StudentController::resume_details');
    $routes->post('student-skills', 'student\StudentController::student_skills');
    $routes->post('student-area-interest', 'student\StudentController::student_area_interest');
    $routes->post('student-language', 'student\StudentController::student_language');
    $routes->post('student-hobbies', 'student\StudentController::student_hobbies');

    $routes->get('delete-skills/(:num)', 'student\StudentController::delete_skills/$1');
    $routes->get('delete-area-interest/(:num)', 'student\StudentController::delete_area_interest/$1');
    $routes->get('delete-language/(:num)', 'student\StudentController::delete_language/$1');
    $routes->get('delete-hobbies/(:num)', 'student\StudentController::delete_hobbies/$1');

    $routes->match(['get','post'],'personal-details', 'student\StudentController::personal_details');
    $routes->match(['get','post'],'academic-details', 'student\StudentController::academic_details');
    $routes->get('delete-academic-details/(:num)', 'student\StudentController::delete_academic_details/$1');
    $routes->match(['get','post'],'phd-details', 'student\StudentController::phd_details');
    $routes->get('delete-phd-details/(:num)', 'student\StudentController::delete_phd_details/$1');
    $routes->match(['get','post'],'publication-details', 'student\StudentController::publication_details');
    $routes->get('delete-publication-details/(:num)', 'student\StudentController::delete_publication_details/$1');
    $routes->match(['get','post'],'book-chapter-details', 'student\StudentController::book_chapter_details');
    $routes->get('delete-book-chapter-details/(:num)', 'student\StudentController::delete_book_chapter_details/$1');
    $routes->match(['get','post'],'patent-details', 'student\StudentController::patent_details');
    $routes->get('delete-patent-details/(:num)', 'student\StudentController::delete_patent_details/$1');
    $routes->match(['get','post'],'conference-workshop-details', 'student\StudentController::conference_workshop_details');
    $routes->get('delete-conference-workshop-details/(:num)', 'student\StudentController::delete_conference_workshop_details/$1');
    $routes->match(['get','post'],'copyright-details', 'student\StudentController::copyright_details');
    $routes->get('delete-copyright-details/(:num)', 'student\StudentController::delete_copyright_details/$1');
    $routes->match(['get','post'],'achievement-details', 'student\StudentController::achievement_details');
    $routes->get('delete-achievement-details/(:num)', 'student\StudentController::delete_achievement_details/$1');
    $routes->match(['get','post'],'experience-details', 'student\StudentController::experience_details');
    $routes->get('delete-experience-details/(:num)', 'student\StudentController::delete_experience_details/$1');
});