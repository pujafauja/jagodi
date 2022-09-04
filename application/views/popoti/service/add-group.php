                                        <div class="row">
                                            <div class="col-lg-12">

                                                <form action="<?php echo site_url('service/tambah-group/'.encode($group->id)) ?>" method="post" class="tambah-group">

                                                    <div class="form-group">
                                                        <label for="simpleinput">Group Name <span class="text-danger">*</span></label>
                                                        <input type="text" id="simpleinput" name="nama" class="form-control" value="<?php echo $group->nama ?>">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div id='ResponseInput'></div>