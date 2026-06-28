<div class="wrapper container-xxl flex-grow-1 container-p-y">
   <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
         <h1>
            User Management
            <a hijacked="yes" href="#stock/issue_request/index" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >User</em></a>
         </h1>
         <br>
         <span >Listing</span>
      </div>
   </nav>
   <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
      <button type="button" class="btn btn-seconday" data-bs-toggle="modal" data-bs-target="#addPromo">
      Add User
      </button>
      <!-- <button class="btn btn-seconday" type="button" id="downloadCSVBtn" title="Download CSV"><i class="ti ti-file-type-csv"></i></button>
      <button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button> -->
      <div class="dropdown grid-drop-down">
          <button class="btn btn-secondary top-btn-row btn-seconday " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Export">
            <i class=" la-list-ul ti ti-arrow-down-from-arc" ></i>
          </button>
          <ul class="dropdown-menu p-0 mt-1 export-drop-down" aria-labelledby="dropdownMenuButton1" >
            <li class="csv"  id="downloadCSVBtn" title="CSV"><label class="hide">CSV</label> <i class="ti ti-file-type-csv" style="color: black"></i></li>
            <li class="pdf " id="downloadPDFBtn" title="PDF"><label class="hide">PDF</label><i class="ti ti-file-type-pdf" style="color: black"></i></li>
          </ul>
      </div>
      <div class="dropdown grid-drop-down">
          <button class="btn btn-secondary top-btn-row btn-seconday " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class=" la-list-ul ti ti-list-details" ></i>
          </button>
          <ul class="dropdown-menu p-0 mt-1 toggle-grid-btn" aria-labelledby="dropdownMenuButton1" >
            <li class="table active" data-value="Table"><label>Table</label> <i class="las la-stream" style="color: black"></i></li>
            <li class="grid " data-value="Grid"><label>Grid</label><i class="las la-border-all" style="color: black"></i></li>
          </ul>
      </div>
      <%*<button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
         <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
   </div>
   <div class="content-wrapper" >
      <!-- Main content -->
      <section class="content">
         <div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
               
               <div class="col-lg-12">
                  <!-- Modal -->
                  <div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add EPR Users</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              </button>
                           </div>
                           <form action="<%base_url('user/user/addUsersData') %>" method="POST" enctype="multipart/form-data" id="addTransporterForm">
                              <div class="modal-body">
                                <div class="row">

                                 <div class="form-group">
                                    <label for="on click url">User Full Name<span class="text-danger">*</span></label> <br>
                                    <input required type="text" name="user_name" placeholder="Enter Full Name" class="form-control" value="" id="">
                                 </div>
                                 <div class="form-group">
                                    <label for="on click url">User Email<span class="text-danger">*</span></label> <br>
                                    <input required type="email" name="user_email" placeholder="Enter Email" class="form-control" value="" id="">
                                 </div>
                                 <div class="form-group">
                                    <label for="on click url">User Password<span class="text-danger">*</span></label> <br>
                                    <input required type="password" name="user_password" placeholder="Enter Password" class="form-control" value="" id="">
                                 </div>
                                 <div class="form-group">
                                    <label for="on click url">User Role<span class="text-danger">*</span></label> <br>
                                    <select name="user_role" class="form-control select2" id="">
                                       <option value="Admin">Admin</option>
                                       <option value="Purchase">Purchase</option>
                                       <option value="Approver">Approver</option>
                                       <option value="inward_stores">inward stores </option>
                                       <option value="stores">stores </option>
                                       <option value="production">production</option>
                                       <option value="FG_stores">FG stores</option>
                                       <option value="Marketing">Marketing</option>
                                       <option value="Development">Development</option>
                                       <option value="Quality">Quality</option>
                                       <option value="Inward_Quality">Inward Quality</option>
                                       <option value="Sales">Sales</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="on click url">Unit<span class="text-danger">*</span></label> <br>
                                    <div class="row">
                                       <%foreach from=$client item='client_val' %>
                                       <div class="col-4">
                                          <input type="checkbox" class="check-box " name="client[]" value="<%$client_val['id']%>">
                                          <label for="client" class="ms-1"><%$client_val['client_unit']%></label>
                                       </div>
                                       <%/foreach%>
                                    </div>
                                 </div>
                                 <div class="form-group" >
                                    <label for="on click url" class="w-100">Groups<span class="text-danger">*</span> <a class="float-end page-access-btn" href="javascript:void(0)">View Page Access</a></label> <br>
                                    <select name="groups[]" class="form-control select2-multiple"   multiple="multiple">
                                       <%foreach from=$groups item='groups_val' %>
                                       <option value="<%$groups_val['group_master_id']%>" <%if in_array($groups_val['group_master_id'],$groups_arr)%>selected<%/if%>><%$groups_val['group_name']%></option>
                                       <%/foreach%>
                                    </select>
                                 </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                           </form>
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="w-100">
                     <input type="text" name="reason" placeholder="Filter Search" class="form-control serarch-filter-input m-3 me-0" id="serarch-filter-input" fdprocessedid="bxkoib">
                  </div>
                  <div class="card w-100 table-card">
                     <!-- /.card-header -->
                     <div class="table-responsive text-nowrap">
                        <table id="erp_users" class="table table-striped w-100">
                           <thead>
                              <tr>
                                 <th class="hide">Sr No</th> 
                                 <th>Full Name</th>
                                 <th>Email</th>
                                 <th>Password</th>
                                 <th>Role</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <%if (true) %>
                              <%assign var='i' value=1 %>
                              <%foreach from=$user_info item=u %>
                              <tr>
                                 <%assign var='units' value=explode(",",$u['unit_ids'])%>
                                 <%assign var='groups_arr' value=explode(",",$u['groups'])%>
                                 <td class="hide"><%$i %></td>
                                 <td><%$u['user_name'] %></td>
                                 <td><%$u['user_email'] %></td>
                                 <td><%$u['user_password'] %></td>
                                 <td><%$u['user_role'] %></td>
                                 <td><%$u['status'] %></td>
                                 <td>
                                    <a data-bs-toggle="modal" data-bs-target="#updatePromo<%$i%>"><i class="ti ti-edit"></i></a>
                                    <div class="modal fade" id="updatePromo<%$i%>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog  modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update EPR Users</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                             </div>
                                             <form action="<%base_url('user/user/updateUsersData') %>" method="POST" enctype="multipart/form-data" id="update_users_data<%$i%>" class="update_users_data update_users_data<%$i%> custom-form">
                                                <div class="modal-body">
                                                  <div class="row">
                                                     <div class="form-group">
                                                        <input type="hidden" name="user_id" value="<%$u['id']%>">
                                                     </div>
                                                     <div class="form-group">
                                                        <label for="on click url">User Full Name<span class="text-danger">*</span></label> <br>
                                                        <input  type="text" name="user_name" placeholder="Enter Full Name" class="form-control required-input" value="<%$u['user_name'] %>">
                                                     </div>
                                                     <div class="form-group">
                                                        <label for="on click url">User Email<span class="text-danger">*</span></label> <br>
                                                        <input  type="email" name="user_email" placeholder="Enter Email" class="form-control required-input" value="<%$u['user_email'] %>" disabled>
                                                     </div>
                                                     <!-- <div class="form-group">
                                                        <label for="on click url">User Password<span class="text-danger">*</span></label> <br>
                                                        <input required type="password" name="user_password" placeholder="Enter Password" class="form-control" value="" id="">
                                                        </div> -->
                                                     <div class="form-group">
                                                        <label for="on click url">Select Role<span class="text-danger">*</span></label> <br>
                                                        <select name="user_role" class="form-control select2 required-input"  disabled>
                                                           <option value="Admin">Admin</option>
                                                           <option value="Purchase">Purchase</option>
                                                           <option value="Approver">Approver</option>
                                                           <option value="inward_stores">inward stores </option>
                                                           <option value="stores">stores </option>
                                                           <option value="production">production</option>
                                                           <option value="FG_stores">FG stores</option>
                                                           <option value="Marketing">Marketing</option>
                                                           <option value="Development">Development</option>
                                                           <option value="Quality">Quality</option>
                                                           <option value="Inward_Quality">Inward Quality</option>
                                                           <option value="Sales">Sales</option>
                                                        </select>
                                                     </div>
                                                     <div class="form-group unit-box">
                                                        <label for="on click url">Unit<span class="text-danger">*</span></label> <br>
                                                        <div class="row">
                                                           <%foreach from=$client item='client_val' %>
                                                           <div class="col-4">
                                                              <input type="checkbox" class="check-box required-input" name="client[]" value="<%$client_val['id'] %>" <%if in_array($client_val['id'],$units)%>checked<%/if%>>
                                                              <label for="client" class="ms-1"><%$client_val['client_unit']%></label>
                                                           </div>
                                                           <%/foreach%>
                                                        </div>
                                                     </div>
                                                     <div class="form-group" >
                                                        <label for="on click url" class="w-100">Groups<span class="text-danger">*</span> <a type="button" class="float-end page-access-btn hide" href="javascript:void(0)">View Page Access</a></label> <br>
                                                        <select name="groups[]" class="form-control select2-multiple required-input"   multiple="multiple">
                                                           <%foreach from=$groups item='groups_val' %>
                                                           <option value="<%$groups_val['group_master_id'] %>" <%if in_array($groups_val['group_master_id'],$groups_arr)%>selected<%/if%>><%$groups_val['group_name']%></option>
                                                           <%/foreach%>
                                                        </select>
                                                     </div>
                                                    </div>
                                                     <div class="form-group" >
                                                        <label for="on click url" class="w-100">Groups<span class="text-danger">*</span> </label> <br>
                                                        <select name="status" class="form-control select2-multiple required-input"  >
                                                           <option value="Active" <%if $u['status'] eq 'Active'%>selected<%/if%>>Active</option>
                                                           <option value="Inactive" <%if $u['status'] eq 'Inactive'%>selected<%/if%>>Inactive</option>
                                                           <option value="Block" <%if $u['status'] eq 'Block'%>selected<%/if%>>Block</option>
                                                        </select>
                                                     </div>
                                                    </div>
                                                     <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                             </form>
                                             </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <%assign var='i' value=$i+1 %>
                              <%/foreach%>
                              <%/if%>
                           </tbody>
                        </table>
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- ./col -->
               </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
   <div class="modal fade" id="accessGroups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Page Access</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<style type="text/css">
   input.check-box{
   width: 18px;
   height: 15px;
   cursor: pointer;
   }
   .menu-form-row {
   margin-top: 5px;
   padding-top: 5px;
   padding-bottom: 5px;
   width: 100%;
   position: relative;
   }
   .menu-form-row .form-label{
   float: left;
   width: 100% !important;
   }
   .menu-form-row .form-label lable{
   font-style: normal !important;
   display: block;
   margin-top: 3px;
   font-size: 17px;
   color: #919396;
   font-family: 'GilroySemibold', sans-serif !important;
   }
   .menu-form-row .form-right-div {
   margin: 10px 6px 10px 13px;
   float: left;
   width: 100% !important;
   }
   .menu-form-row .margin-equilize {
   float: left;
   width: 20%;
   }
   .menu-form-row .margin-equilize label{
   font-size: 17px;
   color: #000;
   margin: 0px 0px 2px 8px;
   }
   .menu-form-row .margin-equilize input{
   width: 17px;
   height: 15px;
   cursor: pointer;
   }
   #accessGroups .modal-body {
   padding: 0 20px 0 20px;
   max-height: 433px !important;
   overflow-y: scroll;
   overflow-x: clip;
   }
   .pointer-none{
   pointer-events: none;
   }
   .select2-container--default .select2-selection--multiple .select2-selection__choice {
   background-color: var(--bs-theme-light4-color) !important;
   }
</style>
<script type="text/javascript">
   var base_url = <%$base_url|@json_encode%>;
   var no_data_message = <%$no_data_message|@json_encode%>;
   var module_name = "User";
</script>
<script src="<%$base_url%>public/js/admin/user_list.js"></script>