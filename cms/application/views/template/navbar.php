<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">WeBuy Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("/products"); ?>"><i class="fa fa-list"></i> Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("/categories"); ?>"><i class="fa fa-folder"></i> Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url("/orders"); ?>"><i class="fa fa-shopping-cart"></i> Orders</a>
                </li>
            </ul>
        </div>

    </nav>
</header>