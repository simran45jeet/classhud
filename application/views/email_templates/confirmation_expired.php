<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Confirmation link expired! - YTheWait</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().'assets/images/favicon.png' ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <style type="text/css">
     p,h1,h2,h3,h4,h5,a,li{
        font-family: 'Montserrat', sans-serif!important;
    }
    body {
        width: 100% !important;
        height: 100%;
        color: #000;
        font-size: 13px;
        font-family: 'Montserrat', sans-serif!important;
        line-height: 1;
        margin:0;
        padding:0;
    }

    @media only screen and (max-width: 599px) {
        p{line-height: 22px !important;}
        table{width:92%;}
    }
    </style>
<body style="width:100% !important; color:#ffffff; background:#eff1f4;  font-size:13px; line-height:1; " height="100%" width="100%">
<table width="640" height="100%" style="margin:0 auto; font-family: 'Montserrat', sans-serif!important;background: #f8f7f5;    border-collapse: collapse;">
        
        <!-- <tr>
            <td style="background:#000;padding:15px;text-align:center">
                <img style="width:155px" src="<?php echo base_url(); ?>assets/admin/app-assets/images/ythewait.png" />
            </td>
        </tr> -->

        <thead style="background:#000;padding:15px;text-align:center">
            <tr>
                <td align="left" height="30"></td>
            </tr>
            <tr>
                <td>
                    <img style="width:155px" src="<?php echo base_url(); ?>assets/admin/app-assets/images/ythewait.png" />
    
                </td>
            </tr>
            <tr>
                <td align="left" height="30"></td>
            </tr>
        </thead>

        <tbody style="text-align:center; background-color:#f8f7f5;">
        <tr>
            <td align="left" height="40%"><img  src="<?php echo base_url(); ?>assets/admin/app-assets/images/confirmation-page-bg.jpg" /></td>
        </tr>
        <tr>
            <td style="width:95%;display:block;margin:auto; " height="40%">                
            <h2 style="margin: 0px; font-size: 24px; color:#000; font-family: 'Montserrat', sans-serif!important;background-image: none;">Confirmation Link Expired</h2>
                <p style="margin: 0px; color:#C0C0C0; font-weight:normal; font-size: 14px; font-family: 'Montserrat', sans-serif!important;margin:20px 0;">
                    You have already verified your Identity via this link. We will get back to you soon.
                </p>
            </td>
        </tr>
  
        <tr>
            <th style="width:95%;display:block;margin:auto;text-align: center">
                <?php if(!empty($code)){ ?>
                <a href="<?= base_url().'restaurants/resend_confirmation/'.$code?>" style=" font-size: 18px;background-color: #ff3300;color: #fff;padding: 10px 20px;margin:10px 0 !important;text-decoration: none;display: inline-block;margin: 0 auto;border-radius:5px;font-weight: bold;">
                Resend
                </a> 
                <?php } ?>
            </th>
        </tr>
  
        <tr>
            <td>
                <hr style="border:0;height:20px" />
            </td>
        </tr>
        </tbody>
    </table>
</body>

</html>