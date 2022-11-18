<?php $this->load->view('home/home_template/header');?>
<style>
    .inner-page{
        margin-top: 100px;
    }
    .pb-4{
        padding-bottom: 25px;
    }
</style>
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
<script>
function coderHakan()
{
var sayfa = window.open($(this).attr("href"), "popupWindow", "width=800,height=800,scrollbars=yes");
sayfa.document.open("text/html");
sayfa.document.write(document.getElementById('printArea').innerHTML);
//sayfa.document.close();
sayfa.print();
//sayfa.close();
}
</script>
<?php if (!empty($hotel_booking_info)) { ?>
<div class="section-padding inner-page">
    <div class="container">
        <?php $this->load->view('voucher_content') ?>
    </div>
</div>

<div class="section-padding pt-0 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table border="0" align="center" width="100%" style="border: none;">
                    <tbody style="border: none;">
                        <tr style="border: none;">
                            <td bgcolor="" align="center" style="border: none;">
                                <a id="print" onclick="coderHakan();return false;" href="JavaScript:void(0);" title="print">
                                    <button class="btn btn-primary">Print&nbsp;<i class="fa fa-print"></i></button>
                                </a>
                                <a href="<?php echo base_url(); ?>" title="home">
                                    <button class="btn btn-primary">Home&nbsp;<i class="fa fa-home"></i></button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } else {?>
<div class="bottomSection">
    <div class="container">
        <div class="row">
            <div class="col-md-12 details2">
                <div class="white-bg">
                    <table align="center" width="100%">
                        <tr>
                            <td align="center">
                                <h3>Sorry, No Voucher is Availbale.. Please try for another voucher...</h3>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php $this->load->view('home/home_template/footer'); ?>
</body>