

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-8">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="inputPassword2" class="sr-only">Search</label>
                            <div class="input-group">
                                <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fe-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="text-lg-right mt-3 mt-lg-0">
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#add-team"><i class="mdi mdi-plus-circle mr-1"></i> Add New</button>
                    </div>
                </div><!-- end col-->
            </div> <!-- end row -->
        </div> <!-- end card-box -->
    </div><!-- end col-->
</div>
<!-- end row -->

<!-- Modal -->
<div class="modal fade" id="add-team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Team</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form id="form-team">
                    <div class="form-group">
                        <label for="profile-picture">Profile Picture</label>
                        <input type="hidden" name="id">
                        <input name="picture" type="file" data-plugins="dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M" />
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Enter position">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-primary text-light">
                                    <i class="fe-facebook"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter Facebook URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-primary text-light">
                                    <i class="fe-linkedin"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter Linkedin URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-info text-light">
                                    <i class="fe-twitter"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter Twitter URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-blue text-light">
                                    <i class="fe-instagram"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Enter Instagram URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bio">Biography</label>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="">English Version</label>
                                <textarea class="form-control" name="bio"></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="">Versi Indonesia</label>
                                <textarea class="form-control" name="bioINA"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="btn-group btn-block">
                            <button class="btn btn-primary publish-team" type="submit"><i class="fe-upload-cloud mr-1"></i>Publish</button>
                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fe-x mr-1"></i>Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

<div class="row">
    <div class="team-members col-12 text-center">
        
    </div>
</div>