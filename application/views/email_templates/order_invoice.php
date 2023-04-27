<?php
$html =' <tr>
<td>
 
 <table  style="font-size: 14px;margin: 30px 0px;font-weight: normal;color: #000;display: block;line-height: 22px;font-family: "Montserrat", sans-serif !important;">
     <tr>
         <td style="width: 85%;display: block;margin: auto;">   
             
             <p style="padding-bottom: 10px;padding-top:30px;">
                 <strong style="font-size: 18px;font-weight: bold;color:#000;">'.$lang_arr['dear'].' '.$payment_details['username'].',</strong>
             </p>
                 <p style="line-height: 21px;color:#000;"> '.$lang_arr['greatings_from_ytw'].'</p> 
                
                 <p style="line-height: 21px;color:#000;"> 
                  '.sprintf($lang_arr['thanks_for_partnering'],$payment_details ['invoice_number']).'</p>
             
         </td>
     </tr>
     </table>



       <div style="width: 50%;float: left;">
     <table style="width: 100%;float: left;margin-bottom: 0px;">
         <tr>
             <td class="">
                <table style="width: 100%;float: left;">
                   <tr>
                        <td style="width: 75%;text-align: left;margin: 0 auto;display: block;">
                          <p style="line-height: 21px !important;color:#000;padding-top:30px;">'.$lang_arr['issue_on_behalf'].'</p>
                          <p style="font-size: 18px;font-weight: bold;line-height: 21px !important;color:#000;margin-bottom:0px">'.$restaurant_name.'</p>
                        </td>
                    </tr>
                </table> 
             </td>
         </tr>
         
     </table>

     <table style="width: 100%;float: left;margin-bottom: 30px;" >
         <tr>
             <td class="">
                 <table style="width: 100%;float: left;">
                     <tr>
                     <td>
                         <table  style="width: 100%;float: left;">
                           <tr>
                              <td valign="middle" align="left" style="width: 75%;margin: 0 auto;display: block;line-height: 0;">
                                 <p style="line-height: 21px;color:#9b9494;display: inline-flex;align-items: center;margin-top: 30px;">
                                 <img src="https://i.ibb.co/9sxqhFh/01.png" border="0" alt="email" style="width: 13px !important;vertical-align: middle;margin-right:5px;height: 14px;margin-top: 5px;">'.$address.'</p> 

                                  <p style="line-height: 21px;color:#9b9494;display: inline-flex;align-items: center;margin-top: -5px;"> 
                                  <img src="https://i.ibb.co/r7jTsCV/03.png" alt="web" title="" border="0" style="vertical-align: middle;width: 15px !important;margin-right:5px;height: 14px;margin-top: 5px;">'.$email.'</p>
                                
                                <p style="line-height: 21px;color:#9b9494;display: inline-flex;align-items: center;margin-top: -5px;"><img src="https://i.ibb.co/zfZ0F6Y/02.png"  border="0" alt="call" style="vertical-align: middle;width: 15px !important;margin-right:5px;height: 14px;margin-top: 5px;">'.$phone.'</p>
                             </td>
                           </tr>
                         </table>  
                     </td>
                     
                 </tr>
                 </table>
               
             </td>
         </tr>
         
     </table>
    </div>

    <div style="width: 50%;float: left;">

       <table style="width: 100%;float: left;margin-bottom: 30px;">
         <tr>
             <td style="width: 85%;display: block;margin: auto;">
                <table  style="width: 100%;float: left;">
                   <tr>
                        <td style="text-align: right;">
                            <h1 style="color: #dfdfdf;font-size: 34px;margin: 0px !important;line-height: 21px;padding-top:30px;padding-bottom: 20px;">'.$lang_arr['invoice'].'</h1>
                        </td>
                    </tr>
                </table> 
             </td>
             <td align="left" width="30"><img border="0" src="'.base_url().'images/spacer.gif" height="1" width="1" alt="" title="" /></td>
         </tr>
         
     </table>

     <table style="width: 100%;float: left;margin-bottom: 30px;">
         <tr>
             <td class="wid85">
                 <table style="width: 100%;float: left;">
                     <tr>
                    
                     <td align="left" width="70"><img border="0" src="'.base_url().'images/spacer.gif" height="1" width="1" alt="" title="" /></td>
                     <td>
                         <table   style="width: 100%;float: left;" class="invoice-detail ">
                          <tr>
                            <td style="text-align: left;border-right: 2px solid #f30;">
                              <p style="line-height: 15px;font-size: 9px;font-weight: 700;color:#000;">'.$lang_arr['invoice_number'].'</p>
                              <p style="line-height: 15px;color:#000;">'.$payment_details['invoice_number'].'</p>
                              
                            </td>
                            <td style="text-align: right;">
                              <p style="line-height: 15px;font-size: 9px;font-weight: 700;color:#000;">'.$lang_arr['invoice_date'].'</p>
                              <p style="line-height: 15px;color:#000;" >'.$payment_details['invoice_date'].'</p>
                            </td>
                           </tr>
                           <tr>
                               <td></td>
                           </tr>
                         </table>   
                     </td>
                     <td align="left" width="30"><img border="0" src="'.base_url().'images/spacer.gif" height="1" width="1" alt="" title="" /></td>
                 </tr>
                 </table>
               
             </td>
         </tr>
         
     </table>

 </div>
      <table class="order-detail" style="width: 100%;border-bottom: 1px solid #f30;margin-top: 20px;">
        <tr>
          <th style="background: #f30;text-align: left;padding: 8px 30px;color: #fff;line-height: 21px;">'.$lang_arr['item'].'</th>
          <th style="background: #f30;text-align: left;padding: 8px 30px;color: #fff;line-height: 21px;">'.$lang_arr['price'].'</th>
          <th style="background: #f30;text-align: left;padding: 8px 30px;color: #fff;line-height: 21px;">'.$lang_arr['tax'].'</th>
          <th style="background: #f30;text-align: left;padding: 8px 30px;color: #fff;line-height: 21px;text-align:center;" >'.$lang_arr['qty'].' </th>
          <th  style="background: #f30;text-align: left;padding: 8px 30px;color: #fff;line-height: 21px;">'.$lang_arr['total'].'</th>
        </tr>
