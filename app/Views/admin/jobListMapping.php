
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-contents") ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Job List Mapping</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Job ID</th>
                                            <th>Job Title</th>
                                            <th>Check Mark</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                            <th>Job ID</th>
                                            <th>Job Title</th>
                                            <th>Check Mark</th>
                                        </tr>
                                    </tfoot>
 <tbody>
                                    <?php
                                        foreach($data as $jobList)
                                        { ?>
<tr>
                                            <td><?=$jobList["job_id"]?></td>
                                            <td><?=$jobList["job_title"]?></td>
                                            <td>
                                                <?php
                                                if($jobList["applied"] == "checked")
                                                {
                                                    echo '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>';
                                                }else{

                                                    echo '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>';
                                                }
                                                ?>
                                                </td>
                                        </tr>
                                            <?php
                                             }

                                     ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?= $this->endSection() ?>