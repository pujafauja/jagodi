<style>
    .fa-times{
        cursor: pointer;
    }
    .fa-plus{
        cursor: pointer;
    }
</style>

<div class="row" >
	<div class="col">
		<div class="card d-none" id="filter-location">
			<div class="card-body">

				<div class="card-widgets">
                    <a data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="filter"><i class="mdi mdi-plus"></i></a>
				</div>

				<a data-toggle="collapse" href="#filter" role="button" aria-expanded="false" aria-controls="filter">
				    <h5 class="card-title mb-0">
				        <i class="mdi mdi-database-search mr-1"></i>
				        <span class="d-none d-sm-inline">Filter</span>
				    </h5>
				</a>
                <div id="filter" class="collapse pt-1">
                	<div class="row">
                		<div class="col-md-6">
                			<div class="form-group">
                			  	<label for="part-lok" class="col-form-label">Sparepart</label>
								<div class="input-group">
            			    		<div class="input-group-addon">
            			    			<a href="<?php echo base_url() ?>stock/search-part-lok" id="search-part-lok" class="btn btn-primary">
            			    				<div class="fa fa-search"></div>
            			    			</a>
            			    		</div>
            				        <input type="text" class="form-control" value="" name="part-location" readonly="" id="part-lok">
            				        <input type="hidden" name="part-location-id" value="0">
            			    		<div class="input-group-addon">
            			    			<div id="reset-part" class="btn btn-danger">
            			    				<div class="fa fa-ban"></div>
            			    			</div>
            			    		</div>
            			    	</div>
                			</div>
                		</div>
                        <input type="hidden" name="hassave" value="">
                		<div class="col-md-6">
                			<div class="form-group">
                			  	<label for="part-lok" class="col-form-label">Location</label>
            			    	<div class="input-group">
            			    		<div class="input-group-addon">
            			    			<a href="<?php echo base_url() ?>stock/search-location-lok" id="search-location-lok" class="btn btn-primary">
            			    				<div class="fa fa-search"></div>
            			    			</a>
            			    		</div>
            				        <input type="text" class="form-control" value="" name="location-a" readonly="" id="location-lok">
            				        <input type="hidden" name="location-a-id" value="0">
            			    		<div class="input-group-addon">
            			    			<div id="reset-location" class="btn btn-danger">
            			    				<div class="fa fa-ban"></div>
            			    			</div>
            			    		</div>
            			    	</div>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>


		<div class="card">
            <div class="card-header text-right">
                <div class="btn-group">
                    <button id="newTransaction" class="btn btn-success"><i class="fa fa-plus-circle mr-1 "></i> New Transfer Location</button>
                    <!-- <button id="newItem" class="btn btn-primary"><i class="fa fa-plus-circle mr-1 "></i> Add Beginning</button> -->
                </div>
            </div>
			<div class="card-body" id="table-location">
                
			</div>
            <div class="card-footer" id="table-footer">
                
            </div>
		</div>
	</div>
</div>

