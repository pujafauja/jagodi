<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Track Order</h4>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h5 class="mt-0">Order ID:</h5>
                            <p>#<?php echo $order->noPembelian ?></p>
                        </div>
                    </div>
                </div>

                <div class="track-order-list">
                    <ul class="list-unstyled">
                        <li class="<?php echo $order->status > 1 ? 'completed' : ''; ?>">
                            <?php echo $order->status == '1' ? '<span class="active-dot dot"></span>' : '' ?>
                            <h5 class="mt-0 mb-1">Order Placed</h5>
                            <p class="text-muted"><?php echo tanggalindo($order->tanggal) ?> <small class="text-muted"><?php echo $order->waktu ?></small> </p>
                        </li>
                        <li class="<?php echo $order->status > 2 ? 'completed' : ''; ?>">
                            <?php echo $order->status == '2' ? '<span class="active-dot dot"></span>' : '' ?>
                            <h5 class="mt-0 mb-1">Packed</h5>
                        </li>
                        <li class="<?php echo $order->status > 3 ? 'completed' : ''; ?>">
                            <?php echo $order->status == '3' ? '<span class="active-dot dot"></span>' : '' ?>
                            <h5 class="mt-0 mb-1">Shipped</h5>
                        </li>
                        <li class="<?php echo $order->status > 4 ? 'completed' : ''; ?>">
                            <?php echo $order->status == 4 ? '<span class="active-dot dot"></span>' : '' ?>
                            <h5 class="mt-0 mb-1"> Delivered</h5>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Items from Order #<?php echo $order->noPembelian ?></h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Additional Info</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; foreach(json_decode($order->details) as $products): ?>
                            <tr>
                                <th scope="row"><?php echo $products->nama ?></th>
                                <td><?php echo $products->qty ?></td>
                                <td>Rp <?php echo rupiah($products->price) ?></td>
                                <td>
                                    <ul>
                                    <?php foreach(json_decode($products->addItems) as $adds): ?>
                                        <?php foreach($adds as $addItem => $addValue): ?>
                                            <li><?php echo $addItem ?>: <?php echo $addValue ?></li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                    </ul>
                                </td>
                                <td>Rp <?php echo rupiah($products->subtotal) ?></td>
                            </tr>
                            <?php $total += $products->subtotal; endforeach; ?>
                            <tr>
                                <th scope="row" colspan="4" class="text-right">Total :</th>
                                <td><div class="font-weight-bold">Rp <?php echo rupiah($total) ?></div></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Shipping Information</h4>
                <?php $customer = json_decode($order->customerDetails) ?>

                <h5 class="font-family-primary font-weight-semibold"><?php echo $customer->namaDepan . ' ' . $customer->namaBelakang ?></h5>
                
                <p class="mb-2"><span class="font-weight-semibold mr-2">Address:</span> <?php echo $customer->alamat . ' ' . $customer->alamat2 . ' ' . $customer->kabupaten . ' ' . $customer->provinsi . ' ' . $customer->kode ?></p>
                <p class="mb-0"><span class="font-weight-semibold mr-2">Mobile / WA:</span> <?php echo $customer->hp ?></p>
                <p class="mb-0"><span class="font-weight-semibold mr-2">E-mail:</span> <?php echo $customer->email ?></p>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Note Order</h4>

                <p><?php echo $order->catatan ?></p>

            </div>
        </div>
    </div> <!-- end col -->

</div>
<!-- end row -->