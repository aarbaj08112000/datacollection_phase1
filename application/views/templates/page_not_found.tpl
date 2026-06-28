<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <style type="text/css">
            .no_page_found_dib {
                text-align: center;
            }
            .no_page_found_dib img {
                width: 75%;
                mix-blend-mode: multiply;
                filter: contrast(1);
                height: 95%;
            }
        </style>
    </head>
    <body>
        <div class="no_page_found_dib">

            <div class="mb-5 ">
                <img
                    alt=""
                    src="<%base_url('')%>public/assets/images/404_page.jpg"
                    height="150"
                    width="150"
                    class="mt-5"/>
                <br>
                <br>
                <a type="button" class="btn btn-outline-info" href="<%$previous_page%>">
        				Back To Previous Page
        		</a>

            </div>
        </div>
    </body>
</html>