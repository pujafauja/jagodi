<div class="row">
    <div class="col-lg-12">
        
        <div class="card">
            <div class="card-body">
                
                <h4 class="header-title mb-3">Add New Employee <div class="text-primary ml-3" role="status" id="loading"></div></h4>

                <div id='ResponseInput'></div>

                <div id="rootwizard">
                    
                    <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                        <li class="nav-item" data-target-form="#personal">
                            <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-card-account-details mr-1"></i>
                                <span class="d-none d-sm-inline">Personal Data</span>
                            </a>
                        </li>
                        <li class="nav-item" data-target-form="#access-sallary">
                            <a href="#second" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-currency-usd-circle-outline mr-1"></i>
                                <span class="d-none d-sm-inline">Access & Sallary</span>
                            </a>
                        </li>
                        <li class="nav-item" data-target-form="#finish">
                            <a href="#third" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-account-check mr-1"></i>
                                <span class="d-none d-sm-inline">Finish</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mb-0 b-0 pt-0">

                        <div class="tab-pane" id="first">
                            <form id="personal" method="post" action="<?php echo base_url('employee/tambah-employee/'.encode($employee->id)) ?>" class="form-horizontal">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label">Start Day <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="text" name="registeredday" class="form-control basic-datepicker" value="<?php echo $employee->registeredday ?>" required="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar-month"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">No. Identity <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input required="" type="text" id="" name="noid" class="form-control" value="<?php echo $employee->noid ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">NPWP</label>
                                            <div class="col-md-9">
                                                <input type="text" id="" name="npwp" class="form-control" value="<?php echo $employee->npwp ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input required="" type="text" id="" name="nama" class="form-control" value="<?php echo $employee->nama ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">Nickname</label>
                                            <div class="col-md-9">
                                                <input type="text" id="" name="panggilan" class="form-control" value="<?php echo $employee->panggilan ?>">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="" class="">Gender <span class="text-danger">*</span></label>
                                                <select class="form-control" required="" name="jk">
                                                    <option value="L" <?php echo ($employee->jk == 'L') ? 'selected=""' : '' ?>>Male</option>
                                                    <option value="P" <?php echo ($employee->jk == 'P') ? 'selected=""' : '' ?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="" class="">Marriage <span class="text-danger">*</span></label>
                                                <select class="form-control" required="" name="merriage">
                                                    <option value="1" <?php echo ($employee->merriage == '1') ? 'selected=""' : '' ?>>Single</option>
                                                    <option value="2" <?php echo ($employee->merriage == '2') ? 'selected=""' : '' ?>>Enganged</option>
                                                    <option value="3" <?php echo ($employee->merriage == '3') ? 'selected=""' : '' ?>>Married</option>
                                                    <option value="4" <?php echo ($employee->merriage == '4') ? 'selected=""' : '' ?>>Deforced</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">Address <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <textarea required="" class="form-control" name="alamat"><?php echo $employee->alamat ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">Phone <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input required="" type="text" name="no" class="form-control" value="<?php echo $employee->no ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="" class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" name="email" class="form-control" value="<?php echo $employee->email ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="second">
                            <form id="access-sallary" method="post" action="<?php echo base_url('employee/tambah-employee/'.encode($employee->id)) ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-group row mb-3">
                                            <div class="col-md-6">
                                                <label>Upload KTP <span class="text-danger">*</span></label>
                                                <input name="ktp" type="file" data-plugins="dropify" data-height="150" <?php echo ($employee->ktp) ? 'data-default-file="'.base_url('upload/files/'.$employee->ktp).'"' : '' ?> data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />                                                
                                            </div>
                                            <div class="col-md-6">
                                                <label>Upload Photo <span class="text-danger">*</span></label>
                                                <input name="avatar" type="file" data-plugins="dropify" data-height="150" <?php echo ($employee->photo) ? 'data-default-file="'.base_url('upload/files/'.$employee->photo).'"' : '' ?> data-allowed-file-extensions="png jpg jpeg" data-max-file-size="3M" />                                                
                                            </div>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-6">
                                                <label for="" class="">Position <span class="text-danger">*</span></label>
                                                <select class="form-control" name="position" required="">
                                                    <option value="">Choose One</option>
                                                    <?php
                                                    if($position->num_rows() > 0)
                                                    {
                                                        foreach($position->result() as $p): ?>
                                                            <option value="<?php echo $p->id ?>" <?php echo ($employee->position == $p->id) ? 'selected=""' : '' ?>><?php echo $p->nama ?></option>
                                                        <?php endforeach;
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="" class="">Sub Company <span class="text-danger">*</span></label>
                                                <select class="form-control" name="subcompanyid" required="">
                                                    <option value="0" <?php echo ($employee->position == '0') ? 'selected=""' : '' ?>>Pusat</option>
                                                    <?php
                                                    if($sub->num_rows() > 0)
                                                    {
                                                        foreach($sub->result() as $s): ?>
                                                            <option value="<?php echo $s->id ?>" <?php echo ($employee->subcompanyid == $s->id) ? 'selected=""' : '' ?>><?php echo $s->nama ?></option>
                                                        <?php endforeach;
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                
                                        <div class="form-row mb-3">                                
                                            <div class="form-group col-md-4">
                                                <label for="" class="">Access to System <span class="text-danger">*</span></label>
                                                <select class="form-control" name="hasAccess" required="">
                                                    <option value="0" <?php echo ($employee->hasAccess == '0') ? 'selected=""' : ''; ?>>Non-User</option>
                                                    <option value="1" <?php echo ($employee->hasAccess == '1') ? 'selected=""' : ''; ?>>User</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="" class="">Status <span class="text-danger">*</span></label>
                                                <select class="form-control" name="statusKaryawan" required="">
                                                    <option value="0" <?php echo ($employee->statusKaryawan == '0') ? 'selected=""' : ''; ?>>Percobaan</option>
                                                    <option value="1" <?php echo ($employee->statusKaryawan == '1') ? 'selected=""' : ''; ?>>Kontrak</option>
                                                    <option value="2" <?php echo ($employee->statusKaryawan == '2') ? 'selected=""' : ''; ?>>Tetap</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="">Cover BPJS <span class="text-danger">*</span></label>
                                                <select class="form-control" name="bpjs" required="">
                                                    <option value="0" <?php echo ($employee->bpjs == '0') ? 'selected=""' : ''; ?>>No</option>
                                                    <option value="1" <?php echo ($employee->bpjs == '1') ? 'selected=""' : ''; ?>>Yes</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3 <?php echo ($employee->password) ? '' : 'd-none' ?>" id="hasAccess">
                                            <label>Password</label>
                                            <div class="input-group input-group-merge">
                                                <input name="password" type="password" id="password" class="form-control" placeholder="Enter password" <?php echo ($employee->password) ? '' : 'disabled=""' ?>>
                                                <div class="input-group-append" data-password="false">
                                                    <div class="input-group-text">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="" class="col-md-12 col-form-label"><h4>Sallary</h4></label>
                                        </div>

                                        <div class="form-row mb-3">
                                            <div class="form-group col-md-4">
                                                <label>Gaji Pokok <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="pokok" class="form-control currency" value="<?php echo $employee->pokok ?>" required="">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Uang Makan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="makan" class="form-control currency" value="<?php echo $employee->makan ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Uang Transport</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="transport" class="form-control currency" value="<?php echo $employee->transport ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Tunjangan Jabatan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="tunjangan" class="form-control currency" value="<?php echo $employee->tunjangan ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Lain-lain</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input type="text" name="another" class="form-control currency" value="<?php echo $employee->another ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="third">
                            <div class="row">
                                <div class="col-12" id="response">
                                    
                                </div>
                            </div>
                        </div>

                        <ul class="list-inline wizard mb-0">
                            <li class="previous list-inline-item"><a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                            </li>
                            <li class="next list-inline-item float-right"><a href="javascript: void(0);" class="btn btn-secondary">Next</a></li>
                            <li class="finish list-inline-item float-right"><a href="javascript: void(0);" class="btn btn-secondary">Finish</a></li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>