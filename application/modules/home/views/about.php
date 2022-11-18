<style>
.section-content{
    margin-top: 70px;    
}
</style>
<section class="section-content">
    <div class="container">
        <article class="panel panel-default p15">
            <div class="panel-body article">
                <!--<h4 class="text-primary">About Us</h4>-->
                <?php

foreach($about->result() as $row){ ?>
                <h2><?php echo $row->name; ?></h2>
<?php
    echo $row->content;
}


?>

            </div>
        </article>
    </div>
</section>
