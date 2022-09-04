                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('company/tambah-sub/'.encode($company->id)) ?>" method="post" class="tambah-sub">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Category Name <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="id_cat">
                                                            <option value="">Choose one</option>
                                                            <?php 
                                                            foreach($category['query']->result() as $cat) { ?>
                                                                <option value="<?php echo $cat->id ?>" <?php echo ($cat->id == $company->id_cat) ? 'selected=""' : '' ?>><?php echo $cat->nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleinput">Sub Company Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $company->nama ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simpleinput">Address <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="address"><?php echo $company->address ?></textarea>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>