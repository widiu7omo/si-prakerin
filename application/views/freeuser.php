<html>

<?php $this->load->view( '_partials/header' ); ?>

<body class="g-sidenav-hidden bg-default">
<!-- Navabr -->
<?php $this->load->view( '_partials/topnav' ); ?>
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-primary pt-5 pb-7">
        <div class="container">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="pr-5">
                            <h1 class="display-2 text-white font-weight-bold mb-0">SIM-PRA-KER-IN</h1>
                            <h2 class="display-4 text-white font-weight-light">Sistem Informasi Manajemen Praktik Kerja
                                Industri</h2>
                            <p class="text-white mt-4">Memberikan informasi seputar praktik kerja industri yang
                                berlangsung di Politeknik Negeri Tanah Laut</p>
                            <div class="mt-5">
                                <a href="#informasi-terkini" class="btn btn-neutral my-2">Informasi Terkini</a>
                                <a href="https://www.creative-tim.com/product/argon-dashboard-pro"
                                   class="btn btn-default my-2">Berita</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row pt-5">
                            <div class="col-md-6">
                                <a class="clean" href="#">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow mb-4">
                                                <i class="ni ni-bus-front-12"></i>
                                            </div>
                                            <h5 class="h3">SI Monitoring Prakerin</h5>
                                            <p>Atau yang disebut sebagai SIMPKL, merupakan sistem informasi monitoring
                                                kunjungan dosen ke perusahaan peserta prakerin.</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="clean" href="#">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow mb-4">
                                                <i class="ni ni-compass-04"></i>
                                            </div>
                                            <h5 class="h3">SI Geografis Prakerin</h5>
                                            <p>Merupakan sistem informasi yang memberikan informasi seputar letak
                                                penyebaran peserta prakerin</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 pt-lg-5 pt-4">
                                <a class="clean" href="#">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow mb-4">
                                                <i class="ni ni-bullet-list-67"></i>
                                            </div>
                                            <h5 class="h3">Kuesioner Mahasiswa</h5>
                                            <p>Kuesioner mahasiswa seputar kegiatan prakerin yang telah diikuti oleh
                                                peserta prakerin.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php $this->load->view( '_partials/separator.php' ); ?>
    </div>
    <!-- che -->
    <section class="py-6 pb-9 bg-default" id="informasi-terkini">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <h2 class="display-3 text-white">Informasi Terkini</h2>
                    <p class="lead text-white">
                        Informasi terkini terkait prakerin
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg pt-lg-0 mt--7">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5">
                                    <div class="icon icon-shape bg-gradient-primary text-white rounded-circle mb-4">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                    <h4 class="h3 text-primary text-uppercase">Based on Bootstrap 4</h4>
                                    <p class="description mt-3">Argon is built on top of the most popular open source
                                        toolkit for
                                        developing with HTML, CSS, and JS.</p>
                                    <div>
                                        <span class="badge badge-pill badge-primary">bootstrap 4</span>
                                        <span class="badge badge-pill badge-primary">dashboard</span>
                                        <span class="badge badge-pill badge-primary">template</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5">
                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle mb-4">
                                        <i class="ni ni-istanbul"></i>
                                    </div>
                                    <h4 class="h3 text-success text-uppercase">Integrated build tools</h4>
                                    <p class="description mt-3">Use Argons's included npm and gulp scripts to compile
                                        source code, run
                                        tests, and more with just a few simple commands.</p>
                                    <div>
                                        <span class="badge badge-pill badge-success">npm</span>
                                        <span class="badge badge-pill badge-success">gulp</span>
                                        <span class="badge badge-pill badge-success">build tools</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5">
                                    <div class="icon icon-shape bg-gradient-warning text-white rounded-circle mb-4">
                                        <i class="ni ni-planet"></i>
                                    </div>
                                    <h4 class="h3 text-warning text-uppercase">Full Sass support</h4>
                                    <p class="description mt-3">Argon makes customization easier than ever before. You
                                        get all the tools
                                        to make your website building process a breeze.</p>
                                    <div>
                                        <span class="badge badge-pill badge-warning">sass</span>
                                        <span class="badge badge-pill badge-warning">design</span>
                                        <span class="badge badge-pill badge-warning">customize</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--    <section class="py-6">-->
