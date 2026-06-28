
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
 

    <nav aria-label="breadcrumb">
      <div class="sub-header-left pull-left breadcrumb">
        <h1>
          User Management
          <a hijacked="yes" href="javascript:void(0)" class="backlisting-link" title="Back to Issue Request Listing" >
            <i class="ti ti-chevrons-right" ></i>
            <em >Group Master Rights</em></a>
          </h1>
          <br>
          <span >Update</span>
        </div>
      </nav>

      <div class="dt-top-btn d-grid gap-2 d-md-flex justify-content-md-end mb-5">
        <a type='button' class="btn btn-seconday" href="<%base_url('group_master')%>" title="Back To Group Master"><i class="ti ti-arrow-left"></i></a>
         <%*<button class="btn btn-seconday" type="button" id="downloadPDFBtn" title="Download PDF"><i class="ti ti-file-type-pdf"></i></button>
        <button class="btn btn-seconday filter-icon" type="button"><i class="ti ti-filter" ></i></i></button>
        <button class="btn btn-seconday" type="button"><i class="ti ti-refresh reset-filter"></i></button> *%>
       

      </div>
      
      <div class="card p-0 mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Group Name</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$group_details['group_name']%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Group Code</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$group_details['group_code']%>
                        </p>
                    </div>
                    <div class="tgdp-rgt-tp-sect">
                        <p class="tgdp-rgt-tp-ttl">Status</p>
                        <p class="tgdp-rgt-tp-txt">
                            <%$group_details['status']%>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      <!-- Main content -->
      <div class="row mt-4">
		   <div class="col-xl">
		      <div class="card mb-4 ">
		         <div class="card-body menu-list-block">
		            <form id="updateGroupMenuRight" class="mb-3" action="javascript:void(0)" method="POST" enctype="multipart/form-data" novalidate="novalidate">
		               <div class=" edit-block-contain">
			               	<input type="hidden" name="group_id" value="<%$group_id%>">
			               	<%assign var="row_key" value=0%>
			               	<%foreach from=$groups_menu key='key_val' item='menu_category'%>
			               		<div class="menu-category-block mb-3">
			               			<label class="category-label w-100"><%$key_val%> <i class="ti ti-circle-minus float-end extend-icon "></i></label>
			               			<div class="category-menu-list row">
					               		<%foreach from=$menu_category key='key' item='menu'%>
						                  <div class="col-lg-12 ">
						                    <div class="menu-form-row">
						                    	<input type="hidden" name="menu[access<%$row_key%>][group_master_id]" value="<%$menu['group_master_id']%>">
						                    	<input type="hidden" name="menu[access<%$row_key%>][menu_master_id]" value="<%$menu['menu_master_id']%>">

							            		<label class="form-label ">
							                        <lable for="iAdminMenuId_" class="right-label-inline"><%$menu['diaplay_name']%></lable>
							            		</label> 
									            <div class="form-right-div">
									                <div class="margin-equilize">
									                	<input type="checkbox" name="menu[access<%$row_key%>][access][list]" class="regular-checkbox" value="Yes" <%if $menu['list'] eq 'Yes'%>checked="true"<%/if%> >
									                    <label class="right-label-inline" for="eList_1">List</label>
									                </div>
									                <div class="margin-equilize">
									                	<input type="checkbox" name="menu[access<%$row_key%>][access][add]" class="regular-checkbox" value="Yes" <%if $menu['add'] eq 'Yes'%>checked="true"<%/if%> >
									                    <label class="right-label-inline" for="eList_1">Add</label>
									                </div>
									                <div class="margin-equilize">
									                	<input type="checkbox" name="menu[access<%$row_key%>][access][update]" class="regular-checkbox" value="Yes" <%if $menu['update'] eq 'Yes'%>checked="true"<%/if%> >
									                    <label class="right-label-inline" for="eList_1">Update</label>
									                </div>
									                <div class="margin-equilize">
									                	<input type="checkbox" name="menu[access<%$row_key%>][access][delete]" class="regular-checkbox" value="Yes" <%if $menu['delete'] eq 'Yes'%>checked="true"<%/if%> >
									                    <label class="right-label-inline" for="eList_1">Delete</label>
									                </div>
									                <div class="margin-equilize">
									                	<input type="checkbox" name="menu[access<%$row_key%>][access][export]" class="regular-checkbox"  value="Yes" <%if $menu['export'] eq 'Yes'%>checked="true"<%/if%> >
									                    <label class="right-label-inline" for="eList_1">Export</label>
									                </div>
									                 <div class="margin-equilize">
									                	<input type="checkbox" name="menu[access<%$row_key%>][access][import]" class="regular-checkbox"  value="Yes" <%if $menu['import'] eq 'Yes'%>checked="true"<%/if%> >
									                    <label class="right-label-inline" for="eList_1">Import</label>
									                </div>
									            </div>
									        </div>
									       </div>
									       <%assign var="row_key" value=$row_key+1%>
								        <%/foreach%>
							        </div>
						    	</div>
						    <%/foreach%>
						    

					    </div>
					    <div class="mt-2 m-auto text-center">
					    	<a type="button" href="<%base_url('group_master')%>" class="btn btn-info me-2">Cancel</a>
					    	<button type="submit" class="btn btn-primary">Submit</button>
					    </div>
						
					</form>
				 </div>
				</div>
			</div>
		</div>
      <!-- /.col -->


      <div class="content-backdrop fade"></div>
    </div>

<style type="text/css">
	.menu-form-row {
		margin-top: 5px;
	    padding-top: 5px;
	    padding-bottom: 5px;
	    width: 100%;
	    position: relative;
	}
	.menu-form-row .form-label{
		float: left;
   		width: 20% !important;
   		margin: 9px 1px 11px 5px;
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
    	    width: 78% !important;
	}
	.menu-form-row .margin-equilize {
		float: left;
    	width: 16.65%;
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
	.menu-list-block .edit-block-contain{
		    overflow-y: auto;
		    padding: 0 17px;
		    height: 469px;
		    border-radius: 0px;
		    max-height: calc(100vh - 483px);
	}
	.menu-category-block .category-label{
		font-size: 19px;
    	color: #000;
    	font-family: 'GilroySemibold', sans-serif !important;
	}
	.menu-category-block .category-menu-list {
    	margin: 1px 1px 7px 27px;
	}
	.menu-category-block .category-label .extend-icon{
		font-size: 30px;
    	color: #66737F;
    	cursor: pointer;	
	}
	.menu-category-block .category-label .extend-icon:hover{
		    color: var(--bs-theme-color) !important;
	}
	.extend-icon.close:before {
    	    content: "\ea69";
	}

</style>
    <script type="text/javascript">
    var base_url = <%base_url()|@json_encode%>
    </script>

    <script src="<%$base_url%>public/js/admin/group_master_menu.js"></script>
