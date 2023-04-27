<?php
$paraCSS = 'font-size: 14px; font-weight: normal;color:#000; line-height: 22px;font-family: \'Montserrat\', sans-serif!important;';
$data['body']='<tr>
                                       <td>
                                      <table style="font-size: 14px; font-weight: normal;color:#000;display: block;line-height: 22px;font-family: \'Montserrat\', sans-serif!important; ">
                                             <tr>
            <td style="width:95%;display:block;margin:auto;">   <br/>
            <h1 style="font-size: 24px; text-align:center;color:#000; font-family: \'Montserrat\', sans-serif!important; ">Welcome Dear!</h1>
                                               <!--If you want to remove then you can-->              
                                                     <p style="'.$paraCSS.'">
                                                        Dear '.$name.',<br/><br/>
                                                        We have received your '.$order_type.' order. Your order is being processed. We will update you soon on the status of your order request.
                                                    </p>  
                                                </td>
                                            </tr>
                                            <tr>
                                                 <td style="width:95%;display:block;margin:auto;">   <br/>          
                                                     <p style="'.$paraCSS.'">Thanks for ordering with Y the Wait!</p>
                                                 </td>
                                            </tr>
                                            <tr>
                                                 <td style="width:95%;display:block;margin:auto;">   <br/>        
                                                     <p style="'.$paraCSS.'">Warm regards,</p>
                                                     <p style="'.$paraCSS.'">Y the Wait team</p>
                                                     
                                                 </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                   <hr style="border:0;height:20px" />
                                                </td>
                                            </tr>
                                        </table>
                                       </td>
                                      </tr>';
 $this->load->view('api/email_templates/layout/layout', $data);