<!--        <div class="container">-->
<!--            <div class="row row-grid align-items-center">-->
<!--                <div class="col-md-6 order-md-2">-->
<!--                    <img src="--><?php //echo base_url( 'aset/img/theme/landing-1.png' ) ?><!--" class="img-fluid">-->
<!--                </div>-->
<!--                <div class="col-md-6 order-md-1">-->
<!--                    <div class="pr-md-5">-->
<!--                        <h1>Awesome features</h1>-->
<!--                        <p>This dashboard comes with super cool features that are meant to help in the process.-->
<!--                            Handcrafted-->
<!--                            components, page examples and functional widgets are just a few things you will see and love-->
<!--                            at first-->
<!--                            sight.</p>-->
<!--                        <ul class="list-unstyled mt-5">-->
<!--                            <li class="py-2">-->
<!--                                <div class="d-flex align-items-center">-->
<!--                                    <div>-->
<!--                                        <div class="badge badge-circle badge-success mr-3">-->
<!--                                            <i class="ni ni-settings-gear-65"></i>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div>-->
<!--                                        <h4 class="mb-0">Carefully crafted components</h4>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li class="py-2">-->
<!--                                <div class="d-flex align-items-center">-->
<!--                                    <div>-->
<!--                                        <div class="badge badge-circle badge-success mr-3">-->
<!--                                            <i class="ni ni-html5"></i>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div>-->
<!--                                        <h4 class="mb-0">Amazing page examples</h4>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li class="py-2">-->
<!--                                <div class="d-flex align-items-center">-->
<!--                                    <div>-->
<!--                                        <div class="badge badge-circle badge-success mr-3">-->
<!--                                            <i class="ni ni-satisfied"></i>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div>-->
<!--                                        <h4 class="mb-0">Super friendly support team</h4>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="py-6">-->
<!--        <div class="container">-->
<!--            <div class="row row-grid align-items-center">-->
<!--                <div class="col-md-6">-->
<!--                    <img src="--><?php //echo base_url( 'aset/img/theme/landing-2.png' ) ?><!--" class="img-fluid">-->
<!--                </div>-->
<!--                <div class="col-md-6">-->
<!--                    <div class="pr-md-5">-->
<!--                        <h1>Example pages</h1>-->
<!--                        <p>If you want to get inspiration or just show something directly to your clients, you can jump-->
<!--                            start your-->
<!--                            development with our pre-built example pages.</p>-->
<!--                        <a href="./pages/examples/profile.html" class="font-weight-bold text-warning mt-5">Explore-->
<!--                            pages</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="py-6">-->
<!--        <div class="container">-->
<!--            <div class="row row-grid align-items-center">-->
<!--                <div class="col-md-6 order-md-2">-->
<!--                    <img src="--><?php //echo base_url( 'aset/img/theme/landing-3.png' ) ?><!--" class="img-fluid">-->
<!--                </div>-->
<!--                <div class="col-md-6 order-md-1">-->
<!--                    <div class="pr-md-5">-->
<!--                        <h1>Lovable widgets and cards</h1>-->
<!--                        <p>We love cards and everybody on the web seems to. We have gone above and beyond with options-->
<!--                            for you to-->
<!--                            organise your information. From cards designed for content, to pricing cards or user-->
<!--                            profiles, you will-->
<!--                            have many options to choose from.</p>-->
<!--                        <a href="./pages/widgets.html" class="font-weight-bold text-info mt-5">Explore widgets</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="py-7 section-nucleo-icons bg-white overflow-hidden">-->
<!--        <div class="container">-->
<!--            <div class="row justify-content-center">-->
<!--                <div class="col-lg-8 text-center">-->
<!--                    <h2 class="display-3">Nucleo Icons</h2>-->
<!--                    <p class="lead">-->
<!--                        The official package contains over 21.000 icons which are looking great in combination with-->
<!--                        Argon Design-->
<!--                        System. Make sure you check all of them and use those that you like the most.-->
<!--                    </p>-->
<!--                    <div class="btn-wrapper">-->
<!--                        <a href="./docs/foundation/icons.html" class="btn btn-primary">View demo icons</a>-->
<!--                        <a href="https://nucleoapp.com/?ref=1712" target="_blank" class="btn btn-default mt-3 mt-md-0">View-->
<!--                            all-->
<!--                            icons</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="blur--hover">-->
<!--                <a href="./docs/foundation/icons.html">-->
<!--                    <div class="icons-container blur-item mt-5">-->
                        <!-- Center -->
<!--                        <i class="icon ni ni-diamond"></i>-->
                        <!-- Right 1 -->
<!--                        <i class="icon icon-sm ni ni-album-2"></i>-->
<!--                        <i class="icon icon-sm ni ni-app"></i>-->
<!--                        <i class="icon icon-sm ni ni-atom"></i>-->
                        <!-- Right 2 -->
<!--                        <i class="icon ni ni-bag-17"></i>-->
<!--                        <i class="icon ni ni-bell-55"></i>-->
<!--                        <i class="icon ni ni-credit-card"></i>-->
                        <!-- Left 1 -->
<!--                        <i class="icon icon-sm ni ni-briefcase-24"></i>-->
<!--                        <i class="icon icon-sm ni ni-building"></i>-->
<!--                        <i class="icon icon-sm ni ni-button-play"></i>-->
                        <!-- Left 2 -->
