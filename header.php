<?php
include 'db_connect.php';
function getListById($table, $selectedState) {
  global $db; // Ensure $db is accessible if using it to fetch data

  $options = '';
  $stmt = $db->prepare("SELECT * FROM $table");
  $stmt->execute();
  $states = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($states as $state) {
      $selected = ($state['state_name'] === $selectedState) ? 'selected' : '';
      $options .= "<option value=\"{$state['state_id']}\" $selected>{$state['state_name']}</option>";
  }

  return $options;
}

function getListByIddis($table, $selectedDistrict) {
  global $db; // Ensure $db is accessible if using it to fetch data

  $options = '';
  $stmt = $db->prepare("SELECT * FROM $table");
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($districts as $district) {
      $selected = ($district['district_name'] === $selectedDistrict) ? 'selected' : '';
      $options .= "<option value=\"{$district['district_id']}\" $selected>{$district['district_name']}</option>";
  }

  return $options;
}

?>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Company Name</span>
      </a>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>