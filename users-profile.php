<?php
include "db_connect.php";

$user_id = $_SESSION['username'];

$sql = "SELECT cp.company_id,cp.fullname,cp.address,d.district_name,s.state_name,cp.postal_code,cp.joining_date,cp.phone_number,cp.email,cp.job_role,cp.photo,cp.dob,cp.created_at,cp.updated_at
FROM company_profiles cp
JOIN districts d ON cp.district_id = d.district_id
JOIN states s ON cp.state_id = s.state_id
WHERE cp.company_id = :company_id";
$stmt = $db->prepare($sql);
$stmt->execute(['company_id' => $user_id]);
$results = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
<?php include "header.php"; ?>

<body class="toggle-sidebar">
  <main id="main" class="main">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php echo !empty($results['photo']) ? $results['photo'] : 'assets/img/3135715.png'; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $results['fullname']; ?></h2>
              <h3><?php echo $results['job_role']; ?></h3>
              <div class="social-links mt-2">
                <b><?php echo $results['company_id']; ?></b>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['fullname']; ?></div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['dob']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['job_role']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['state_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">District</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['district_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['address']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Postal Code</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['postal_code']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['phone_number']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $results['email']; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="editProfileForm" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img id="profileImg" src="<?php echo !empty($results['photo']) ? $results['photo'] : 'assets/img/3135715.png'; ?>" alt="Profile" style="width: 100px; height: auto;">
                        <div class="pt-2">
                          <input type="file" name="profile_image" id="profileImage" class="form-control" accept="image/*" style="display: none;">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" id="uploadImageBtn">
                            <i class="bi bi-upload"></i>
                          </a>
                          <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image">
                            <i class="bi bi-trash"></i>
                          </a> -->
                        </div>
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo $results['fullname']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="dob" type="date" class="form-control" id="dob" value="<?php echo $results['dob']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?php echo $results['job_role']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">State</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="state" type="text" class="form-control" id="state" onchange="getDistrict(this.value)" value="<?php echo $results['state_id']; ?>">
                          <?php echo getListById('states', $_SESSION['state_name']); ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">District</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="district" type="text" class="form-control" id="district" value="<?php echo $results['district_id']; ?>">
                          <?php echo getListByIddis('districts', $_SESSION['district_name']); ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Postal Code</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="postcode" type="text" class="form-control" id="postcode" value="<?php echo $results['postal_code']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $results['phone_number']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?php echo $results['email']; ?>">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <?php include "footer.php"; ?>

  <script>
    $(document).ready(function() {
      $("#editProfileForm").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
          url: 'uploadProfile.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $("#profileImg").attr("src", response.newImagePath);
              swal({
                icon: 'success',
                title: 'Success!',
                text: 'Profile updated successfully.',
              });
            } else {
              swal({
                icon: 'error',
                title: 'Oops...',
                text: response.error || 'An error occurred while updating your profile.',
              });
            }
          },
          error: function(xhr, status, error) {
            alert("An error occurred while processing your request. Please try again later.");
          }
        });
      });
    });
  </script>


  <script>
    $(document).ready(function() {
      $('#state').change(function() {
        var selectedForCd = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'getdistrict.php',
          data: {
            state_cd: selectedForCd
          },
          success: function(response) {
            $('#district').html(response);
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Trigger file input when the upload button is clicked
      $("#uploadImageBtn").on('click', function(e) {
        e.preventDefault(); // Prevent the default action
        $("#profileImage").click(); // Programmatically click the file input
      });

      // Show a preview of the selected image
      $("#profileImage").on('change', function() {
        const file = this.files[0]; // Get the selected file
        if (file) {
          const reader = new FileReader(); // Create a FileReader object
          reader.onload = function(event) {
            $("#profileImg").attr("src", event.target.result); // Update the src of the profile image
          };
          reader.readAsDataURL(file); // Read the file as a data URL
        }
      });
    });
  </script>


</body>

</html>