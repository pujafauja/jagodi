                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('company/tambah-category/'.encode($company->id)) ?>" method="post" class="tambah-category">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Category Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $company->nama ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>