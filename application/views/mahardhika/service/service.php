<?php
$service_title_lang = $this->lang->line('service-title');
$service_desc_lang = $this->lang->line('service-desc');
?>

<section class="member-details-wrapper section-gap-top grey-bg pb-5 col-12">
    <div class="container">
        <?php 
            if($service->num_rows() > 0):
            foreach($service->result() as $serve): ?>
        <div class="row mb-3">
            <div class="member-picture-wrap col-4">
                <div class="member-picture">
                    <img src="<?php echo base_url('media/service/'.$serve->gambar) ?>" alt="image">
                </div>
            </div>
            <div class="member-desc bg-white col-8">
                <h3 class="name"><?php echo $serve->$service_title_lang ?></h3>
                <?php echo $serve->$service_desc_lang ?>
            </div>
        </div>
        <?php endforeach; endif; ?>
    </div>
</section>
