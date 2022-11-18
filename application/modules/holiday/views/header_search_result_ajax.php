
<?php if(!empty($viewsearch)) { ?>
<form action="<?php echo site_url(); ?>holiday/holidaysearch" id="holiday-tab" class="form" method="post" name="viewall">
                                     <input type="hidden" class="form-control" name="searchheader" id="searchheader" value="<?php echo $viewsearch; ?>"  />
                                     <button type="submit" class="button-link viewall">View all results</button>  
                                   </form> 
<?php } else{
$images=$this->Holiday_Model->get_img_by_type($holiday_id,1);
$str=base_url().'admin/'.$images->holiday_images;
 ?>
 <?php if(getimagesize($str) !== false) {  ?> 
    <div class="suggestions" id="suggestions"> 
        <div id="results">
            <div class="suggestion">
                <a class="img" href="<?php echo site_url();?>holiday/holidaydetails/<?php echo base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holiday_id);?>"><img src="<?php echo base_url().'admin/'.$images->holiday_images; ?>"></a>
                <p><a href="<?php echo site_url();?>holiday/holidaydetails/<?php echo base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holiday_id);?>"><?php echo $package; ?></a></p>
                <a href="<?php echo site_url();?>holiday/holidaydetails/<?php echo base64_encode('AKBARHOLIDAYSPACKAGECODE'.$holiday_id);?>" class="view">View</a>
            </div>
        </div>
    </div>
<?php } } ?>
