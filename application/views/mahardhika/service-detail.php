<?php
$service_title_lang = $this->lang->line('service-title');
$service_desc_lang = $this->lang->line('service-desc');
$all_service = $this->lang->line('all-service-text');
?>

    <!--====== Service Details Start ======-->
    <section class="service-details section-gap">
        <div class="container">
            <div class="row">
                <!-- Dettails Content -->
                <div class="col-lg-8">
                    <div class="service-details-content">
                        <div class="main-thumb mb-40">
                            <img src="<?php echo base_url('media/service/'.$detail->gambar) ?>" alt="image">
                        </div>
                        <h2 class="title"><?php echo $detail->$service_title_lang ?></h2>
                        <p>
                            <?php echo $detail->$service_desc_lang ?>
                        </p>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-8">
                    <div class="sidebar">
                        <!-- Services List Widget -->
                        <div class="widget cat-widget">
                            <h4 class="widget-title"><?php echo $all_service ?></h4>

                            <ul>
                                <?php if($services->num_rows() > 0): 
                                    foreach($services->result() as $ser): ?>
                                <li>
                                    <a href="<?php echo base_url(create_slug($ser->titleEN)) ?>"><?php echo $ser->$service_title_lang; ?> <span><i class="far fa-angle-right"></i></span></a>
                                </li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Service Details End ======-->