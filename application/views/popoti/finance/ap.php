<div class="card">
    <div class="card-body">
        <div class="card-widgets">
            <!-- <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a> -->
            <a data-toggle="collapse" href="#service_information" role="button" aria-expanded="false" aria-controls="service_information"><i class="mdi mdi-minus"></i></a>
            <!-- <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a> -->
        </div> 
        <a data-toggle="collapse" href="#service_information" role="button" aria-expanded="false" aria-controls="service_information">
            <h5 class="card-title mb-0">
                <i class="mdi mdi-cog-clockwise mr-1"></i>
                <span class="d-none d-sm-inline">Filter</span>
            </h5>
        </a>
        <!-- <a href="#" class="btn-link bor">test</a> -->
        <div id="service_information" class="collapse show pt-3">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="">Supplier</label>
                        <select name="supplierid" id="" class="form-control">
                            <option value="All">All</option>
                            <option value="0">Other</option>
                            <?php foreach($supplier->result() as $supp): ?>
                                <option value="<?php echo $supp->id ?>"><?php echo $supp->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col col-md-8 text-left">
                    <div class="input-group mt-3">
                       <button type="button" name="submit" id="alldateAp" class="btn btn-warning"><span class="fa mr-1 fa-calendar"></span> Retrieve All</button>
                       <button type="button" name="submit" id="FilterAp" class="btn btn-success"><i class="fa mr-1 fa-search"></i> Filter</button>
                   </div>
                </div>
            </div>  
        </div>
    </div>
</div> <!-- end card-->

<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="card-body">
               <table id="ap-datatable" class="table dt-responsive nowrap w-100">
                  <thead>
                      <tr>
                            <th class="">Supplier Name</th>
                            <!-- <th class="">Debit</th>
                            <th class="">Credit</th> -->
                            <th class="no-sort">Amount</th>
                        </tr>
                    </thead>
                </table>
          </div> <!-- end card body-->
       </div> <!-- end card -->
    </div><!-- end col-->
</div>



<!-- end row-->











