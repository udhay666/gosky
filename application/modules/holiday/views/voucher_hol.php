<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/datepicker.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type = "text/javascript" >
            function changeHashOnLoad() {
                window.location.href += "#";
                setTimeout("changeHashAgain()", "50"); 
            }

            function changeHashAgain() {
                window.location.href += "1";
            }

            var storedHash = window.location.hash;
            window.setInterval(function () {
                if (window.location.hash != storedHash) {
                    window.location.hash = storedHash;
                }
            }, 50);


        </script>
    </head>
    <body onload="changeHashOnLoad();">
<div>
  <div class="container">

	<?php if(!empty($holiday_booking_info)) {?>
    <?php $this->load->view('voucher_content_hol'); ?>


<table align="center" width="100%">
    <tr>
    <td bgcolor="#e7e7e7" align="center">
        <a style="text-decoration:none;" id="print" onclick="coderHakan();return false;" href="JavaScript:void(0);">&nbsp;&nbsp;<img style="width:20px;height:20px;" src="<?php echo base_url();?>public/images/print_Icon.png"/></a>
    
    </td>
  </tr>
</table>

<?php }else{ ?>

<table align="center" width="100%">
    <tr>
    <td  align="center" style="background: #a01d26;color: white;">
		
		<h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>
		
    </td>
  </tr>
</table>
<?php } ?>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</body>
</html>

