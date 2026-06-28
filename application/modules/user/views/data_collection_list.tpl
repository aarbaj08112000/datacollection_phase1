
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
 

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
        Data Management
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Form Data</em></a>
          </h1>
          <br>
          <span >Listing</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
         <a class="btn btn-seconday" type="button" title="Download All Id Cards" href="<%base_url('download_all_ids/')%><%$school_id%>"><i class="ti ti-id-badge-2"></i></a> 
        <a class="btn btn-seconday" type="button" title="Download All images" href="<%base_url('download_all_images/')%><%$school_id%>"><i class="ti ti-photo-down"></i></a> 
         <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
          <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
          <%* <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>*%>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> 
        
       <!-- <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo" title="Add process">
       <i class="ti ti-plus"></i>
        </button> -->
       

      </div>
      <div class="w-100">
            <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
        </div>

      <!-- Main content -->
      <div class="card p-0 mt-4 w-100">
        <div class="">

          <div class="table-responsive text-nowrap">
            <table id="form_data_listing" class="table  table-striped w-100">
            </table>
          </div>
        </div>
        <!--/ Responsive Table -->
      </div>
      <!-- /.col -->

      <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header h-0 border-0 p-0" style="height: 0px">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  </button>
               </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="form-group col-12">
                           <iframe src="" class="preview-id-card-pdf" style="
    width: 101%;
    height: 600px;
">
                             
                           </iframe>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>

      <div class="content-backdrop fade"></div>
    </div>

    <style type="text/css">
      html:not([dir=rtl]) .modal .btn-close {
    transform: translate(9px, 3px) !important;
}
    </style>

    <script type="text/javascript">
    var base_url = <%$base_url|@json_encode%>;
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
    var school_id = <%$school_id|json_encode%>;
</script>

    
    <script src="<%$base_url%>public/js/form_master/data_collection_list.js"></script>
