<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Verification Completed</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url().BASE_IMAGE_PATH.'favicon.png' ?>">
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
    }
    .h2_header{
        text-align: center;
        margin: 15px 15px !important;
        color: 000000c7;
        margin: 0px;
        font-size: 24px;
        color: #000000c7;
        font-family: 'Montserrat',
        sans-serif!important;
    }
    .text_msg {
        text-align:center;
        color:#C0C0C0;
        font-weight:normal; 
        line-height: 1.3;
    }
    .back_btn {
        font-size: 15px;
        background-color: #ff3300;
        color: #fff;
        padding: 10px 20px;
        margin: 25px 25px !important;
        text-decoration: none;
        display: inline-block;
        margin: 0 auto;
        border-radius:3px;
        font-weight: bold;
    }
    </style>
</head>
<body style="margin: 0;" height="100%" width="100%">
    <table width="100%" height="100%" style="margin:0 auto; font-family: 'Montserrat', sans-serif!important;    border-collapse: collapse;">
        <thead  style="background:#000;padding:15px;text-align:center">
            <tr>
                <td align="left"  height="30"></td>
            </tr>
            <tr>
                <td>
                    <img style="width:155px" src="<?=base_url();?>assets/admin/app-assets/images/ythewait.png" />
    
                </td>
            </tr>
            <tr>
                <td align="left" height="30"></td>
            </tr>
        </thead>
        <tbody  style="text-align:center">
            <tr>
                <table width="100%">
                    <tr>
                        <td width="50%"><img src="<?=base_url();?>assets/admin/app-assets/images/verification_page.png" height="100%" width="100%"></img></td>
                        <td width="50%" style="vertical-align: middle;">
                            <h2 class="h2_header"><?php echo $this->lang->line('verification_completed'); ?></h2>
                            <p class="text_msg">
                                <?php echo $this->lang->line('verification_completed_content'); ?>
                            </p>
                            <p style="text-align:center;">
                            <a href="<?=base_url()?>" class="back_btn">Back to home</a> 
                            </p> 
                        </td>
                    </tr>
                </table>
            </tr>    
            <tr>
                <td align="left"  height="20"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>