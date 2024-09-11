<div class="wrap">
   <div class="container db-container">

      <!-- Providers Header Start -->
        <div class="row" style="padding-bottom:40px;height: 100px;s">
          <div class="col-5">
              <h2 class="bp-title">Providers</h2>
          </div>
          <div class="col-5">
              <?php
              if (isset($_GET['message']) && $_GET['message'] == 'success') {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Provider added successfully</strong> .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
              };

              if (isset($_GET['message']) && $_GET['message'] == 'updated') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Provider updated successfully.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
              };
              if (isset($_GET['message']) && $_GET['message'] == 'deleted') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Provider deleted successfully.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
              };
              ?>
          </div>
          <div class="col-2">
              <button class="btn btn-primary new-user" type="submit" data-bs-toggle="modal" data-bs-target="#providerModal">Add Provider</button>
          </div>
        </div>
      <!-- Providers Header End -->



      <!-- Providers List Section Start -->
        <div class="row">
          <div class="col-md-12">
          <table id="customers-table" class="table align-middle mb-0 bg-white">
              <thead class="bg-light">
                <tr>
                  <th>ID</th>
                  <th class="text-center">Profile</th>
                  <th class="text-center">Full Name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Mobile</th>
                  <th class="text-center">Hourly Rate</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  global $wpdb;
                  $table_name = $wpdb->prefix . 'booking_pro_service_providers';
                  $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
                  
              ?>

              <?php if ($results) : ?>
                        <?php foreach ($results as $index => $row) : ?>
                            <tr class="customer-row">
                                <td><?php echo esc_html($index +1)?></td>
                                <td class="text-center">
                                    <div>
                                        <img
                                            src="<?php echo esc_url($row['provider_image']); ?>"
                                            alt="Profile Image"
                                            style="width: 45px; height: 45px"
                                            class="rounded-circle"
                                        />
                                    </div>
                                </td>
                                <td class="text-center">
                                    <p class="fw-normal mb-1"><?php echo esc_html($row['provider_name']); ?></p>
                                </td>
                                <td class="text-center">
                                    <p class="fw-normal mb-1"><?php echo esc_html($row['provider_email']); ?></p>
                                </td>
                                <td class="text-center">
                                    <span class="fw-normal mb-1"><?php echo esc_html($row['provider_phone']); ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-normal mb-1">$<?php echo esc_html($row['hourly_rate']); ?></span>
                                </td>
                                <td class="text-center">
                                    <button type="button" 
                                            class="btn btn-link btn-sm btn-rounded delete-btn edit-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editproviderModal" 
                                            data-id="<?php echo esc_attr($row['provider_id']); ?>"
                                            data-name="<?php echo esc_attr($row['provider_name']); ?>"
                                            data-email="<?php echo esc_attr($row['provider_email']); ?>"
                                            data-phone="<?php echo esc_attr($row['provider_phone']); ?>"
                                            data-rate="<?php echo esc_attr($row['hourly_rate']); ?>"
                                            data-image="<?php echo esc_attr($row['provider_image']); ?>"
                                    >

                                      <a class="btn btn-warning btn-sm"><span class="dashicons dashicons-edit"></span></a>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded delete-btn" data-id="<?php echo esc_attr($row['provider_id']); ?>">
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=staff&provider_id=' . $row['provider_id'])); ?>" class="btn btn-danger btn-sm"><span class="dashicons dashicons-trash"></span></a>
                                    </button>
                                    
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
              <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">No Providers available</td>
                        </tr>
              <?php endif; ?>
                
              </tbody>
            </table>
          </div>
        </div>
      <!-- Providers List Section End -->


      <!-- Insert Provider Form Start -->
        <div class="modal" id="providerModal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Add Provider Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                <!-- Modal body -->
                  <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                      <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-md-10 col-lg-10">
                                  <div class="card shadow-lg p-4 bg-light">
                                        
                                        <div class="mb-3">
                                          <label for="provider_name" class="form-label">Name</label>
                                          <input type="text" id="provider_name" name="provider_name" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                          <label for="provider_email" class="form-label">Email</label>
                                          <input type="email" id="provider_email" name="provider_email" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                          <label for="provider_phone" class="form-label">Phone</label>
                                          <input type="text" id="provider_phone" name="provider_phone" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                          <label for="provider_rate" class="form-label">Hourly Rate</label>
                                          <input type="number" id="provider_rate" name="provider_rate" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                          <label for="provider_image" class="form-label">Image</label>
                                          <input type="file" id="provider_image" name="provider_image" class="form-control" />
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                          <button type="submit" name="submit" class="btn btn-primary">Add Service Provider</button>
                                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        
                                  </div>
                              </div>
                            </div>
                      </div>
                    </form>
                  </div>

                

              </div>
            </div>
        </div>
      <!-- Insert Provider Form End -->


      <!-- Edit Provider Form Start -->
        <div class="modal" id="editproviderModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Update Provider Details</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

              <!-- Modal body -->
                <div class="modal-body">
                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="container">
                          <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-10">
                                <div class="card shadow-lg p-4 bg-light">
                                      <input type="hidden" id="e_provider_id" name="e_provider_id" value="">
                                      <div class="mb-3">
                                        <label for="e_provider_name" class="form-label">Name</label>
                                        <input type="text" id="e_provider_name" name="e_provider_name" class="form-control" required />
                                      </div>
                                      <div class="mb-3">
                                        <label for="e_provider_email" class="form-label">Email</label>
                                        <input type="email" id="e_provider_email" name="e_provider_email" class="form-control" required />
                                      </div>
                                      <div class="mb-3">
                                        <label for="e_provider_phone" class="form-label">Phone</label>
                                        <input type="text" id="e_provider_phone" name="e_provider_phone" class="form-control" />
                                      </div>
                                      <div class="mb-3">
                                        <label for="e_provider_rate" class="form-label">Hourly Rate</label>
                                        <input type="number" id="e_provider_rate" name="e_provider_rate" class="form-control" />
                                      </div>
                                      <div class="mb-3">
                                        <label for="e_provider_image" class="form-label">Image</label>
                                        <div class="d-flex">
                                        <img id="e_provider_image"
                                            src=""
                                            alt="Profile Image"
                                            style="width: 40px; height: 40px; margin-right:15px;"
                                            class="rounded-circle"
                                        />
                                        <input type="file" id="e_provider_image_input" name="e_provider_image" class="form-control p-2" />
                                        </div>
                                        
                                      </div>
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                        <button type="submit" name="e_submit" class="btn btn-primary">Update Provider</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      </div>
                                      
                                </div>
                            </div>
                          </div>
                    </div>
                  </form>
                </div>

              

            </div>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
              // Select all edit buttons
              const editButtons = document.querySelectorAll('.edit-btn');

              // Loop through each edit button
              editButtons.forEach(button => {
                  button.addEventListener('click', function() {
                      // Get data attributes from the clicked button
                      const providerId = this.getAttribute('data-id');
                      const providerName = this.getAttribute('data-name');
                      const providerEmail = this.getAttribute('data-email');
                      const providerPhone = this.getAttribute('data-phone');
                      const providerRate = this.getAttribute('data-rate');
                      const providerImage = this.getAttribute('data-image');
                      

                      // Populate the form fields with the retrieved data
                      document.getElementById('e_provider_id').value = providerId;
                      document.getElementById('e_provider_name').value = providerName;
                      document.getElementById('e_provider_email').value = providerEmail;
                      document.getElementById('e_provider_phone').value = providerPhone;
                      document.getElementById('e_provider_rate').value = providerRate;
                      document.getElementById('e_provider_image').src = providerImage;
                      
                    
                  });
              });
          });
        </script>      
      <!-- Edit Provider Form End -->






