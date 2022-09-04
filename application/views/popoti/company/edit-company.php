                    <form method="post" action="<?php echo base_url('company/save-company') ?>" id="form-company">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="card-box">
                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Company Logo</h5>
                                    <form method="post" action="" id="upload-logo">
                                        <img src="<?php echo base_url('upload/popoti/'.$general['gambar']) ?>" class="img-fluid rounded" id="company-logo">
                                        <div class="progress mb-2 mt-2 d-none">
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <label for="logo-upload" class="col-lg-12 mt-3">
                                            <button class="btn btn-block btn-md btn-primary waves-effect waves-light" id="upload" type="button"><i class="fas fa-folder-open mr-1"></i> Ganti logo</button>
                                        </label>
                                        <input type="file" name="logo" id="logo-upload" style="visibility: hidden;">
                                        <span class="mt-3 alert" id="responseMessage"></span>
                                    </form>
                                </div> <!-- end col-->
                                
                                <div class="card-box">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>
                                    <div class="form-group mb-3">
                                        <label for="company-name">Company Name <span class="text-danger">*</span></label>
                                        <input type="text" id="company-name" name="title" class="form-control" placeholder="e.g : Apple iMac" value="<?php echo $general['title'] ?>">
                                        <small class="text-danger"><em><?php echo form_error('nama') ?></em></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="company-description">Address <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="company-description" name="address" rows="5" placeholder="Please enter description"><?php echo $general['address'] ?></textarea>
                                        <small class="text-danger"><em><?php echo form_error('address') ?></em></small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="company-name">Email <span class="text-danger">*</span></label>
                                        <input type="text" id="company-name" name="email" class="form-control" value="<?php echo $general['email'] ?>">
                                        <small class="text-danger"><em><?php echo form_error('nama') ?></em></small>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="company-name">Phone <span class="text-danger">*</span></label>
                                        <input type="text" id="company-name" name="phone" class="form-control" value="<?php echo $general['phone'] ?>">
                                        <small class="text-danger"><em><?php echo form_error('nama') ?></em></small>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="company-name">Fax </label>
                                        <input type="text" id="company-name" name="fax" class="form-control" value="<?php echo $general['fax'] ?>">
                                        <small class="text-danger"><em><?php echo form_error('nama') ?></em></small>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="company-name">NPWP <span class="text-danger">*</span></label>
                                        <input type="text" id="company-name" name="npwp" class="form-control" value="<?php echo $general['npwp'] ?>">
                                        <small class="text-danger"><em><?php echo form_error('nama') ?></em></small>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->

                            <div class="col-lg-6">    

                                <div class="card-box">
                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Social Media</h5>
                                    <div class="form-group mb-3">
                                        <label for="">Facebook</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">https://facebook.com/</span>
                                            </div>
                                            <input type="text" name="facebook" value="<?php echo $general['facebook'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Instagram</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">https://instagram.com/</span>
                                            </div>
                                            <input type="text" name="instagram" value="<?php echo $general['instagram'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Twitter</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">https://twitter.com/</span>
                                            </div>
                                            <input type="text" name="twitter" value="<?php echo $general['twitter'] ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">LinkedIn</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">https://linkedin.com/in/</span>
                                            </div>
                                            <input type="text" name="linkedin" value="<?php echo $general['linkedin'] ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>    

                                <div class="card-box">
                                    <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Bank Account And Contact</h5>

                                    <div class="form-group">
                                        <label for="">Bank Name <span class="text-danger">*</span></label>
                                        <input type="text" name="nama-bank" class="form-control" value="<?php echo $general['namaBank'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account Number <span class="text-danger">*</span></label>
                                        <input type="text" name="noRek" class="form-control" value="<?php echo $general['noRek'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Account Holder <span class="text-danger">*</span></label>
                                        <input type="text" name="atasNama" class="form-control" value="<?php echo $general['atasNama'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">WA Konfirmasi Pembayaran <span class="text-danger">*</span></label>
                                        <input type="text" name="hpWa" class="form-control" value="<?php echo $general['hpWa'] ?>">
                                    </div>
                                </div>

                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light" id="save">Save</button>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </form>