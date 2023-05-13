
<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-contents") ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>DOB </th>
                                            <th>City</th>
                                            <th>PIN Code</th>
                                            <th>Service Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>User Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>DOB </th>
                                            <th>City</th>
                                            <th>PIN Code</th>
                                            <th>Service Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </tfoot>
 <tbody>
                                    <?php
                                        foreach($data as $listItems)
                                        { ?>
<tr>
                                            <td><?=$listItems["user_name"]?></td>
                                            <td><?=$listItems["email"]?></td>
                                            <td><?=$listItems["mobile_number"]?></td>
                                            <td><?=$listItems["address"]?></td>
                                            <td><?=$listItems["dob"]?></td>
                                            <td><?=$listItems["city"]?></td>
                                            <td><?=$listItems["pic_code"]?></td>
                                            <td><?=$listItems["service_name"]?></td>
                                            <td><?=$listItems["createdAt"]?></td>
                                            <td><?=$listItems["updatedAt"]?></td>
                                        </tr>
                                            <?php }

                                     ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?= $this->endSection() ?>