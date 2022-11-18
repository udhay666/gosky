
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>:: Admin Console ::</title>
        <meta name="description" content="">

        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/home">
                            Dashboard
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="main">
            <?php echo $this->load->view('leftpanel'); ?>
            <div class="container-fluid">
                <div class="content">
                    <?php echo $this->load->view('topmenu'); ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box">
                           
                                <div class="box-content box-nomargin">
                                   <form method="Get" action="<?php echo site_url(); ?>home/view_forex_page/">
								
									From Date:<input type="text" id="datepicker" placeholder="From Date" class="datepick" data-date-format="dd/mm/yyyy" name="from_date" value="<?php if(isset($from_date) && $from_date!='') echo $from_date; ?>">
									To Date:<input type="text" id="datepicker1" placeholder="To date" class="datepick" data-date-format="dd/mm/yyyy" name="to_date" value="<?php if(isset($to_date) && $to_date!='') echo $to_date; ?>">
									
									<input type="submit" value="SUBMIT" class="btn btn-success btn btn-primary btn-register">
									</form>
                                        <div class="tab-pane" id="forex-api-list">                                    
<div><input type="button" id="forex_download" class="btn btn-success btn btn-primary pull-right" value="Download Excel"/></div>
                                            <table class='table table-striped dataTable table-bordered'>
                                                <thead>
                                                    <tr> 
                                                        <th>SI.No</th>                             	
                                                        <th>Title</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>MobileNumber</th>
                                                        <th>TelePhoneNumber</th>
                                                        <th>Country</th>
                                                        <th>From Curremcy</th>
                                                        <th>To Currency</th>
                                                        <th>Quantity</th>
                                                        <th>PaymentMode</th>
														<th>Booking Date</th>
                                                        <th>Jpno</th>
                                                        <th>Message</th>

                                                    </tr>
                                                </thead>   
                                                <tbody>
                                                    <?php if (!empty($forex_query_summary)) { ?>
                                                        <?php for ($i = 0; $i < count($forex_query_summary); $i++) { ?>
                                                            <tr>
                                                                <td><?php echo $i + 1; ?></td>
                                                                <td><?php echo $forex_query_summary[$i]->grnder_title; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_fname; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_email; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_number; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_tnumber; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_country; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->fromCurrency; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->toCurrency; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->Quantity; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->Payment; ?></td>
																<td class="center"><?php echo date('y-m-d',strtotime($forex_query_summary[$i]->booking_date)); ?></td>
																
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_jpf; ?></td>
                                                                <td class="center"><?php echo $forex_query_summary[$i]->user_msg; ?></td>


                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>

                                                    <div class="alert alert-error">
                                                        <button class="close" data-dismiss="alert" type="button">×</button>
                                                        <strong>Error!</strong>
                                                        No Data Found. Please try after some time...
                                                    </div>

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>	
        <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

        <script src="<?php echo base_url(); ?>public/js/less.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <!-- Download excel starts-->
        <script src="<?php echo base_url(); ?>public/js/jquery.battatech.excelexport.min.js"></script>
        <script>
            $(function(){
 
             
			$("#forex_download").click(function () {
                    $("#export_excel_table").btechco_excelexport({
                        containerid: "export_excel_table"
                        , datatype: $datatype.Table
                    });
                });

 
            });
        </script>
        <!-- Download excel eNDS-->
        <!-- My Custom JS-->
        <script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

    </body>
</html>