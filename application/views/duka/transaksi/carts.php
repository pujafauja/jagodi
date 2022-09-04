<!-- cart-area-start -->
<section class="cart-area pt-120 pb-120">
    <div class="container">
       <div class="row">
          <div class="col-12">
                <form action="#">
                   <div class="table-content table-responsive">
                      <table class="table">
                            <thead>
                               <tr>
                                  <th class="product-thumbnail">Gambar</th>
                                  <th class="cart-product-name">Produk</th>
                                  <th class="product-price">Harga Satuan</th>
                                  <th class="product-quantity">Quantity</th>
                                  <th class="product-discount">Diskon</th>
                                  <th class="product-subtotal">Total</th>
                                  <th class="product-remove">Hapus</th>
                               </tr>
                            </thead>
                            <tbody>
                              <?php
                              $total = 0;
                              if($this->data['keranjang']->num_rows() > 0):
                                 foreach($this->data['keranjang']->result() as $carts):
                                    $image = json_decode($carts->images);
                                    ?>
                                     <tr>
                                        <td class="product-thumbnail"><img src="<?php echo base_url('media/products/md/'.$image[0]) ?>" alt=""></td>
                                        <td class="product-name" data-product="<?php echo encode($carts->productid) ?>"><?php echo $carts->nama ?></td>
                                        <td class="product-price"><span class="amount currency"><?php echo $carts->price ?></span></td>
                                        <td class="product-quantity">
                                           <div class="cart-plus-minus">
                                                <input type="text" class="product__quantity" value="<?php echo $carts->qty ?>">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                           </div>
                                        </td>
                                        <td class="product-discount">
                                          <?php
                                          $harga   = $carts->price;
                                          $totDisc = 0;

                                          if($diskon[$carts->productid]):
                                              if(count($diskon[$carts->productid]) > 0):
                                                  foreach($diskon[$carts->productid] as $discounts):
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

                                          if($diskon['all']):
                                              foreach($diskon['all'] as $discountsall):
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

                                          $subtotal = $carts->qty * $price;
                                          ?>
                                          <span class="amount currency"><?php echo $totDisc ?></span>
                                       </td>
                                        <td class="product-subtotal"><span class="amount currency"><?php echo $subtotal ?></span></td>
                                        <td class="product-remove"><a href="" class="remove-product"><i class="fa fa-times"></i></a></td>
                                     </tr>
                                 <?php 
                                 $total += $subtotal;
                                 endforeach; ?>
                              <?php endif; ?>
                            </tbody>
                      </table>
                   </div>
                   <div class="row justify-content-end">
                      <div class="col-md-5">
                            <div class="cart-page-total">
                               <h2>Cart totals</h2>
                               <ul class="mb-20">
                                  <li>Total <span class="total currency"><?php echo $total ?></span></li>
                               </ul>
                               <?php if($total > 0): ?>
                               <a class="tp-btn-h1" href="<?php echo base_url('checkout') ?>">Checkout</a>
                               <?php endif; ?>
                            </div>
                      </div>
                   </div>
                </form>
          </div>
       </div>
    </div>
 </section>
 <!-- cart-area-end -->