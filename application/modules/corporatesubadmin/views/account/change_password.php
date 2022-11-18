<?php $this->load->view('home/header'); ?>
<section class="section-padding inner-page">
    <div class="container">
        <?php $message = isset($message) ? $message : $this->session->flashdata('message'); ?>
        <?php if(!empty($message)) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-block alert-warning">
                    <a href="#" data-dismiss="alert" class="close">×</a>
                    <h5 class="mb-0 text-center text-danger"><?php echo $message; ?></h5>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="itinerary-container box-shadow">
                    <div class="searchHdr2">Change Password</div>
                    <div class="white-container">
                        <form action="<?php echo site_url();?>corporatesubadmin/change_password" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="">
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label>Email Address <small>(As Username)</small> :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="<?php echo $agent_info->agent_email; ?>" disabled="">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label>Current Password :</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="password" name="current_password"  autocomplete="off" required />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label>New Password :</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="password" name="password"  autocomplete="off" required />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label>Confirm Password :</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="password" name="passconf"  autocomplete="off" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondary">Update <i class="mdi mdi-send"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('home/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.js"></script>