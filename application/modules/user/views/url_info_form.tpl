<!DOCTYPE html>
<html
   lang="en"
   class="light-style layout-menu-fixed layout-menu-collapsed layout-navbar-fixed"
   dir="ltr"
   data-theme="theme-default"
   data-assets-path="<%$base_url%>public/assets/"
   data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><%$config['company_name']%></title>
    <meta name="description" content="" />
    <base href="<%base_url()%>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<%base_url()%><%$config['company_fav_icon']%>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/fonts/boxicons.css" />

    <!-- Line Awesome -->
    <link rel="stylesheet" href="<%$base_url%>public/css/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="<%$base_url%>public/css/plugin/tabler_css/tabler_icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<%$base_url%>public/assets/css/theme.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<%$base_url%>public/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="<%$base_url%>public/css/common.css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="<%$base_url%>public/css/data_table/datatable.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="<%base_url()%>public/plugin/datepicker/daterangepicker.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/css/fontawesome/font_awesome.css">

    <!-- Scripts -->
    <script src="<%$base_url%>public/assets/js/config.js"></script>
    <script src="<%$base_url%>public/assets/vendor/js/bootstrap.js"></script>
    <script src="<%$base_url%>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<%$base_url%>public/js/admin/plugin/jquery.min.js"></script>
    <script src="<%$base_url%>public/js/admin/plugin/jquery.validate.js"></script>

    <!-- DataTables Scripts -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <!-- PDF & ZIP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   

    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <!-- Date Picker -->
    <script src="<%base_url()%>public/plugin/datepicker/moment.min.js"></script>
    <script src="<%base_url()%>public/plugin/datepicker/daterangepicker.min.js"></script>

    <!-- Grid Structure -->
    <script src="<%base_url()%>public/js/admin/grid_structure.js"></script>
    <!-- toastr -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <!-- toastr -->
    <script type="text/javascript">
        var theme_color = "#ea1c31";
        var default_page_view_type = <%json_decode($config['default_page_view_type'])|@json_encode%>;
        var base_url = <%$base_url|@json_encode%>;
    </script>
<style>
.header-div {
  height: 100px;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #e8d9d97d; /* Optional, for background color */
}

.logo {
  margin-right: 10px; /* Space between logo and company name */
  height: 60px;
}

.company-name {
  font-size: 24px;
  font-weight: bold;
  color: #333; /* Adjust the color as needed */
}

