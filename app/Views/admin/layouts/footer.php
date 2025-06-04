                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= date('Y') ?> © NIPER Raebareli
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Design & Develop by Vocman
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Overlay-->
        <div class="menu-overlay"></div>


        <!-- jQuery  -->
        <script src="<?= base_url() ?>public/admin/assets/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/metismenu.min.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/waves.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/simplebar.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url() ?>public/admin/assets/js/theme.js"></script>

         <!-- third party js -->
        <script src="<?= base_url() ?>public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.bootstrap4.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.flash.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/dataTables.select.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>public/admin/plugins/datatables/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!--dropify-->
        <script src="<?= base_url() ?>public/admin/plugins/dropify/dropify.min.js"></script>

        <!-- Init js-->
        <script src="<?= base_url() ?>public/admin/assets/pages/fileuploads-demo.js"></script>

        <!-- Datatables init -->
        <script src="<?= base_url() ?>public/admin/assets/pages/datatables-demos.js"></script>
        <script src="<?= base_url() ?>public/admin/assets/js/adminScript.js"></script>

        <!-- Select2 js -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <!-- Jquery Validation Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
        <!-- jQuery UI Library (must be loaded after jQuery) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- jQuery UI Sortable Script -->
<script>
    $(document).ready(function () {
        $('[id^=sortableTable]').sortable({
            items: "tr",
            cursor: "move",
            update: function(event, ui) {
                const sortedData = [];
                $(this).find('tr').each(function(index) {
                    const headingId = $(this).data('heading-id'); // Ensure `data-heading-id` is set correctly
                    if (headingId) {
                        sortedData.push({ id: headingId, sort_order: index + 1 });
                    }
                });

                console.log(sortedData); // Debug the data being sent
                
                if (sortedData.length > 0) {
                    $.ajax({
                        url: '<?= base_url() ?>admin/save_menu_heading_sort_order', // Update with your route
                        method: 'POST',
                        data: JSON.stringify(sortedData), // Convert the array into JSON string
                        contentType: 'application/json', 
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseJSON.error);
                        }
                    });
                } else {
                    console.error("No data to send");
                }
            }
        });




        // Enable sortable for .mytable within #sortableTable rows
        $('.mytable').sortable({
            items: "tr",
            cursor: "move",
            update: function (event, ui) {
                const sortedPagesData = [];
                $(this).find('tr').each(function (index) {
                    const pageId = $(this).data('page-id');
                    if (pageId) {
                        sortedPagesData.push({ id: pageId, sort_order: index + 1 });
                    }
                });
                console.log("Updated .mytable order:", sortedPagesData);
                if (sortedPagesData.length > 0) {
                    $.ajax({
                        url: '<?= base_url() ?>admin/save_menu_page_sort_order', // Update with your route
                        method: 'POST',
                        data: JSON.stringify(sortedPagesData), // Convert the array into JSON string
                        contentType: 'application/json', 
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseJSON.error);
                        }
                    });
                } else {
                    console.error("No data to send");
                }
            }
        });
    });


</script>
        
            
        
        <script>
            const editors = ['#editor', '#editor2', '#editor3', '#editor4'];

            editors.forEach(selector => {
                ClassicEditor
                    .create(document.querySelector(selector))
                    .catch(error => {
                        console.error(error);
                    });
            });



            $(document).ready(function () {
                // Create Service Clone for add and remove rows also calculate price
                var cloneLimit = 10;
                var currentClones = 0;
                $("#addnewservicerow").click(function(e){
                    e.preventDefault();
                    if (currentClones < cloneLimit) {
                        currentClones++;
                        var cloneCatrow = $('#stockTrow').clone().appendTo('#stockTbody');
                        $(cloneCatrow).find('input').val('');
                    }
                    
                });
                $("#addnewexpenserow").click(function(e){
                    e.preventDefault();
                        var cloneExpCatrow = $('#expenseTrow').clone().appendTo('#expenseTbody');
                        $(cloneExpCatrow).find('input').val('');
                });

                $('#stockTbody').on('click','#removenewServicerow', function(){
                    $(this).closest('tr').remove();
                });
                $('#expenseTbody').on('click','#removenewExpenserow', function(){
                    $(this).closest('tr').remove();
                });

                // $('#assign_page_btn').on('click', function() {
                //     $('#assign_page_model').modal('show');
                // });


            });

            
        </script>

    <script>
        $(document).ready(function() {
            $('.my-select').select2({
                placeholder: "--Select--",
                allowClear: true,
                width: '100%'
            });
        });
  </script>


    </body>

</html>