<!--                        <i class="icon ni ni-calendar-grid-58"></i>-->
<!--                        <i class="icon ni ni-camera-compact"></i>-->
<!--                        <i class="icon ni ni-chart-bar-32"></i>-->
<!--                    </div>-->
<!--                    <span class="blur-hidden h5 text-success">Eplore all the 21.000+ Nucleo Icons</span>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="py-7">-->
<!--        <div class="container">-->
<!--            <div class="row row-grid justify-content-center">-->
<!--                <div class="col-lg-8 text-center">-->
<!--                    <h2 class="display-3">Do you love this awesome <span-->
<!--                                class="text-success">Dashboard for Bootstrap 4?</span>-->
<!--                    </h2>-->
<!--                    <p class="lead">Cause if you do, it can be yours now. Hit the button below to navigate to get the-->
<!--                        free-->
<!--                        version or purchase a license for your next project. Build a new web app or give an old-->
<!--                        Bootstrap project-->
<!--                        a new look!</p>-->
<!--                    <div class="btn-wrapper">-->
<!--                        <a href="https://www.creative-tim.com/product/argon-dashboard"-->
<!--                           class="btn btn-neutral mb-3 mb-sm-0"-->
<!--                           target="_blank">-->
<!--                            <span class="btn-inner--text">Get FREE version</span>-->
<!--                        </a>-->
<!--                        <a href="https://www.creative-tim.com/product/argon-dashboard-pro"-->
<!--                           class="btn btn-primary btn-icon mb-3 mb-sm-0">-->
<!--                            <span class="btn-inner--icon"><i class="ni ni-basket"></i></span>-->
<!--                            <span class="btn-inner--text">Purchase now</span>-->
<!--                            <span class="badge badge-md badge-pill badge-floating badge-danger border-white">$79</span>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="text-center">-->
<!--                        <h4 class="display-4 mb-5 mt-5">Available on these technologies</h4>-->
<!--                        <div class="row justify-content-center">-->
<!--                            <div class="col-md-2 col-3 my-2">-->
<!--                                <a href="https://www.creative-tim.com/product/argon-dashboard" target="_blank"-->
<!--                                   data-toggle="tooltip"-->
<!--                                   data-original-title="Bootstrap 4 - Most popular front-end component library">-->
<!--                                    <img-->
<!--                                            src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/bootstrap.jpg"-->
<!--                                            class="img-fluid rounded-circle shadow shadow-lg--hover">-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="col-md-2 col-3 my-2">-->
<!--                                <a href=" https://vuejs.org/" target="_blank" data-toggle="tooltip"-->
<!--                                   data-original-title="[Coming Soon] Vue.js - The progressive javascript framework">-->
<!--                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/vue.jpg"-->
<!--                                         class="img-fluid rounded-circle opacity-3">-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="col-md-2 col-3 my-2">-->
<!--                                <a href=" https://www.sketchapp.com/" target="_blank" data-toggle="tooltip"-->
<!--                                   data-original-title="[Coming Soon] Sketch - Digital design toolkit">-->
<!--                                    <img-->
<!--                                            src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/sketch.jpg"-->
<!--                                            class="img-fluid rounded-circle opacity-3">-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="col-md-2 col-3 my-2">-->
<!--                                <a href=" https://www.adobe.com/products/photoshop.html" target="_blank"-->
<!--                                   data-toggle="tooltip"-->
<!--                                   data-original-title="[Coming Soon] Adobe Photoshop - Software for digital images manipulation">-->
<!--                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/ps.jpg"-->
<!--                                         class="img-fluid rounded-circle opacity-3">-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="col-md-2 col-3 my-2">-->
<!--                                <a href=" https://angularjs.org/" target="_blank" data-toggle="tooltip"-->
<!--                                   data-original-title="[Coming Soon] Angular - One framework. Mobile &amp; desktop">-->
<!--                                    <img-->
<!--                                            src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/angular.jpg"-->
<!--                                            class="img-fluid rounded-circle opacity-3">-->
<!--                                </a>-->
<!--                            </div>-->
<!--                            <div class="col-md-2 col-3 my-2">-->
<!--                                <a href=" https://angularjs.org/" target="_blank" data-toggle="tooltip"-->
<!--                                   data-original-title="[Coming Soon] React - A JavaScript library for building user interfaces">-->
<!--                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/react.jpg"-->
<!--                                         class="img-fluid rounded-circle opacity-3">-->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
</div>
<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    © 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative
                        Tim</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About
                            Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?php echo base_url( 'aset/vendor/jquery/dist/jquery.min.js' ) ?>"></script>
<script src="<?php echo base_url( 'aset/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ) ?>"></script>
<script src="<?php echo base_url( 'aset/vendor/js-cookie/js.cookie.js' ) ?>"></script>
<script src="<?php echo base_url( 'aset/vendor/jquery.scrollbar/jquery.scrollbar.min.js' ) ?>"></script>
<script src="<?php echo base_url( 'aset/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js' ) ?>"></script>
<script src="<?php echo base_url( 'aset/vendor/lavalamp/js/jquery.lavalamp.min.js' ) ?>"></script>
<!-- Optional JS -->
<script src="<?php echo base_url( 'aset/vendor/onscreen/dist/on-screen.umd.min.js' ) ?>"></script>
<!-- Argon JS -->
<script src="<?php echo base_url( 'aset/js/argonpro.js?v=1.0.0' ) ?>"></script>
</body>

</html>
