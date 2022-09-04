                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('customer/tambah-warna/'.encode($warna->id)) ?>" method="post" class="tambah-warna">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Category Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $warna->nama ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>