<div class="wrap">

   <div class="container db-container">

      <div class="row" style="padding-bottom:40px;">
        <div class="col-10">
            <h2 class="bp-title">Providers</h2>
        </div>
        <div class="col-2">
            <button class="btn btn-primary new-user" type="submit">Add Provider</button>
        </div>
        
      </div>
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
              <tr class="customer-row">
                
                <div class="td-container">
                <td>1</td>
                <td class="text-center">
                  <div class="">
                    <img
                        src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                        />
                  </div>
                </td>
                <td class="text-center">
                  <p class="fw-normal mb-1">Md Laju Miah</p> 
                </td>
                <td class="text-center">
                  <p class="fw-normal mb-1">developerlaju@gmail.com</p> 
                </td>
                <td class="text-center">
                  <span class="fw-normal mb-1">+8801704217202</span>
                </td>
                <td class="text-center">
                  <span class="fw-normal mb-1">$20</span>
                </td>
                <td class="text-center">
                  
                  <button type="button" class="btn btn-link btn-sm btn-rounded">
                    <span class="dashicons dashicons-trash"></span>
                  </button>
                  
                </td>
                </div>
              </tr>
 
              
            </tbody>
          </table>
         </div>
      </div>



      <div class="row">
      <form method="post" action="" enctype="multipart/form-data">
            <?php wp_nonce_field('booking_pro_save_service_provider', 'booking_pro_nonce'); ?>
            <?php $upload_dir = wp_upload_dir();
            $plugin_upload_dir = $upload_dir['basedir'] . '/booking_pro_uploads';

            // Ensure the upload directory exists
            if (!file_exists($plugin_upload_dir)) {
                wp_mkdir_p($plugin_upload_dir);
            }
              print_r($upload_dir);
             ?>
            <input type="hidden" name="action" value="save_service_provider">
            <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-md-8 col-lg-6">
                        <div class="card shadow-lg p-4 bg-light">
                              <h2 class="h4 mb-4 text-center">Service Provider Details</h2>
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
                              
                              <div class="text-center">
                                 <button type="submit" name="submit" class="btn btn-primary">Add Service Provider</button>
                              </div>
                        </div>
                     </div>
                  </div>
            </div>
         </form>
      </div>


   </div>
</div>

<?php

// if (!current_user_can('manage_options')) {
//   wp_die('You do not have sufficient permissions to access this page.');
// }
// if (isset($_GET['message']) && $_GET['message'] == 'success') {
//   echo '<div class="alert alert-success" role="alert">Service provider added successfully!</div>';
// }
// ?>

<?php
if(isset($_POST['submit']) && 
  isset($_POST['provider_name']) && 
  isset($_POST['provider_email']) &&
  isset($_POST['provider_phone']) &&
  isset($_POST['provider_rate']) &&
  isset($_POST['provider_image'])
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
  }
  

    }//end function
    // Redirect after submission
    //wp_redirect(admin_url('admin.php?page=staff&message=success'));
    exit;
