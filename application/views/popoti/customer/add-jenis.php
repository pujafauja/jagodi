                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('customer/tambah-jenis/'.encode($jenis->id)) ?>" method="post" class="tambah-jenis">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Nama Jenis <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $jenis->nama ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>