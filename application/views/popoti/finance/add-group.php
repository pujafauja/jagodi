                                        <div class="row">

                                            <div class="col-lg-12">



                                                <form action="<?php echo site_url('finance/tambah-group/'.encode($group->id)) ?>" method="post" class="tambah-group">



                                                    <div class="form-group">

                                                        <label for="simpleinput">Code <span class="text-danger">*</span></label>

                                                        <input type="text" id="simpleinput" name="kode" class="form-control currency" value="<?php echo $group->kode ?>">

                                                    </div>

                                                    <div class="form-group">

                                                        <label for="simpleinput">Group Name <span class="text-danger">*</span></label>

                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $group->nama ?>">

                                                    </div>

                                                    <div class="form-group">

                                                        <label for="simpleinput">Saldo Normal <span class="text-danger">*</span></label>

                                                        <select class="form-control" name="normal">
                                                            <option value="dr" <?php echo ($group->normal == 'dr') ? 'selected=""' : '' ?>>Debit</option>
                                                            <option value="cr" <?php echo ($group->normal == 'cr') ? 'selected=""' : '' ?>>Kredit</option>
                                                        </select>

                                                    </div>



                                                </form>

                                            </div>

                                        </div>



                                        <div id='ResponseInput'></div>