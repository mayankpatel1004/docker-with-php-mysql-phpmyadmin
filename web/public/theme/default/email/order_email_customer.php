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
                            <td align="center" colspan="2" bgcolor="#25378b"><img src="#logo_url#" alt="#subject#" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>          
                        <tr>
                            <td colspan="2">
                                <h4 style="color:#25378b">Hello #customer_name#,</h4>
                                <p>Thank you for order on #sitename#. Your order has been successfully created on #sitename#.</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Order Status : </strong>#order_status#</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <h4 style="color:#25378b">Billing Address</h4>
                                <br />
                                #billing_address#
                            </td>
                            <td>
                                <h4 style="color:#25378b">Shipping Address</h4>
                                <br />
                                #shipping_address#
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr style="color:#000;">
                            <td colspan="2">
                                <table width="100%" border="1">
                                    <tr>
                                        <th style="text-align:center;color:#25378b;">Items</th>
                                        <th style="text-align:center;color:#25378b;" align="right">Qty</th>
                                        <th style="text-align:center;color:#25378b;" align="right">Price</th>
                                        <th style="text-align:center;color:#25378b;" align="right">Total</th>
                                    </tr>
                                    #product_items#
                                    <tr>
                                        <td colspan="4" align="right">Product Total : #total_items_amount#</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">Total Quantity : #total_ordered_quantity#</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">Total Tax : #total_items_tax_amount#</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">Total Shipping : #total_items_shipping_amount#</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="right">Order Total : #order_total#</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2" bgcolor="#F7F7F7"><h3>#companyname#</h3>
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