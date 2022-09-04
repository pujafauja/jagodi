
<div class="row">

    <!-- Right Sidebar -->
    <div class="col-12">
        <div class="card-box">
            <table id="my-datatable" class="table dt-responsive nowrap w-100 table-sm">
                <thead>
                    <tr>
                        <th class='text-center no-sort' rowspan="2">Service Package</th>
                        <th class='text-center no-sort' colspan="<?php echo $category->num_rows() ?>">Price per Category</th>
                        <th rowspan="2" class='no-sort text-center'>Options</th>
                    </tr>
                    <tr>
                        <?php
                        if($category->num_rows() > 0)
                        {
                            foreach($category->result() as $cat)
                            {
                                echo "<th class='text-center no-sort'>".$cat->nama."</th>";
                            }
                        }
                        ?>
                    </tr>
                </thead>
            </table>
            <div class="clearfix"></div>
        </div> <!-- end card-box -->

    </div> <!-- end Col -->
</div><!-- End row -->