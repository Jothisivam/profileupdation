<?php include "db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>

<body>
  <main class="bg-light">
    <div class="container">
      <section class="border-0 section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block">Company Name</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your employee Id & DOB to login</p>
                  </div>

                  <form id="form_login" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Employee Id</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please enter your employee Id.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Date of Joining</label>
                      <input type="date" name="joiningdate" class="form-control" id="joiningdate" required>
                      <div class="invalid-feedback">Please enter your Date of Joining!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="smt-btn" type="submit">
                        <span id="button-text">Login</span>
                        <span id="loader" style="display: none;">
                          <div class="spinner-border spinner-border-sm text-light" role="status">
                          </div>
                        </span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  <?php include "footer.php"; ?>
  <script>
$(document).ready(function() {
    $("#form_login").on('submit', function(e) {
        e.preventDefault(); 
        // Show loading indicator
        $("#loader").show();
        $('#smt-btn').prop('disabled', true);
        $("#button-text").hide();

        $.ajax({
            type: "POST",
            url: "verifyuser.php",
            data: new FormData(this),
            contentType: false, 
            processData: false, 
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    let errorMessage = data.error ? data.error : 'Invalid username or password';
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage,
                    });
                }
            },
            error: function(xhr, status, error) {
                alert("An error occurred while processing your request. Please try again later.");
            },
            complete: function() {
                // Hide loading indicator and enable the button
                $("#button-text").show();
                $('#smt-btn').prop('disabled', false);
                $("#loader").hide();
            }
        });
    });
});
</script>

</body>

</html>