<nav class="navbar sticky-top">
    <div class="container">
        <div class="navbar-brand">
            <a href="<?php echo APP_URL; ?>" class="logo">
                <i class="fas fa-leaf"></i>
                <span>Mental Wellness Support</span>
            </a>
        </div>

        <button class="navbar-toggle" id="navbarToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navbar-menu" id="navbarMenu">
            <ul class="navbar-nav">
                <li><a href="<?php echo APP_URL; ?>/index" class="nav-link">Home</a></li>
                <li><a href="<?php echo APP_URL; ?>/about" class="nav-link">About</a></li>
                <li><a href="<?php echo APP_URL; ?>/services" class="nav-link">Services</a></li>
                <li><a href="<?php echo APP_URL; ?>/doctors" class="nav-link">Doctors</a></li>
                <li><a href="<?php echo APP_URL; ?>/chatbot" class="nav-link">Chat</a></li>
                <li><a href="<?php echo APP_URL; ?>/contact" class="nav-link">Contact</a></li>
            </ul>

            <div class="navbar-actions">
                <?php if ($auth->isLoggedIn()): ?>
                    <a href="<?php echo APP_URL; ?>/user/dashboard" class="btn-nav-secondary">
                        <i class="fas fa-user"></i> Dashboard
                    </a>
                    <a href="<?php echo APP_URL; ?>/user/login?logout=true" class="btn-nav-secondary">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                <?php elseif ($auth->isDoctorLoggedIn()): ?>
                    <a href="<?php echo APP_URL; ?>/doctor/dashboard" class="btn-nav-secondary">
                        <i class="fas fa-user-md"></i> Doctor
                    </a>
                    <a href="<?php echo APP_URL; ?>/doctor/login?logout=true" class="btn-nav-secondary">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                <?php elseif ($auth->isAdminLoggedIn()): ?>
                    <a href="<?php echo APP_URL; ?>/admin/dashboard" class="btn-nav-secondary">
                        <i class="fas fa-tachometer-alt"></i> Admin
                    </a>
                    <a href="<?php echo APP_URL; ?>/admin/login?logout=true" class="btn-nav-secondary">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="<?php echo APP_URL; ?>/user/login" class="btn-nav-secondary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="<?php echo APP_URL; ?>/booking" class="btn-nav-primary">
                        <i class="fas fa-calendar"></i> Book
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
