<?php if(!empty($locations)) {
for($l=0;$l<count($locations);$l++) {
if(strlen($locations[$l]->location) <= 30 && $locations[$l]->location != '' && $locations[$l]->location != 'No Data Available' && $locations[$l]->location != 'No Data Available' && $locations[$l]->location != 'Others') {
?>
<label class="checkbox-custom checkbox-custom-sm d-block mb-2">
	<input class="Areas" name="areaName" value="<?php echo $locations[$l]->location; ?>" type="checkbox"><i></i>
	<span><?php echo $locations[$l]->location; ?></span>
	<!-- <span class="float-right">[6]</span> -->
</label>
<?php } } } ?>

