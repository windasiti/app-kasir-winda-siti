<?= $this->extend('layout/tamplate'); ?>
 <?= $this->section('konten'); ?>

 <main id="main" class="main">
    <section class="section">
        <div class="row">
        <div class="col-lg-12">

        <div class="card">
            <div class="card-body- pt-3">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title"> profile detail</h5>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                    <div class="col-lg-9 col-md-8">
                    <?= session()->get('nama_user'); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8">
                    <?= session()->get('username'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Password</div>
                    <div class="col-lg-9 col-md-8">
                    <?= session()->get('password'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Level</div>
                    <div class="col-lg-9 col-md-8">
                    <?= session()->get('level'); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
 </main>
 <?= $this->endSection(); ?>