
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
 

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Data Management
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Form Field Master</em></a>
          </h1>
          <br>
          <span >Listing</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      	 <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#AddPromo" title="Add Field">
	      Add Field
	      </button>
       <!-- <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
        <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <%* <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>*%>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button>  -->

       

      </div>
     
      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>

      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="">
          <%include 'form_field_add_form.tpl' type='Add'%>
          <div class="table-responsive text-nowrap">
             <table id="school_listing" class="table  table-striped w-100">
                                 

                                   
                                </table>
          </div>
        </div>
        <!--/ Responsive Table -->
      </div>
      <!-- /.col -->

      
      <div class="content-backdrop fade"></div>
      <%include 'form_field_add_form.tpl' type='Update'%>
    </div>

<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: "Roboto", sans-serif;
      background: #f0f2f7;
    }
    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .label {
      padding: 10px;
      font-size: 18px;
      color: #111;
    }
    .copy-text.active {
      position: relative;
    }
    .copy-text::before {
      content: "Copied";
      position: absolute;
      top: 9px;
    right: -19px;
      background: transparent;
      padding: 8px 10px;
      border-radius: 20px;
      font-size: 15px;
      display: none;
    }
    .copy-text{
      position: relative;
    }
    
    .copy-text.active::before,
    .copy-text.active::after {
      display: block;
    }
    footer {
      position: fixed;
      height: 50px;
      width: 100%;
      left: 0;
      bottom: 0;
      background-color: #5784f5;
      color: white;
      text-align: center;
    }
    footer p {
      margin: 0;
      padding: 10px;
    }
    .inactive-row .status {
        color: red;
    }
    .active-row .status {
        color: #5ded5d;
    }
  </style>
    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>
    var column_details =  <%$data|json_encode%>;
    var page_length_arr = <%$page_length_arr|json_encode%>;
    var is_searching_enable = <%$is_searching_enable|json_encode%>;
    var is_top_searching_enable =  <%$is_top_searching_enable|json_encode%>;
    var is_paging_enable =  <%$is_paging_enable|json_encode%>;
    var is_serverSide =  <%$is_serverSide|json_encode%>;
    var no_data_message =  <%$no_data_message|json_encode%>;
    var is_ordering =  <%$is_ordering|json_encode%>;
    var sorting_column = <%$sorting_column%>;
    var api_name =  <%$api_name|json_encode%>;
    var base_url = <%$base_url|json_encode%>;
    var order_acceptance_enable = <%$order_acceptance_enable|json_encode%>;
    var left_fix_column = <%$left_fix_column|json_encode%>;
</script>

    
<script src="<%$base_url%>public/js/form_master/form_field_listing.js"></script>
