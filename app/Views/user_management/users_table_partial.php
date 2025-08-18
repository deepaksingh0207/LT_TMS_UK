<div class="col-xl-12 col-lg-12 col-md-12 card-box pb-10">
    <div class="row h5 pd-20 mb-0">
        <div class="col-md-10">Users</div>
        <div class="col-md-2 text-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#bd-example-modal-lg">
                <i class="icon-copy bi bi-person-plus-fill"></i>
                <span class="pl-3">Add</span>
            </button>
        </div>
    </div>
    <table class="data-table table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Name</th>
                <th>Email</th>
                <th>SAP User Code</th>
                <th>Group</th>
                <th>Approved</th>
                <th>Active</th>
                <th class="datatable-nosort">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center">

                                <div class="txt">
                                    <div class="weight-600"><?php echo $user->first_name . " " . $user->last_name ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->sap_user_code; ?></td>
                        <td><?php echo ucwords($user->group) ?? ''; ?></td>
                        <td>
                            <div class="">
                                <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="yes" data-off="no" data-onstyle="success" data-offstyle="warning" id="yesNoSwitch" <?php echo $user->is_approved ? "checked" : ""; ?> value="<?php echo $user->is_approved; ?>" onchange="updateUser(<?php echo $user->id ?> , 'is_approved')">
                            </div>
                        </td>
                        <td>
                            <div class="">
                                <input type="checkbox" data-toggle="toggle" data-size="sm" data-on="active" data-off="in-active" data-onstyle="success" data-offstyle="warning" id="statusSwitch" <?php echo $user->active ? 'checked' : ''; ?> value=<?php echo $user->active; ?> onchange="updateUser(<?php echo $user->id ?> , 'active')">
                            </div>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="#" data-color="#265ed7"><i class="icon-copy dw dw-edit2"></i></a>
                                <!-- <a href="#" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a> -->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3" class="py-3 px-6 text-center text-gray-500">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-6 flex justify-center">
    <!-- Render pagination links -->
    <?= $pager->links('default', 'bootstrap_full') ?>
</div>

<div class="modal fade bs-example-modal-md" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> 
    <div class="modal-dialog modal-md modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"> Add User </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">SAP User Code : </label>
                                <input type="text" name="sap_user_code" id="sap_user_code" class="form-control" placeholder="Enter SAP User Code">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">First Name : </label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Last Name : </label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Email ID : </label>
                                <input type="text" name="email_id" id="email_id" class="form-control" placeholder="Enter Email Id">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Role : </label>
                                <select name="group" id="group" class="form-control">
                                    <option value="" selected>--- Select Role ---</option>
                                    <option value="admin">Admin</option>
                                    <option value="employee">Employee</option>
                                    <option value="transporter">Transporter</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close </button> -->
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>