';                                          $i = 1; foreach($order_items as $rec): 
                                                $color = ($i%2 == 0) ? '#dfdfdf' : '#cbc9ce';
                                                $html .= '<tr>
                                                <td style="padding: 8px 30px;font-weight: 500;background:'.$color.';line-height: 21px;color:#000;">'.$rec['food_item_name'];

                                                if(!empty($rec['attributes_new'])){
                                                    $html .= "<br><small>";
                                                    foreach ($rec['attributes_new'] as $attributes_new) {
                                                        $html .= $attributes_new['name'].' : '.$payment_details['currency_code']." ".$attributes_new['price']."<br >";
                                                    }
                                                    $html .= "</small>";
                                                 }
                                                $html .= '</td>
                                                <td style="padding: 8px 30px;font-weight: 500;background: '.$color.';line-height: 21px;color:#000;">'.$payment_details['currency_code']. ' '.truncate_number($rec['item_price'],2).'</td>
                                                <td style="padding: 8px 30px;font-weight: 500;background: '.$color.';line-height: 21px;color:#000;">'.$payment_details['currency_code']. ' '.truncate_number($rec['tax_amount'],2).'</td>
                                                <td style="padding: 8px 30px;font-weight: 500;text-align: center;background:'.$color.';line-height: 21px;color:#000;">'.$rec['quantity'].'</td>
                                                <td style="padding: 8px 30px;font-weight: 500;background: '.$color.';line-height: 21px;color:#000;">'.$payment_details['currency_code']. ' '.$rec['price'].'</td>
                                              </tr>';       

                                            $i++;
                                            
                                        endforeach;
                                           
                                        $html .='  </table>                                            

                                        <div class="tabler-width-50" style="width: 50%;float: right;">

                                        <table  style="width: 100%;float: left;margin:30px 0px;">
                                       <tr>
                                           <td class="total-dt">
                                               <table style="width: 100%;float: left;">
                                                   <tr>
                                               
                                                   <td>
                                                       <table  class=" total-detail "  style="width: 100%;float: left;line-height: 21px;">
                                                       <tr>
                                                          <td style="text-align: right;">
                                                             <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;">'.$lang_arr['email_sub_total'].'</p>
                                                          </td>
                                                          <td style="text-align: left;">
                                                           <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;text-align: right;">  '.$payment_details['currency_code']. ' '.$payment_details['subtotal'].'</p>
                                                          </td>
                                                       </tr>';

                                                        if (!empty($payment_details['taxes'])) {
                                                          foreach ($payment_details['taxes'] as $tax) {
                                                            $tax_g = "";
                                                            if(!empty($tax['tax_group'])){
                                                              foreach ($tax['tax_group'] as $tax_group) {
                                                                  $tax_g .= "<br /><small>".$tax_group['tax_name']." (".$tax_group['tax_rate'].") : ".$payment_details['currency_code']." ".truncate_number($tax_group['tax_amount'],$this->uptodecimal)."</small><br >";
                                                              }
                                                            }
                                                            $html .='<tr>
                                                              <td style="text-align: right;">
                                                                 <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;">'.$tax['tax_name'].'('.truncate_number($tax['tax_rate'],$this->uptodecimal).') '.$tax_g.'</p>
                                                              </td>
                                                              <td style="text-align: left;">
                                                               <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;text-align: right;">  '.$payment_details['currency_code']. ' '.truncate_number($tax['tax_amount'],$this->uptodecimal).'</p>
                                                              </td>
                                                           </tr>';
                                                          }
                                                        }
                                                        if($payment_details['delivery_type']==DELIVERY_TYPES_DELIVERY){
                                                         $html .='<tr>
                                                             <td style="text-align: right;">
                                                               <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;">'.$lang_arr['delivery_charges'].'</p>
                                                            </td>
                                                            <td style="text-align: left;">
                                                             <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;text-align: right;"> '.$payment_details['currency_code']. ' '.$payment_details['delivery_charges'].'</p>
                                                            </td>
                                                         </tr>';
                                                        }
                                                        if((!empty($payment_details['coupon_amount'])) && ($payment_details['coupon_amount'] > 0 )){
                                                          $html .='<tr>
                                                             <td style="text-align: right;">
                                                               <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;">'.$lang_arr['coupon'].' '.$payment_details['coupon_name'].'</p>
                                                            </td>
                                                            <td style="text-align: left;">
                                                             <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;text-align: right;"> '.$payment_details['currency_code']. ' '.truncate_number($payment_details['coupon_amount'],2).'</p>
                                                            </td>
                                                         </tr>';
                                                       }
                                                        if((!empty($payment_details['discount_amount'])) && ($payment_details['discount_amount'] > 0 )){
                                                          $html .='<tr>
                                                             <td style="text-align: right;">
                                                               <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;">'.$lang_arr['rest_promo'].' </p>
                                                            </td>
                                                            <td style="text-align: left;">
                                                             <p style="color: #9b9494 !important;font-size: 12px;line-height: 21px;padding: 3px 19px !important;font-weight: 500;text-align: right;"> '.$payment_details['currency_code']. ' '.truncate_number($payment_details['discount_amount'],2).'</p>
                                                            </td>
                                                         </tr>';
                                                       }
                                                        $html .='<tr>
                                                          <td style="padding: 3px 19px !important;">
                                                             <p>&nbsp;</p>
                                                          </td>
                                                          <td style="padding: 3px 19px !important;">
                                                            <p>&nbsp;</p>
                                                          </td>
                                                       </tr>

                                                       <!--grand total row-->
                                                       <tr>
                                                           <td style="text-align: right;background: #f30;padding: 14px 18px !important;font-weight: 500;">
                                                             <p style="font-weight: 700;color: #fff;">'.$lang_arr['email_grand_total'].'</p>
                                                          </td>
                                                          <td style="background: #f30;padding: 14px 17px !important;font-weight: 500;text-align: left;">
                                                           <p  style="font-weight: 700;color: #fff;text-align: right;"> '.$payment_details['currency_code']. ' '.$payment_details['total'].'</p>
                                                          </td>
                                                       </tr>
                                                       <!--grand total row ends-->
                                                       </table>   
                                                   </td>
                                               </tr>
                                               </table>
                                             
                                           </td>
                                       </tr>
                                       
                                   </table>
                                    </div>

                                    <div style="width: 44%;float: left;padding-left: 30px;">

                                        <table style="width:100%;float:left;margin:30px 0px;">
                                       <tr>
                                           <td class="total-dt">
                                               <table class="full-width">
                                                   <tr>
                                                   <td width="230">
                                                       <table  class="full-width">
                                                           <tr>
                                                               <td>
                                                               <h3 style="margin-bottom: 12px;margin-top: 0px;color: #000;">'.$lang_arr['payment_method'].'</h3>
                                                                   <p style="font-size: 16px;font-weight: 500;line-height: 21px !important;font-style: italic;color:#000;">'.$payment_details['name'].'</p>
                                                                   <p style="color: #9b9494 !important;line-height: 12px !important;font-size: 9px;color:#000;">'.$payment_details['transaction_id'].'</p>
                                                                   <p style="width: 13%;border-bottom: 2px solid #f30;margin-top: 2px !important;"></p>
                                                               </td>
                                                           </tr>
                                                           <tr>
                                                               <td>
                                                                   <p>&nbsp;</p>
                                                               </td>
                                                           </tr>
                                                            <tr>
                                                               <td>
                                                                   <h3 style="margin-bottom: 5px;color:#000;">'.$lang_arr['payment_address'].'</h3>
                                                                   <p style="line-height: 11px !important;font-size: 10px;color:#000;">'.$payment_details['billing_address'].'</p>
                                                                   <p  style="line-height: 11px !important;font-size: 10px;color:#000;">'.$payment_details['billing_mobile'].'</p>
                                                               </td>
                                                           </tr>
                                                         
                                                       </table>  
                                                   </td>
                                                   <td align="left" width="90"><img border="0" src="'.base_url().'images/spacer.gif" height="1" width="1" alt="" title="" /></td>
                                                  
                                               </tr>
                                               </table>
                                             
                                           </td>
                                       </tr>
                                       
                                   </table>
                                    </div>
                                <div style="width: 100%;float: left;margin-top: 40px;">
                                   <table style="width: 100%;float: left;margin-bottom: 20px;">
                                    <tr>
                                       <td style="width: 90%;display: block;margin: auto;">      
                                         <p style="line-height: 21px;color:#000;text-transform: uppercase;font-size: 14px;font-weight: 500;text-align: center;">
                                               '.$lang_arr['thanks_for_ordering'].'
                                         </p>
                                       </td>
                                   </tr>
                                   <tr>
                                   <td style="width: 90%;display: block;margin: auto;">      
                                     <p style="line-height: 21px;color:#000;text-transform: uppercase;font-size: 14px;font-weight: 500;text-align: center;">
                                     '.$lang_arr['we_are_look_forward'].'
                                      
                                     </p>
                                   </td>
                               </tr>
                                  </table>
                               </div>
                              </td>
                             </tr>';
                                   
     $data['body']  =$html;
     $this->load->view('api/email_templates/layout/layout', $data);