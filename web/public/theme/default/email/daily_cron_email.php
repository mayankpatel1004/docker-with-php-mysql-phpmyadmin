<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>

    <body>
        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">
            <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="color:#25378b">
                        <tr>
                            <td align="center" bgcolor="#25378b" colspan="3"><img src="#logo_url#" alt="#subject#" /></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>          
                        <tr>
                            <td colspan="3">
                                <h4>Hello #username#,</h4>
                                <p>Below is the report of today's employee punching data.</p>
                                <br />
                            </td>
                        </tr>
                        <tr>
                            <td style="width:30%"><label style="text-align:center;"><b>Today Punch Hours</b></label></td>
                            <td style="width:30%"><label style="text-align:center;"><b>Previous Day Punch Hours</b></label></td>
                            <td style="width:40%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width:30%">#punch_data#</td>
                            <td style="width:30%">#punch_data_yesterday#</td>
                            <td style="width:40%">&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><h3 style="text-align:left;color:#25378b">Today's Punching Hours</h3></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            #email_string_today_punch#
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><h3 style="text-align:left;color:#25378b">Previous Working Day Punching Hours</h3></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            #email_string_previousday_punch#
                            </td>
                        </tr>


                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><h3 style="text-align:left;color:#25378b">Current Month Employee Leave</h3></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                            #employee_on_leave#
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>          
                        <tr>
                            <td colspan="3"><h3 style="text-align:left;color:#25378b">Pending Task Status</h3></td>
                        </tr>          
                        <tr>
                            <td colspan="3">
                            #pending_task#
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><h3 style="text-align:left;color:#25378b">Current Month Visitors</h3></td>
                        </tr>
                        <tr>
                            <td style="width:30%;vertical-align:top">#month_city_visitor_data#</td>
                            <td style="width:30%;vertical-align:top">#month_country_visitor_data#</td>
                            <td style="width:40%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3"><h3 style="text-align:left;color:#25378b">Website Status</h3></td>
                        </tr>
                        <tr>
                            <td style="width:100%;vertical-align:top">#website_status#</td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /><p>If you have any questions or need further assistance, please login to administrator panel of your website.</p></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="#F7F7F7" colspan="3"><h3>#companyname#</h3>
                                #companyaddress# #companyaddress2#,#companycity#
                                #companystate#,#companycountry# - #companyzipcode#
                                <br />Phone : #companycontact#
                                <br /><a href="mailto:#companyemail#">#companyemail#</a><br /><a href="#companywebsite#" target="_blank">#companyname#</a>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>