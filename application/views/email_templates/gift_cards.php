<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="./css/fonts/font.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 
    <title>Gift Card</title>
    <style type="text/css">
    @media only screen and (max-width: 640px) {
    *[class].inner_table {
      width:400px !important;
    }
    *[class].device_tables {
      width:400px !important;
    }
    *[class].center_table {
      width:100% !important;
      text-align:center !important;
    }
    *[class].device_table2 {
      width:100% !important;
    }
    *[class].block
    {
      display:block !important;
      width:100% !important;
      padding:0px !important;
    }
    }
     @media only screen and (max-width: 479px) {
    *[class].device_tables {
      width:300px !important;
    }
    *[class].inner_table {
      width:255px !important;
    }
    *[class].center_table {
      padding-top:20px;
    }
    }
    body, td, input, textarea, select {
      font-family: 'Open Sans', sans-serif !important;
    }
    </style>
    </head>
    
    <body style="font-family: 'Montserrat'; font-size:13px; line-height:20px; margin:0; padding:0px;">
    <table  class="device_tables" width="500" style="margin:0 auto;border-collapse:collapse;width:500px; border-left: 1px solid #f3f3f3;border-right: 1px solid #f3f3f3;" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td style="font-size:1px;line-height:1px;height:30px;background-color:#1B1B1B;" height="30">&nbsp;</td>
      </tr>
      <tr>
        <td style="background-color:#1B1B1B;" ><!--innner table starts-->
          
          <table class="inner_table" width="345" cellpadding="0" cellspacing="0"  style="width:345px;margin:0 auto;" align="center" >
            <tr>
              <td colspan="2" style="font-size:1px;line-height:1px;height:11px;" height="11">&nbsp;</td>
            </tr>
            <tr>
              <td style="text-align:center;"><div class="mktEditable" id="place_logo"><img border="0" alt="" src="<?php echo base_url(); ?>/assets/images/frontend/gift-card/ytw-logo.png" style="border:none;width: 370px;margin-left: 28px;"/></div></td>
           
            </tr>
            <tr>
              <td style="color:#fff;text-align:center;">
                <h2 style="margin-top: 0px;margin-bottom: 0px;padding: 12px 0px;font-weight: 700;font-size:22px;color: #e5e5e5;">You Purchased <?php echo count($email_data['gift_cards']); ?> Gift Cards</h2>
              </td>
            </tr>
            </table>

            <table class="inner_table" width="500" cellpadding="0" cellspacing="0"  style="width:500px;margin:0 auto;" align="center" >
            

             <tr>
             <!--  <td style="color:#fff;text-align:center;">
                <p style="margin-bottom: 0px;padding: 0px 25px 12px 25px;font-size: 12px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
              </td> -->
            </tr>
            <tr>
              <td colspan="2" style="font-size:1px;line-height:1px;height:30px;" height="30">&nbsp;</td>
            </tr>
            </table>

          </td>
          </tr>
          <tr>
              <td style="font-size:1px;line-height:1px;height:10px;background: #f4f4f4;" height="10" ></td>
          </tr>
          <!--inner table ends--> 
          <?php foreach($email_data['gift_cards'] as $giftCard){ ?>
          <!--white table starts-->
          <tr>
            <td style="background-color: #f4f4f4;padding:10px 0px 10px; ">
              <table class="inner_table" width="430" cellpadding="0" cellspacing="0"  style="width:430px;margin:0 auto;" align="center" >
                <tr>
                  <td style="font-size: 26px;text-align:center;color:#124596;padding: 88px 0px 0px;background-image: url(<?php echo base_url(); ?>/assets/images/frontend/gift-card/landscape-giftcardbg1.png);background-size: 100%;background-repeat: no-repeat;">
                    <table style="width: max-content;margin:0 auto;padding: 5px 0px 10px;">
                      <tr>
                        <td style="color: #E5E5E5;line-height: 21px;">
                          <p style="margin: 0px;font-size: 14px;text-align: center;font-weight: normal;">Balance</p>
                          <p  style="margin: 0px;font-size: 28px;text-align: center;font-weight: bold;color: #E5E5E5;"><?php echo $email_data['currency']['symbol'].$giftCard['balance']; ?></p>
                        </td>
                        <td style="color: #E5E5E5;text-align:left !important; ">
                          <p style="margin: 0px;font-size: 14px;font-weight: bold;padding-left: 55px;">Card Number</p>
                          <p style="margin: 0px;font-size: 13px;padding-bottom: 4px;padding-left: 55px;font-weight: normal;line-height: 9px;"><?php echo $giftCard['code']; ?></p>
                          <p style="margin: 0px;font-size: 12px;line-height: 30px;"> <span style="font-weight: bold;padding-left: 55px;font-size: 14px;">Card Pin:</span> <span style="font-weight: normal;font-size:13px;"><?php echo $giftCard['pin']; ?></span></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

           <tr>
              <td style="font-size:1px;line-height:1px;height:10px;background: #f4f4f4;" height="10"></td>
          </tr>
           <?php } ?>
          <!--grey section starts-->
        <!--footer-->
     
      <tr>
        <td bgcolor="#1B1B1B" style="text-align:center; font-size: 14px;font-weight: bold;letter-spacing: 10px;padding: 20px 0px;"><div class="" id="copyright_content"><a href="http://www.ythewait.com" target="_Blank" style="text-decoration: none;color:#9B9B9B;">www.ythewait.com</a> </div></td>
      </tr>
     
    </table>
    </body>
    </html>