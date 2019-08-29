<nav class="navbar navbar-expand-lg bg-dark">
<div class="container">
    <!-- brand logo -->
    <a href="/sakila/index" class="navbar-brand text-light">
        SAKILA <small class="font-weight-light">movies</small>
    </a>

    <!-- navbar principal -->
    <ul class="navbar-nav">
    <?php if ($username != null): ?>
    <!-- Vista si hay usuario en sesión -->
        <li class="nav-item">
            <a class="nav-link text-light text-center bg-info border border-secondary rounded-circle film-cart" href="/sakila/rentals" title="Your Film Rentals">
                <i class="fa fa-film"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-light text-center bg-success border border-secondary rounded-circle film-cart mx-1" href="/sakila/cart" title="Film Cart">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link btn btn-secondary px-3" href="/sakila/index">
                <i class="fa fa-home"></i> Index
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link btn btn-danger ml-1 px-3" href="/sakila/index?logout=yes">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </li>

        <li class="nav-item my-auto">
            <a class="nav-link ml-2 btn btn-light my-auto pt-1 pb-0 px-1" href="settings">
                <i class="fa fa-gear settings-icon"></i>
            </a>
        </li>

        <img src="/uploads/<?php echo $prof_pic ?>" class="ml-2 img-fluid profile-pic">
        <p class="text-light ml-2 my-auto pfl-username"> 
            <?php echo $username ?>
        </p>
    <?php else: ?>

        <li class="nav-item">
            <a class="nav-link btn btn-secondary px-3" href="/sakila/index">
                <i class="fa fa-home"></i> Index
            </a>
        </li>

        <li class="nav-item">
            <button type="button" class="nav-link text-light btn btn-primary ml-1 px-3" data-toggle="modal" data-target="#login">
                <i class="fa fa-user"></i> Login
            </button>
        </li>

        <li class="nav-item">
            <a class="nav-link text-light btn btn-success ml-1 px-3" href="signup">
                <i class="fa fa-sign-in"></i> Sign up
            </a>
        </li>

    <?php endif ?>
        </ul>
    </div>
</nav>
