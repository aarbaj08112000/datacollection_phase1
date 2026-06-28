$( document ).ready(function() {
    page.init();
});
var statusChange = new bootstrap.Modal(document.getElementById('addPromo'))
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
        $(".select2").select2();

        $('.copy-url').click(function() {
          var url = $(this).attr('data-url');
          var $tempInput = $('<input>');
          $('body').append($tempInput);  
          $tempInput.val(url).select();  
          document.execCommand('copy');  
          $tempInput.remove();  
          // alert('URL copied to clipboard!');
          toaster("success",'URL copied to clipboard!');
      });

      $(document).on('click','.delete-school',function() {
          var data_id = $(this).attr("data-id");
          Swal.fire({
            title: "Are you delete?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
          }).then((result) => {
            if (result.isConfirmed) {
             
              $.ajax({
                  type: "POST",
                  url: "user/form/delete_school",
                  data: {school_id:data_id},
                  success: function (response) {
                    var responseObject = JSON.parse(response);
                    var msg = responseObject.messages;
                    var success = responseObject.success;
                    if (success == 1) {
                      toaster("success",msg);
                      $(this).parents(".modal").modal("hide")
                      setTimeout(function(){
                        window.location.reload();
                      },2000);

                    } else {
                      toaster("error",msg);
                    }
                  },
                  error: function (error) {
                    console.error("Error:", error);
                  },
                });
            }
          });
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
            // scrollY: true,
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
            // columnDefs: order_acceptance_enable == "Yes" ? [{ sortable: false, targets: 7 },{ sortable: false, targets: 8 },{ sortable: false, targets: 9 }] : [{ sortable: false, targets: 6 },{ sortable: false, targets: 7 },{ sortable: false, targets: 8 }],
            ajax: {
                data: {'search':data},    
                url: "form_listing_data",
                type: "POST",
            },
            "createdRow": function(row, data, dataIndex) {
                if (data.status === "Active") {
                    $(row).addClass('active-row'); // Add class for active rows
                }else{
                    $(row).addClass('inactive-row');
                } 
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
    	$(".change_status").submit(function(e){
	        e.preventDefault();
	        var href = $(this).attr("action");
	        var id = $(this).attr("id");
	        let flag = that.formValidate(id);
	        if(flag){
	          return;
	        }
	        var formData = new FormData($('.'+id)[0]);
	        $.ajax({
	          type: "POST",
	          url: href,
	          data: formData,
	          processData: false,
	          contentType: false,
	          success: function (response) {
	            var responseObject = JSON.parse(response);
	            var msg = responseObject.messages;
	            var success = responseObject.success;
	            if (success == 1) {
                toaster("success",msg);
	              $(this).parents(".modal").modal("hide")
	              setTimeout(function(){
	                window.location.reload();
	              },1500);

	            } else {
                toaster("error",msg);
	            }
	          },
	          error: function (error) {
	            console.error("Error:", error);
	          },
	        });
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