<?php
//Start Insert Function
if(isset($_POST['submit']) && 
  isset($_POST['provider_name']) && 
  isset($_POST['provider_email']) &&
  isset($_POST['provider_phone']) &&
  isset($_POST['provider_rate']) &&
  isset($_FILES['provider_image'])
 ){


    // Sanitize and validate input data
    $provider_name = sanitize_text_field($_POST['provider_name']);
    $provider_email = sanitize_email($_POST['provider_email']);
    $provider_phone = sanitize_text_field($_POST['provider_phone']);
    $provider_rate = sanitize_text_field($_POST['provider_rate']);

    // Handle file upload
    $provider_image = '';
    if (isset($_FILES['provider_image']) && !empty($_FILES['provider_image']['name'])) {
        // Get the uploaded file information
        $uploaded_file = $_FILES['provider_image'];
        

        // Get the WordPress upload directory
        $upload_dir = wp_upload_dir();
        $plugin_upload_dir = $upload_dir['basedir'] . '/booking_pro_uploads';

        // Ensure the upload directory exists
        if (!file_exists($plugin_upload_dir)) {
            wp_mkdir_p($plugin_upload_dir);
        }

        // Generate a unique file name to prevent overwriting
        $filename = wp_unique_filename($plugin_upload_dir, $uploaded_file['name']);
        $file_path = $plugin_upload_dir . '/' . $filename;

        // Move the uploaded file to the plugin's upload directory
        if (move_uploaded_file($uploaded_file['tmp_name'], $file_path)) {
            // Store the file URL for saving to the database
            
              $provider_image = $upload_dir['baseurl'] . '/booking_pro_uploads/' . $filename;
            
            
        } else {
            wp_die('File upload failed.');
        }
      }

    global $wpdb;
    $table_name = $wpdb->prefix . 'booking_pro_service_providers';

    // Insert data into database
    $result = $wpdb->insert(
      $table_name,
      array(
          'provider_name' => $provider_name,
          'provider_email' => $provider_email,
          'provider_phone' => $provider_phone,
          'hourly_rate' => $provider_rate,
          'provider_image' => $provider_image,
          'created_at' => current_time('mysql'),
          'updated_at' => current_time('mysql'),
      ),
      array(
          '%s', // provider_name
          '%s', // provider_email
          '%s', // provider_phone
          '%d', // hourly_rate
          '%s', // provider_image
          '%s', // created_at
          '%s'  // updated_at
      )
  );
  
  if (false === $result) {
      wp_die('Database insertion failed: ' . $wpdb->last_error);
  }else{
    echo '<script>window.location.href = "'.admin_url('admin.php?page=staff&message=success').'";</script>';
  }
  

}//End Insert Function
?>

