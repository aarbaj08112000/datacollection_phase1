<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .label-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }
        .label-table td {
            padding: 3px;
            font-size: 12px;
        }
        .photo-box {
            width: 20mm;
            height: 50px;
            border: 1px solid #000;
        }
        .page-break {
            page-break-before: always; /* Force page break */
        }

    </style>
</head>
<body>

<table cellspacing="15">
    <%assign var='key_val' value=1%>
    <%foreach from=$id_card_data item='row_data'%>
    <tr>
        <%foreach from=$row_data item='id_card'%>
        <td width="50%" style="height: 173px;">
            <table class="label-table" cellspacing="2" cellpadding="0" style="border: 1px solid black; width: 86mm;">
                <tr>
                    <td width="30%">
                        <table cellspacing="0">
                            <tr style="line-height: 1;">
                                <td>
                                    <br><br> Sr. No. Label
                                </td>
                            </tr>
                            <tr style="line-height: .6;">
                                <td>&nbsp;&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="<%$id_card['image']%>" style="width: 200px; height: 250px;">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="70%">
                        <table cellspacing="2">
                            <%foreach from=$id_card['other_data'] item='values'%>
                            <tr>
                                <td width="40%"><%$values['key']%></td>
                                <td width="65%">&nbsp;&nbsp;&nbsp;&nbsp;<%$values['value']%></td>
                            </tr>
                            <%/foreach%>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <%/foreach%>
    </tr>

    <!-- Add page break every 5 rows -->
    <%if $key_val % 5 eq 0%>
    	<tr class="page-break">
    		<td style="height: 0px;line-height: 0px;"></td>
    	</tr>
       
    

    <%/if%>

    <%assign var='key_val' value=$key_val+1%>
    <%/foreach%>
</table>

</body>
</html>
