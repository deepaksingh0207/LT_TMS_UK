<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20">
    <div class="row pb-10" id="data-container">
        <!-- Initial content will be loaded here, and updated via AJAX -->
        <?php echo view('user_management/users_table_partial', ['users' => $users, 'pager' => $pager]); ?>
    </div>
</div>

<script>
    let update_user_url = "<?php echo base_url('users/update') ?>";
    let add_user_url = "<?php echo base_url('users/add')?>";
</script>
<script src="<?php echo base_url(); ?>portal/user_management/index.js"></script>
<?php $this->endSection() ?>
