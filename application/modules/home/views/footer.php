<!-- script -->
<!-- jquery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>assets_gosky/js/jquery-ui.js"></script>

<script src="<?= base_url() ?>assets_gosky/js/flight.js"></script>
<!-- bootstrap -->
<script src="<?= base_url() ?>assets_gosky/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets_gosky/js/bootstrap.min.js"></script>


<script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'dd-mm-yyyy',
            minDate: 'today'

        });
    });
</script>

<script>
    /*=====================
     6. Quantity js
     ==========================*/
    const searchBoxOpen = document.getElementById('searchBoxOpen');
    const searchboxDesc = document.getElementById('searchboxDesc');

    searchBoxOpen.addEventListener('click', () => {
        searchboxDesc.classList.toggle("show");
    });
    const searchBoxOpen2 = document.getElementById('searchBoxOpen2');
    const searchboxDesc2 = document.getElementById('searchboxDesc2');

    searchBoxOpen2.addEventListener('click', () => {
        searchboxDesc2.classList.toggle("show");
    });
    const searchBoxOpen3 = document.getElementById('searchBoxOpen3');
    const searchboxDesc3 = document.getElementById('searchboxDesc3');

    searchBoxOpen3.addEventListener('click', () => {
        searchboxDesc3.classList.toggle("show");
    });



    $('.qty-box .quantity-right-plus ').on('click', function(e) {
        e.preventDefault();
        var $qty = $(this).parents(".qty-box").find(".input-number");
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $('.qty-box .quantity-left-minus ').on('click', function() {
        var $qty = $(this).parents(".qty-box").find(".input-number");
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
        }
    });


    // multicity
    var dclone = null;
    dclone = $(".template").clone();
    $("#add_room").click(function(e) {
        e.preventDefault();
        var _elm = dclone.clone();
        _elm.css("display", "block")
        _elm.find(".remove_btn").show();
        _elm.appendTo("#clonehere");

        $(document).on("click", ".remove_btn", function(e) {

            var $e = $(e.currentTarget);

            $e.closest(".template").remove();
        });
    });


    //  flightdetails
</script>

</body>

</html>