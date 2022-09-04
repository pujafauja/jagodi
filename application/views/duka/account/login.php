<main>
    <!-- page-banner-area-start -->
    <div class="page-banner-area page-banner-height-2" data-background="<?php echo base_url('media/account/login-banner.jpg') ?>" style="background-position: center right !important">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-banner-content text-center">
                        <h4 class="breadcrumb-title">My account</h4>
                        <div class="breadcrumb-two">
                            <nav>
                               <nav class="breadcrumb-trail breadcrumbs">
                                  <ul class="breadcrumb-menu">
                                     <li class="breadcrumb-trail">
                                        <a href="<?php echo base_url() ?>"><span>Home</span></a>
                                     </li>
                                     <li class="trail-item">
                                        <span>My account</span>
                                     </li>
                                  </ul>
                               </nav> 
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-area-end -->

    <!-- account-area-start -->
    <div class="account-area mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="basic-login mb-50">
                        <h5>Login</h5>
                        <form action="" method="post" id="login">
                            <label for="name">Username atau alamat email  <span>*</span></label>
                            <input id="name" name="name" type="text" placeholder="Masukkan Username / Email">
                            <label for="pass">Password <span>*</span></label>
                            <input id="pass" name="pass" type="password" placeholder="Masukkan password...">
                            <a href="" class="tp-in-btn w-100 login-btn">log in</a>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="basic-login">
                        <h5>Register</h5>
                        <form action="" method="post" id="register">
                            <label for="username">Username<span>*</span></label>
                            <input name="username" id="username" type="text" placeholder="Masukkan Username">
                            <label for="email-id">Alamat Email <span>*</span></label>
                            <input name="email" id="email-id" type="text" placeholder="Alamat Email">
                            <label for="userpass">Password <span>*</span></label>
                            <input name="userpass" id="userpass" type="password" placeholder="Masukkan password...">
                            <div class="login-action mb-10 fix">
                                <p>
                                Personal data anda akan digunakan untuk mendukung pengalaman Anda dalam website ini, dan untuk mengatur akses ke akun anda.
                                </p>
                            </div>
                            <a href="javascript:void(0)" class="tp-in-btn w-100 register-btn">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- account-area-end -->

</main>