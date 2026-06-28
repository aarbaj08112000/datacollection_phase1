<div class="modal fade" id="<%$type%>Promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><%$type%> Field</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
         </div>
         <form action="<%base_url('user/form/addUpdateFormField') %>" method="POST" enctype="multipart/form-data" <%if $type eq 'Add'%>id="addUpdateFormField"<%else%>id="UpdateFormField"<%/if%> >
         	<%if $type eq 'Update'%>
         	<input type="hidden" name="id" value="" class="id-input">
         	<%/if%>
            <div class="modal-body">
               <div class="row">
                  <div class="form-group col-6">
                     <label for="on click url">Field Title<span class="text-danger">*</span></label> <br>
                     <input required type="text" name="form_title" placeholder="Enter Field Title" class="form-control form-title-input" value="" >
                  </div>
                  <div class="form-group col-6 hide">
                     <label for="on click url">Field Name<span class="text-danger">*</span></label> <br>
                     <input required type="text" name="form_name" placeholder="Enter Field Name" class="form-control form-name-input" value="" >
                  </div>
                  <div class="form-group col-6">
                     <label for="on click url">Input Type<span class="text-danger">*</span></label> <br>
                     <div class="selct-box">
                     <select name="form_type" class="form-control select2 input-type form-type-input" >
                     	<option value="">Select Input Type</option>
                        <option value="input">Input</option>
                        <option value="drop_down">Drop Down</option>
                        <option value="radio">Radio</option>
                        <option value="file">File</option>
                     </select>
                 	</div>
                  </div>
                  <div class="form-group col-6 field-type-box" style="display: none">
                     <label for="on click url">Field Type<span class="text-danger">*</span></label> <br>
                     <div class="selct-box">
                     <select name="field_type" class="form-control select2 field-type-input" >
                     	<option value="">Select Field Type</option>
                        <option value="Number">Number</option>
                        <option value="Text">Text</option>
                        <option value="AlphaNumeric">AlphaNumeric</option>
                        <option value="Date">Date</option>
                        <option value="Uppecase">Uppecase</option>
                     </select>
                 	</div>
                  </div>
                  <div class="form-group col-6 form-value-box" style="display: none">
                     <label for="on click url">Field Value<span class="text-danger">*</span></label> <br>
                     <input required type="text" name="form_value" placeholder="Field Value" class="form-control form-value-input" value="">
                  </div>
                  <div class="form-group col-6 prefix-box" style="display: none">
                     <label for="on click url">Prefix</label> <br>
                     <div class="selct-box">
                     <select name="prefix" class="form-control select2 prefix-input" >
                     	<option value="">Select Prefix</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Miss.">Miss.</option>
                     </select>
                     </div>
                  </div>
                  <div class="form-group col-6 length-box" style="display: none">
                     <label for="on click url">Character Length</label> <br>
                     <input  type="text" name="length" placeholder="Enter Character Length" class="form-control length-input onlyNumericInput" value="" >
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