</style>
</head>
<body>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-0 mt-4 w-100">
        <div class="header-div">
            <img src="<%base_url()%><%$config['company_fav_icon']%>" alt="Company Logo" class="logo">
            <span class="company-name">Code Crafter</span>
        </div>


         <div class="p-3">
                <form action="<%base_url()%>submit_form" method="POST" class="container mt-4 custom-form submit_form" id="submit_form">
                    <input type="hidden" name="matser_id" value="<%$form_data['school_id']%>">
                    <input type="hidden" name="from_url" value="<%$form_data['url']%>">
                    <div class="row">
                        <%foreach $form_fields as $field%>
                            <%if $field['field_data']['form_type'] eq 'input'%>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="name" class="form-label"><%$field['field_data']['form_title']%><%if $field['required'] eq 'Yes'%><span class="text-danger ms-1">*</span><%/if%></label>
                                    <%if $field['field_data']['prefix'] != ""%>
                                        <div class="input-group mb-3">
                                        <span class="input-group-text"><%$field['field_data']['prefix']%></span>
                                        <div class="form-floating">
                                    <%/if%>
                                    <input 
                                    type="<%if $field['field_data']['field_type'] eq 'Date'%>date<%else%>text<%/if%>" 
                                    class="form-control <%if $field['required'] eq 'Yes'%>required-input<%/if%> 
                                    <%if $field['field_data']['field_type'] eq 'Number'%>
                                    onlyNumericInput
                                    <%else if $field['field_data']['field_type'] eq 'Uppecase'%>
                                    onlyUpperCase
                                    <%else if $field['field_data']['field_type'] eq 'AlphaNumeric'%>
                                    onlyAlphaNumeric
                                    <%/if%>"  
                                    name="<%$field['field_data']['form_name']%>" 
                                    placeholder="Enter <%strtolower($field['field_data']['form_title'])%>" 
                                    data-length="<%$field['field_data']['length']%>" >
                                    <%if $field['field_data']['prefix'] != ""%>
                                       </div>
                                        </div>
                                    <%/if%>
                                </div>
                            <%else if $field['field_data']['form_type'] eq 'radio'%>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="name" class="form-label"><%$field['field_data']['form_title']%><%if $field['required'] eq 'Yes'%><span class="text-danger ms-1">*</span><%/if%></label>
                                    <div class="radio-option">
                                        <%foreach from=$field['field_data']['form_value'] key=key item="values"%>
                                        <div class="form-check form-check-inline mt-2">
                                          <input class="form-check-input <%if $field['required'] eq 'Yes'%>required-input<%/if%>" type="radio" name="<%$field['field_data']['form_name']%>"  value="<%trim($values)%>">
                                          <label class="form-check-label" for="<%$field['field_data']['form_name']%><%$key%>"><%$values%></label>
                                        </div>
                                        <%/foreach%>
                                    </div>
                                </div>
                            <%else if $field['field_data']['form_type'] eq 'drop_down'%>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="name" class="form-label"><%$field['field_data']['form_title']%><%if $field['required'] eq 'Yes'%><span class="text-danger ms-1">*</span><%/if%></label>
                                    <div class="radio-option">
                                        <select class="<%if $field['required'] eq 'Yes'%>required-input<%/if%> select2"  name="<%$field['field_data']['form_name']%>">
                                        <option value="">Select <%$field['field_data']['form_title']%></option>
                                        <%foreach from=$field['field_data']['form_value'] key=key item="values"%>
                                        <option value="<%trim($values)%>"><%$values%></option>
                                        <%/foreach%>
                                        </select>
                                    </div>
                                </div>
                            <%else if $field['field_data']['form_type'] eq 'file'%>
                                <div class="col-md-4 form-group mb-3">
                                    <label for="name" class="form-label"><%$field['field_data']['form_title']%><%if $field['required'] eq 'Yes'%><span class="text-danger ms-1">*</span><%/if%></label>
                                    <input type="file" class="form-control <%if $field['required'] eq 'Yes'%>required-input<%/if%>"  name="<%$field['field_data']['form_name']%>" placeholder="Enter <%strtolower($field['field_data']['form_title'])%>">
                                </div>
                            <%/if%>

                        <%/foreach%>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<style type="text/css">
    .form-label{
        width: 100%;
        margin-left: 0;
        /* color: var(--gray-color-700); */
        /* font-family: 'Poppins'; */
        /* font-style: normal; */
        font-weight: 400;
        font-size: 14px;
        color: #000;
    }
    form input[type="text"], form input[type="password"], form input[type="datetime"], form input[type="datetime-local"], form input[type="date"], form input[type="month"], form input[type="time"], form input[type="week"], form input[type="number"], form input[type="email"], form input[type="url"], form input[type="search"], form input[type="tel"], form input[type="color"], .uneditable-input, form textarea, .chosen-container-single .chosen-single{
        height: 43px !important;
        margin: 0;
        border-radius: 5px !important;
        padding: 0 20px !important;
        /*width: calc(100% - 60px) !important;*/
    }
    .form-floating>.form-control, .form-floating>.form-control-plaintext, .form-floating>.form-select {
    height: calc(3.5rem + calc(var(--bs-border-width)* 2));
            min-height: unset !important;
    }
</style>
<script src="<%$base_url%>public/js/form_master/form_submit.js"></script>
</html>
