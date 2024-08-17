<nav class="navbar navbar-expand-lg bg-light exnav">
  <div class="container-fluid">
    <a class="navbar-brand logo" href="index.php"><i class="fas fa-code"></i> System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link fs-5 <?=(basename($_SERVER['PHP_SELF']) == "home.php")?"active":""; ?>" href="home.php"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 <?=(basename($_SERVER['PHP_SELF']) == "profile.php")?"active":""; ?>" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 <?=(basename($_SERVER['PHP_SELF']) == "feedback.php")?"active":""; ?>" href="feedback.php"><i class="fas fa-comment-dots"></i> Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-5 <?=(basename($_SERVER['PHP_SELF']) == "notification.php")?"active":""; ?>" href="notification.php"><i class="fas fa-bell"></i> Notification <span id="checkNotification"></span></a>
        </li>
      </ul>
    </div>
    <li class="nav-item dropdown " style="list-style-type: none;">
      <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
         <i class="fas fa-user-cog"></i> &nbsp; Hi! <span class="text-danger"><?= $fname; ?> </span>
      </a>
      <div class="dropdown-menu">
         <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Sitting</a>
         <a href="component/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </li>
  </div>
</nav>

