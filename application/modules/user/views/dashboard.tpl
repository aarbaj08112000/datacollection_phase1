
<div class="container mt-4">
<h4>Welcome to <%$config['company_name']%></h4>
<div class="row">
<%assign var="borderColors" value=["red", "blue", "green", "orange"] %>
<%foreach from=$colleges item=college name=loop %>
    <%assign var="borderColor" value=$borderColors[$smarty.foreach.loop.index % count($borderColors)] %>
    <div class="col-md-3">
        <div class="card p-3" style="border-bottom: 3px solid <%$borderColor %>; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="d-flex align-items-center">
                <!-- College Logo (Left Side) -->
                <img src="<%$college.logo %>" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">

                <!-- College Name (Right Side) -->
                <h5 class="mb-0" style="flex-grow: 1;"><%$college.name %></h5>
            </div>
            <p style="display: flex; justify-content: space-between; margin-top: 10px;margin-bottom: 0px;">
                <span>Total Students:</span> 
                <span style="font-weight: bold; font-size: 20px; color: <%$borderColor %>;"><%$college.students %></span>
            </p>
        </div>
    </div>
<%/foreach %>
</div>

</div>