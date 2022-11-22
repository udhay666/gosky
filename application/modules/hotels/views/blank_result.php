<?php for ($i = 0; $i < 5; $i++) {
?>

    <div class="row border_card_loader mb-3 blank_result">
        <div class="col-sm-12 col-md-3">
            <div class="htl-img blank_imgdiv">
                <img src="<?= base_url() ?>public/img/loader.gif" alt="" class="img-responsive">
            </div>
        </div>
        <div class="col-sm-12 col-md-5 res_margin">
            <div class="mt-2">
                <span class=""></span>
                <div class="locationspan_fx">
                    <span class="location_span"></span>
                    <span class="location_span"></span>
                    <span class="location_span"></span>
                </div>
            </div>
        </div>
        <div class="col-1">
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="mt-2 price_loaderfx">
                <span></span>
                <div class="locationspan_fx">
                    <span class="location_span"></span>
                    <span class="location_span"></span>
                    <span class="location_span"></span>
                </div>
            </div>
        </div>


    </div>

<?php } ?>