<div class="my-container" id="my-container">
    <div class="my-form-container my-sign-up">
    </div>
    <div class="my-form-container my-sign-in">
    <form class="form w-100" method="POST" novalidate="novalidate" id="form_login" action="<?= base_url('auth_function/login_proses') ?>">
        <h1>Masuk</h1>
        <span class="mb-5 text-center">Sistem Arsip Surat</span>
        <div class="fv-row w-100 mb-6">
            <input type="text" id="username" placeholder="Masukkan username" name="username" autocomplete="off" class="form-control  form-control-solid w-100" required/>
            </div>
            <div class="fv-row w-100 mb-3" data-kt-password-meter="true">
            <input type="password" id="password" onkeyup="hideye(this, '#hideye')" placeholder="Masukkan kata sandi" name="password" autocomplete="off" class="form-control  form-control-solid w-100" required/>
            <span class="btn btn-sm btn-icon position-absolute translate-middle end-0 me-n2 d-none" id="hideye" style="top: 50%;" data-kt-password-meter-control="visibility">
                <i class="fa-solid fa-eye fs-5 text-muted"></i>
                <i class="fa-solid fa-eye-slash fs-5 text-muted d-none"></i>
            </span>
        </div>
        <button type="submit" id="button_login">
            <span class="indicator-label">Masuk</span>
        </button>
    </form>
    </div>
    <div class="my-toggle-container">
    <div class="my-toggle">
        <div class="my-toggle-panel my-toggle-left">
        </div>
        <div class="my-toggle-panel my-toggle-right">
        <?php if(isset($setting->icon_white) && $setting->icon_white != '' && file_exists('./data/setting/'.$setting->icon_white)) : ?>
            <div class="background-partisi-contain" style="background-image : url('<?= image_check($setting->icon_white,'setting'); ?>');width : 100px;height : 100px;"></div>
        <?php endif;?>
        <h1 class="text-white">Selamat Datang!!!</h1>
        <p class="text-white">
            Login menggunakan akun terdaftar untuk akses ke halaman utama
        </p>
        </div>
    </div>
    </div>
</div>