<main>
    <!-- checkout-area-start -->
    <section class="checkout-area pt-80 pb-85">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="coupon-accordion mb-20">
                            <!-- ACCORDION START -->
                            <h3>Sudah punya akun? <span id="showlogin">Klik di sini untuk login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text">Gunakan username / email dan password Anda untuk login.</p>
                                    <form action="#" id="login">
                                        <p class="form-row-first">
                                        <label>Username atau email <span class="required">*</span></label>
                                        <input type="text" name="name">
                                        </p>
                                        <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="password" name="pass">
                                        </p>
                                        <p class="form-row">
                                        <button class="tp-btn-h1 login-btn" type="submit">Login</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <!-- ACCORDION END -->
                        </div>

                        <div class="checkbox-form">
                            <h3>Penagihan & Pengiriman</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="country-select">
                                        <label>Negara / Wilayah <span class="required">*</span></label>
                                        <select name="country" disabled>
                                            <option selected value="indonesia">Indonesia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Nama Depan <span class="required">*</span></label>
                                        <input type="text" placeholder="" name="nama-depan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Nama Belakang <span class="required">*</span></label>
                                        <input type="text" placeholder="" name="nama-belakang">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Nama Perusahaan <em class="text-muted">(Opsional)</em></label>
                                        <input type="text" placeholder="" name="nama-perusahaan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Alamat Rumah <span class="required">*</span></label>
                                        <input type="text" placeholder="Alamat Rumah" name="alamat-rumah">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input type="text" placeholder="No Rumah, Apartment, No. Blok (Opsional)" name="alamat-rumah2">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Kota / Kabupaten <span class="required">*</span></label>
                                        <input type="text" placeholder="Kota / Kabupaten" name="kabupaten-kota">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Provinsi <span class="required">*</span></label>
                                        <input type="text" placeholder="Provinsi" name="provinsi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Kode POS <span class="required">*</span></label>
                                        <input type="text" placeholder="Kode POS" name="kode-pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Alamat Email <span class="required">*</span></label>
                                        <input type="email" placeholder="" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>No. HP / WA <span class="required">*</span></label>
                                        <input type="text" placeholder="No. HP / WA" name="hp">
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Informasi Tambahan</label>
                                    </h3>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Catatan Pesanan <em class="text-muted">(Opsional)</em></label>
                                        <textarea id="checkout-mess" cols="30" rows="10" placeholder="Catatan tentang pesanan Anda, misal: catatan khusus untuk pengiriman" name="catatan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="your-order mb-10">
                            <h3>Ongkos Kirim</h3>
                        </div>

                        <div class="your-order mb-30 ">
                            <h3>Pesanan Anda</h3>
                            <h4 class="order-no">Nomor Pembelian: <span><?php echo rand(0000000, 9999999) ?></span></h4>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Produk</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($this->data['keranjang']->num_rows() > 0):
                                            $total = 0;
                                            foreach($this->data['keranjang']->result() as $keranjang):
                                                $harga   = $keranjang->price;
                                                $totDisc = 0;

                                                if($this->data['diskon'][$keranjang->productid]):
                                                    if(count($this->data['diskon'][$keranjang->productid]) > 0):
                                                        foreach($this->data['diskon'][$keranjang->productid] as $discounts):
                                                            foreach($discounts as $typeDisc => $nominal):
                                                                if($typeDisc == '%'):
                                                                    $totDisc += ($nominal / 100) * $harga;
                                                                    $harga -= ($nominal / 100) * $harga;
                                                                else:
                                                                    $totDisc += $nominal;
                                                                    $harga -= $nominal;
                                                                endif;
                                                            endforeach;
                                                        endforeach;
                                                    endif;
                                                endif;

                                                if($this->data['diskon']['all']):
                                                    foreach($this->data['diskon']['all'] as $discountsall):
                                                        foreach($discountsall as $typeDisc => $nominal):
                                                            if($typeDisc == '%'):
                                                                $totDisc += ($nominal / 100) * $harga;
                                                                $harga -= ($nominal / 100) * $harga;
                                                            else:
                                                                $totDisc += $nominal;
                                                                $harga -= $nominal;
                                                            endif;
                                                        endforeach;
                                                    endforeach;
                                                endif;

                                                $price = $harga < 1 ? 0 : $harga;
                                        ?>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?php echo $keranjang->nama ?> <strong class="product-quantity"> × <?php echo $keranjang->qty ?></strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">Rp <?php echo rupiah($keranjang->qty * $price) ?> <?php echo $totDisc > 0 ? '<small class="text-danger ml-5"><del>'.rupiah($keranjang->subtotal).'</del></small>' : '' ?></span>
                                                <?php $total += $keranjang->qty * $price ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">Rp <?php echo rupiah($total) ?></span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="payment-method">
                                <div class="accordion" id="checkoutAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="checkoutOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankOne" aria-expanded="true" aria-controls="bankOne">
                                            Transfer via Bank
                                            </button>
                                        </h2>
                                        <div id="bankOne" class="accordion-collapse collapse show" aria-labelledby="checkoutOne" data-bs-parent="#checkoutAccordion">
                                            <div class="accordion-body">
                                                <p>
                                                    Harap transfer sesuai harga tertera ke rekening <?php echo $setting->namaBank ?> <?php echo $setting->noRek ?> a/n <?php echo $setting->atasNama ?>.<br>
                                                    Gunakan NO PEMBELIAN sebagai referensi. Mohon mengirim bukti pembayaran.<br>
                                                    Konfirmasi Pembayaran Melalui : WA <?php echo $setting->hpWa ?><br>
                                                    <br>
                                                    Order akan dikirim setelah konfirmasi transfer selesai.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-button-payment mt-20">
                                    <button type="button" class="tp-btn-h1 buat-pesanan">Buat Pesanan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- checkout-area-end -->

</main>