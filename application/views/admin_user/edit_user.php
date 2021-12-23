<!-- Begin Page Content -->
<div class="container-fluid">


   <div class="row">
      <div class="col-lg-6">

         <!-- Basic Card Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">
               <form action="<?php echo site_url(); ?>admin_manage_user/edit_user/<?php echo $user['id']; ?>" <?php echo $user['id']; ?> method="post">
                  <div class="form-group row">
                     <label for="username" class="col-lg-3 col-form-label">Username *</label>
                     <div class="col-lg-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" autofocus>
                        <?php echo form_error('username', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password" class="col-lg-3 col-form-label">Password *</label>
                     <div class="col-lg-9">
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>"></input>
                        <?php echo form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="role" class="col-lg-3 col-form-label">Role *</label>
                     <div class="col-lg-9">
                        <select class="form-control" id="role" name="role">
                           <?php if ($user['role'] == 1) : ?>
                              <option value="Admin" selected>Admin</option>
                              <option value="Pegawai">Pegawai</option>
                           <?php else : ?>
                              <option value="Admin">Admin</option>
                              <option value="Pegawai" selected>Pegawai</option>
                           <?php endif; ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="alamat" class="col-lg-3 col-form-label">Alamat *</label>
                     <div class="col-lg-9">
                        <input type="alamat" class="form-control" id="alamat" name="alamat" value="<?php echo $user['alamat']; ?>"></input>
                        <?php echo form_error('alamat', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="telepon" class="col-lg-3 col-form-label">Telepon *</label>
                     <div class="col-lg-9">
                        <input type="telepon" class="form-control" id="telepon" name="telepon" value="<?php echo $user['telepon']; ?>"></input>
                        <?php echo form_error('telepon', '<small class="text-danger pl-2">', '</small>'); ?>
                     </div>
                  </div>
                  <small style="color: red;">*harus diisi</small>
                  <div class="d-flex mt-4">
                     <a href="<?php echo site_url(); ?>admin_manage_user" class="btn btn-secondary ml-auto">Kembali</a>
                     <button type="submit" class="btn btn-primary ml-3">Edit</button>
                  </div>
               </form>
            </div>
         </div>

      </div>
   </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->