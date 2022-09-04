                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('customer/tambah-merk/'.encode($merk->id)) ?>" method="post" class="tambah-merk">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Merk Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $merk->nama ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>