    <!--====== Contact Section start ======-->
    <section class="contact-section contact-page section-gap-top">
        <div class="container">
            <div class="contact-info">
                <div class="row justify-content-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="illustration-img text-center">
                            <img src="<?php echo base_url('media/contact/'.$about->gambar_contact) ?>" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-10 order-1 order-lg-2">
                        <div class="contact-info-content">
                            <?php 
                            $contact_lang = $this->lang->line('contact-lang');
                            echo $about->$contact_lang
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container container-1600">
            <div class="row">
                <div class="col-md px-0">
                    <div class="contact-map">
                        <iframe
                            src="https://maps.google.com/maps?q=<?php echo $about->lat?>,<?php echo $about->lon?>&z=20&output=embed"
                            style="border:0;" 
                            allowfullscreen="" 
                            aria-hidden="false" 
                            tabindex="0">
                        </iframe>
                    </div>
                </div>
                
                <div class="col-md px-0">
                    <div class="contact-form grey-bg">
                        <div class="row no-gutters justify-content-center">
                            <div class="col-10">
                                <div class="section-title text-center mb-40">
                                    <h2 class="title">Don’t Hesited To Contact Us</h2>
                                </div>

                                <form action="<?php echo base_url('contact/send-message') ?>" id="contact">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="input-group mb-30">
                                                <input type="text" placeholder="Your Full Name" name="name" required>
                                                <span class="icon"><i class="far fa-user-circle"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group mb-30">
                                                <input type="email" placeholder="Your Email Address" name="email" required>
                                                <span class="icon"><i class="far fa-envelope-open"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group mb-30">
                                                <input type="text" placeholder="Your Phone" name="phone" required>
                                                <span class="icon"><i class="far fa-phone"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-group textarea mb-30">
                                                <textarea placeholder="Write Message" name="message" required></textarea>
                                                <span class="icon"><i class="far fa-pencil"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <?php echo $captcha ?>
                                            <div class="input-group mb-30 mt-2">
                                                <input type="text" placeholder="Insert Captcha" name="captcha" required>
                                                <span class="icon"><i class="far fa-ticket"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="main-btn">Send Message</button>
                                        </div>
                                        <div class="col-12 mt-3" id="respond">
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Contact Section start ======-->