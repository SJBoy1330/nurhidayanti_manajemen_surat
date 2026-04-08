<script>
    var BASE_URL = "<?= base_url(); ?>";
    var hostUrl = "<?= base_url('assets/admin/') ?>";
    var css_btn_confirm = 'btn btn-primary';
    var css_btn_cancel = 'btn btn-danger';
    var csrf_token = "<?= date('YmdHis'); ?>";
    var base_foto = "<?= image_check('notfound.jpg','default'); ?>";
    var user_base_foto = "<?= image_check('user.jpg','default'); ?>";
    var div_loading = '<div class="logo-spinner-parent">\
                    <div class="logo-spinner">\
                        <div class="logo-spinner-loader"></div>\
                    </div>\
                    <p id="text_loading">Tunggu sebentar...</p>\
                </div>';
    addEventListener('keypress', function(e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= base_url('assets/public/plugins/global/plugins.bundle.js'); ?>"></script>
<script src="<?= base_url('assets/public/js/scripts.bundle.js'); ?>"></script>
<!--end::Global Javascript Bundle-->
<!--end::Vendors Javascript-->
<script src="<?= base_url('assets/public/plugins/custom/datatables/datatables_id.bundle.js'); ?>"></script>
<script src="<?= base_url('assets/public/plugins/custom/vis-timeline/vis-timeline.bundle.js'); ?>"></script>
<!--end::Vendors Javascript-->

<script src="<?= base_url('assets/public/js/mekanik.js'); ?>"></script>
<script src="<?= base_url('assets/public/js/function.js'); ?>"></script>
<script src="<?= base_url('assets/public/js/global.js'); ?>"></script>
<script src="<?= base_url('assets/public/js/custom-datatable.js'); ?>"></script>


<?php

if (isset($js_add) && is_array($js_add)) {
    foreach ($js_add as $js) {
        echo $js;
    }
} else {
    echo (isset($js_add) && ($js_add != "") ? $js_add : "");
}

?>