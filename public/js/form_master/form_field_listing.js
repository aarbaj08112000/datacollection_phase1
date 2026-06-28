$( document ).ready(function() {
    page.init();
});
var updateField = new bootstrap.Modal(document.getElementById('UpdatePromo'))
var table = '';
var file_name = "item_par_list";
var pdf_title = "Item part List";
const page = {
    init: function(){
        this.dataTable();
        this.formInitiate();
        $("#group_code").on("input",function(){
        	let value = $(this).val();
        	$(this).val((value.replace(/[^a-zA-Z_]/g, '')).toLowerCase());
        })
        $(document).on("click",'.edit-field-row',function() {
        	var data = $(this).data("row");
            $("label.error").remove()
        	data = JSON.parse(atob(data));
        	$("#UpdateFormField .form-title-input").val(data.form_title);
        	$("#UpdateFormField .form-name-input").val(data.form_name);
        	$("#UpdateFormField .form-type-input").val(data.form_type).trigger("change");
        	$("#UpdateFormField .field-type-input").val(data.field_type).trigger("change");
        	$("#UpdateFormField .form-value-input").val(data.form_value);
        	$("#UpdateFormField .prefix-input").val(data.prefix).trigger("change");
            var length = data.length > 0 ? data.length : "";
        	$("#UpdateFormField .length-input").val(length);
        	$("#UpdateFormField .id-input").val(data.form_field_master_id);
        	console.log(data)
            updateField.show();
        });
        $('.input-type').on("change",function() {

          var input_type = $(this).val();
          $(".field-type-box,.form-value-box,.prefix-box,.length-box").hide();
          if(input_type == "input"){
          	$(".field-type-box,.prefix-box,.length-box").show();
          }else if(input_type == "drop_down" || input_type == 'radio'){
          	$(".form-value-box").show();
          }
        });

     
      $(document).on("click",".copy-url", function() {
        // Static text to be copied
        var staticText = $(this).attr("data-url");

        // Create a temporary input element to hold the static value
        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(staticText).select();
        
        // Execute the copy command
        document.execCommand("copy");
        
        // Remove the temporary input after copying
        tempInput.remove();

        // Show "Copied" feedback
        var ele = $(this).parents(".copy-text");
        ele.addClass("active");

        // Remove the feedback after 2.5 seconds
        setTimeout(function() {
          ele.removeClass("active");
        }, 1000);
      });
      $(document).on("click",".status-school", function() {
        var status = $(this).attr("data-status");
        $("#s_status").val(status).trigger("change");
        var id = $(this).attr("data-id");
        $("#s_school_id").val(id);
        statusChange.show()
        
      });
    
    

    },
    dataTable: function(){
        var data = [];
        table = new DataTable("#school_listing", {
            dom: "Bfrtilp",
            buttons: [
              {     
                    extend: 'csv',
                      text: '<i class="ti ti-file-type-csv"></i>',
                      init: function(api, node, config) {
                      $(node).attr('title', 'Download CSV');
                      },
                      customize: function (csv) {
                            var lines = csv.split('\n');
                            var modifiedLines = lines.map(function(line) {
                                var values = line.split(',');
                                if(order_acceptance_enable == "Yes"){
                                    values.splice(8, 4);
                                }else{
                                    values.splice(6, 4);
                                }
                                
                                return values.join(',');
                            });
                            return modifiedLines.join('\n');
                        },
                        filename : file_name
                    },
                
                  {
                    extend: 'pdf',
                    text: '<i class="ti ti-file-type-pdf"></i>',
                    init: function(api, node, config) {
                        $(node).attr('title', 'Download Pdf');
                    },
                    filename: file_name,
                    customize: function (doc) {
                      doc.pageMargins = [15, 15, 15, 15];
                      doc.content[0].text = pdf_title;
                      doc.content[0].color = theme_color;
                        
                        if(order_acceptance_enable == "Yes"){
                                    doc.content[1].table.widths = ['15%', '13%','10%', '10%', '15%','10%', '10%', '13%'];
                                }else{
                                    doc.content[1].table.widths = ['15%', '15%', '15%', '15%','15%', '15%'];
                                }
                        doc.content[1].table.body[0].forEach(function(cell) {
                            cell.fillColor = theme_color;
                        });
                        doc.content[1].table.body.forEach(function(row, rowIndex) {
                            row.forEach(function(cell, cellIndex) {
                                var alignmentClass = $('#example1 tbody tr:eq(' + rowIndex + ') td:eq(' + cellIndex + ')').attr('class');
                                var alignment = '';
                                if (alignmentClass && alignmentClass.includes('dt-left')) {
                                    alignment = 'left';
                                } else if (alignmentClass && alignmentClass.includes('dt-center')) {
                                    alignment = 'center';
                                } else if (alignmentClass && alignmentClass.includes('dt-right')) {
                                    alignment = 'right';
                                } else {
                                    alignment = 'left';
                                }
                                cell.alignment = alignment;
                            });
                            if(order_acceptance_enable == "Yes"){
                                    row.splice(8, 4);
                                }else{
                                    row.splice(6, 4);
                                }
                        });
                    }
                },
            ],
            orderCellsTop: true,
            fixedHeader: true,
            lengthMenu: page_length_arr,
            // "sDom":is_top_searching_enable,
            columns: column_details,
            processing: false,
            serverSide: is_serverSide,
            sordering: true,
            searching: is_searching_enable,
            ordering: is_ordering,
            bSort: true,
            orderMulti: false,
            pagingType: "full_numbers",
            scrollCollapse: true,
            scrollX: true,
            scrollY: true,
            // order: sorting_column,
            paging: is_paging_enable,
            fixedHeader: false,
            info: true,
            autoWidth: true,
            lengthChange: true,
            fixedColumns: {
                leftColumns: left_fix_column,
                // end: 1
            },
            order:[],
            // columnDefs: order_acceptance_enable == "Yes" ? [{ sortable: false, targets: 7 },{ sortable: false, targets: 8 },{ sortable: false, targets: 9 }] : [{ sortable: false, targets: 6 },{ sortable: false, targets: 7 },{ sortable: false, targets: 8 }],
            ajax: {
                // data: {'search':data},    
                url: "form_field_listing_data",
                type: "POST",
            },

        });
        $('.dataTables_length').find('label').contents().filter(function() {
            return this.nodeType === 3; // Filter out text nodes
        }).remove();
        $('#serarch-filter-input').on('keyup', function() {
            table.search(this.value).draw();
        });
        table.on('init.dt', function() {
            $(".dataTables_length select").select2({
                minimumResultsForSearch: Infinity
            });
        });
       
    },
    formInitiate: function(){
      

    	let that = this;
    	$("#addUpdateFormField").validate({
                rules: {
                    form_title: {
                        required: true
                    },
                    form_name: {
                        required: true
                    },
                    form_type: {
                        required: true
                    },
                    field_type :{
                    	 required: true
                    },
                    form_value :{
                       required: true
                    }
                },
                messages: {
                    form_title: {
                        required: "Please enter form title"
                    },
                    form_name: {
                        required: "Please enter field name"
                    },
                    form_type: {
                        required: "Please select input type"
                    },
                    field_type: {
                        required: "Please select field type"
                    },
                    form_value :{
                       required: "Please enter field value"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.is(":radio")) {
                        // Place the error message under the radio buttons
                        error.insertAfter(element.closest('.radio-box'));
                    }else if (element.hasClass("autocomplete")) {
                        // Place the error message under the radio buttons
                        error.insertAfter(element.closest('.autocomplete-box'));
                    }else if (element.hasClass("select2")) {
                        // Place the error message under the radio buttons
                        error.insertAfter(element.closest('.selct-box'));
                    }else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form,event) {
                	event.preventDefault();
						var formdata = new FormData(form);
					      $.ajax({
					        url: "user/form/addUpdateFormField",
					        data:formdata,
					        processData:false,
					        contentType:false,
					        cache:false,
					        type:"post",
					        success: function(result){
					          var data = JSON.parse(result);
					          if (data.success == 1) {
					              toaster("success",data.messages);
					              setTimeout(function () {
					                window.location.reload();
					            }, 2000);
					          }else{
					            toaster("error",data.messages);
					          }

					        }
					    });
                	
					
					return false;
                    // // Optional: form submission logic, if validation is successful
                    // alert('Form is valid! Submitting...');
                    // form.submit();
                }
            });
    	$("#UpdateFormField").validate({
                rules: {
                    form_title: {
                        required: true
                    },
                    form_name: {
                        required: true
                    },
                    form_type: {
                        required: true
                    },
                    field_type :{
                    	 required: true
                    },
                    form_value :{
                       required: true
                    }
                },
                messages: {
                    form_title: {
                        required: "Please enter form title"
                    },
                    form_name: {
                        required: "Please enter field name"
                    },
                    form_type: {
                        required: "Please select input type"
                    },
                    field_type: {
                        required: "Please select field type"
                    },
                    form_value :{
                       required: "Please enter field value"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.is(":radio")) {
                        // Place the error message under the radio buttons
                        error.insertAfter(element.closest('.radio-box'));
                    }else if (element.hasClass("autocomplete")) {
                        // Place the error message under the radio buttons
                        error.insertAfter(element.closest('.autocomplete-box'));
                    }else if (element.hasClass("select2")) {
                        // Place the error message under the radio buttons
                        error.insertAfter(element.closest('.selct-box'));
                    }else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form,event) {
                	event.preventDefault();
						var formdata = new FormData(form);
					      $.ajax({
					        url: "user/form/addUpdateFormField",
					        data:formdata,
					        processData:false,
					        contentType:false,
					        cache:false,
					        type:"post",
					        success: function(result){
					          var data = JSON.parse(result);
					          if (data.success == 1) {
					              toaster("success",data.messages);
					              setTimeout(function () {
					                window.location.reload();
					            }, 2000);
					          }else{
					            toaster("error",data.messages);
					          }

					        }
					    });
                	
					
					return false;
                    // // Optional: form submission logic, if validation is successful
                    // alert('Form is valid! Submitting...');
                    // form.submit();
                }
            });

    },
    formValidate: function(form_class = ''){
        let flag = false;
        $(".custom-form."+form_class+" .required-input").each(function( index ) {
          var value = $(this).val();
          var dataMax = parseFloat($(this).attr('data-max'));
          var dataMin = parseFloat($(this).attr('data-min'));
          if(value == ''){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var start ="Please enter ";
              if($(this).prop("localName") == "select"){
                var start ="Please select ";
              }
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              var validation_message = start+(label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
          }
          else if(dataMin !== undefined && dataMin > value){
            flag = true;
            var label = $(this).parents(".form-group").find("label").contents().filter(function() {
              return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
            }).text().trim();
            var exit_ele = $(this).parents(".form-group").find("label.error");
            if(exit_ele.length == 0){
              var end =" must be greater than or equal to "+dataMin;
              label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
              label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
              label = label.charAt(0).toUpperCase() + label.slice(1);
              var validation_message =label +end;
              var label_html = "<label class='error'>"+validation_message+"</label>";
              $(this).parents(".form-group").append(label_html)
            }
            }else if(dataMax !== undefined && dataMax < value){
              flag = true;
              var label = $(this).parents(".form-group").find("label").contents().filter(function() {
                return this.nodeType === 3; // Filter out non-text nodes (nodeType 3 is Text node)
              }).text().trim();
              var exit_ele = $(this).parents(".form-group").find("label.error");
              if(exit_ele.length == 0){
                var end =" must be less than or equal to "+dataMax;
                label = ((label.toLowerCase()).replace("enter", "")).replace("select", "");
                label = (label.toLowerCase()).replace(/[^\w\s*]/gi, '');
                label = label.charAt(0).toUpperCase() + label.slice(1)
                var validation_message =label +end;
                var label_html = "<label class='error'>"+validation_message+"</label>";
                $(this).parents(".form-group").append(label_html)
              }
          }
        });
       
        return flag;
    }
    
}