<?php
//Start Update Function
if(isset($_POST['e_submit']) && 
  isset($_POST['e_provider_name']) && 
  isset($_POST['e_provider_email']) &&
  isset($_POST['e_provider_phone']) &&
  isset($_POST['e_provider_rate']) &&
  isset($_FILES['e_provider_image'])
  
 ){


    // Sanitize and validate input data
    $e_provider_id = sanitize_text_field($_POST['e_provider_id']);
    $e_provider_name = sanitize_text_field($_POST['e_provider_name']);
    $e_provider_email = sanitize_email($_POST['e_provider_email']);
    $e_provider_phone = sanitize_text_field($_POST['e_provider_phone']);
    $e_provider_rate = sanitize_text_field($_POST['e_provider_rate']);
    // $e_provider_image = sanitize_text_field($_FILES['e_provider_image']['name']);

    // Handle file upload
    $e_provider_image = esc_url($row['provider_image']);

    if (isset($_FILES['e_provider_image']) && !empty($_FILES['e_provider_image']['name'])) {

        // Get the uploaded file information
        $e_uploaded_file = $_FILES['e_provider_image'];
        

        // Get the WordPress upload directory
        $e_upload_dir = wp_upload_dir();
        $e_plugin_upload_dir = $e_upload_dir['basedir'] . '/booking_pro_uploads';

        // Ensure the upload directory exists
        if (!file_exists($e_plugin_upload_dir)) {
            wp_mkdir_p($e_plugin_upload_dir);
        }

        // Generate a unique file name to prevent overwriting
        $e_filename = wp_unique_filename($e_plugin_upload_dir, $e_uploaded_file['name']);
        $e_file_path = $e_plugin_upload_dir . '/' . $e_filename;

        // Move the uploaded file to the plugin's upload directory
        if (move_uploaded_file($e_uploaded_file['tmp_name'], $e_file_path)) {
            // Store the file URL for saving to the database
            $e_provider_image = $e_upload_dir['baseurl'] . '/booking_pro_uploads/' . $e_filename;
        } else {
            wp_die('File upload failed.');
        }
      }

      global $wpdb;
      $e_table_name = $wpdb->prefix . 'booking_pro_service_providers';

      // Update data into database
      $e_result = $wpdb->update(
        $e_table_name,                          // The table to update
        array(
            'provider_name' => $e_provider_name,    // Update the provider's name
            'provider_email' => $e_provider_email,  // Update the provider's email
            'provider_phone' => $e_provider_phone,  // Update the provider's phone
            'hourly_rate' => $e_provider_rate,      // Update the provider's hourly rate
            'provider_image' => $e_provider_image,  // Update the provider's image URL
            'updated_at' => current_time('mysql') // Update the timestamp for when the record was last updated
        ),
        array('provider_id' => $e_provider_id),           // The WHERE clause: update the row where the id matches the given provider_id
        array('%s', '%s', '%s', '%d', '%s', '%s'), // The format of the columns being updated (strings, integer, strings)
        array('%d')                            // The format for the WHERE clause (the id is an integer)
    );
    
    if (false === $e_result) {
        wp_die('Database Update failed: ' . $wpdb->last_error);
    }else{
      echo '<script>window.location.href = "'.admin_url('admin.php?page=staff&message=updated').'";</script>';
    }
  

}//End Update Function
?>


<?php
//Delete Provider
if (isset($_GET['provider_id'])) {
    $provider_id = intval($_GET['provider_id']);

    global $wpdb;
    $table_name = $wpdb->prefix . 'booking_pro_service_providers';

    // Delete the provider from the database
    $result = $wpdb->delete(
        $table_name,
        array('provider_id' => $provider_id),
        array('%d') // The format for the WHERE clause (the id is an integer)
    );

    if (false === $result) {
        wp_die('Database deletion failed: ' . $wpdb->last_error);
    } else {
        echo '<script>window.location.href = "'.admin_url('admin.php?page=staff&message=deleted').'";</script>';
    }
}//End Delete Provider
?>




  </div>
</div>