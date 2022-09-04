                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="prices-datatable" class="table dt-responsive nowrap w-100 table-sm">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Name</th>
                                                    <th class='text-center no-sort' colspan="<?php echo $category->num_rows() ?>">Price per Category</th>
                                                    <th rowspan="2" class='no-sort'>Options</th>
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

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->