<div class="wrap">
  <div class="container db-container">


      <!-- Services Header Start -->
        <div class="row" style="padding-bottom:40px; height:100px;">
          <div class="col-5">
              <h2 class="bp-title">Services</h2>
          </div>
          <div class="col-5">
              <?php
              if (isset($_GET['message']) && $_GET['message'] == 'success') {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Services added successfully</strong> .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
              };

              if (isset($_GET['message']) && $_GET['message'] == 'updated') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Services updated successfully.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
              };
              if (isset($_GET['message']) && $_GET['message'] == 'deleted') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Services deleted successfully.</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
              };
              ?>
          </div>
          <div class="col-2">
              <button class="btn btn-primary new-user" type="submit" data-bs-toggle="modal" data-bs-target="#addserviceModal">Add Service</button>
          </div>
        </div>
      <!-- Services Header End -->


      <!-- Service List Section Start -->
        <div class="row">
            <table id="customers-table" class="table align-middle mb-0 bg-white">
              <thead class="bg-light">
                <tr>
                  <th>ID</th>
                  <th class="text-center">Serviec Name</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Duration</th>
                  
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      global $wpdb;
                      $table_name = $wpdb->prefix . 'booking_pro_services';
                      $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);  
                ?>
                <?php if ($results) : ?>
                    <?php foreach ($results as $index => $row) : ?>
                        <tr class="customer-row">
                            <td><?php echo esc_html($index +1)?></td>
                                                            
                            <td class="text-center">
                                <p class="fw-normal mb-1"><?php echo esc_html($row['service_name']); ?></p>
                            </td>
                            <td class="text-center">
                                <p class="fw-normal mb-1"><?php echo esc_html($row['description']); ?></p>
                            </td>
                            <td class="text-center">
                                <span class="fw-normal mb-1">$<?php echo esc_html($row['price']); ?></span>
                            </td>
                            <td class="text-center">
                                <span class="fw-normal mb-1"><?php echo esc_html($row['duration']); ?>H</span>
                            </td>
                            <td class="text-center">
                                <button type="button" 
                                        class="btn btn-link btn-sm btn-rounded delete-btn service-edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editserviceModal"
                                        data-id="<?php echo esc_attr($row['service_id']); ?>"
                                        data-name="<?php echo esc_attr($row['service_name']); ?>"
                                        data-description="<?php echo esc_attr($row['description']); ?>"
                                        data-price="<?php echo esc_attr($row['price']); ?>"
                                        data-duration="<?php echo esc_attr($row['duration']); ?>"
                                        
                                >

                                  <a class="btn btn-warning btn-sm"><span class="dashicons dashicons-edit"></span></a>
                                </button>
                                <button type="button" class="btn btn-link btn-sm btn-rounded delete-btn" data-id="<?php echo esc_attr($row['service_id']); ?>">
                                <a href="<?php echo esc_url(admin_url('admin.php?page=services&service_id=' . $row['service_id'])); ?>" class="btn btn-danger btn-sm"><span class="dashicons dashicons-trash"></span></a>
                                </button>
                                
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                          <tr>
                              <td colspan="7" class="text-center">No Services Available</td>
                          </tr>
                <?php endif; ?>

                

                
              </tbody>
            </table>

        </div>
      <!-- Service List Section End -->


      <!-- Insert Service Form Start -->
        <div class="modal" id="addserviceModal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Add Service</h4>
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
                                            <label for="service_name" class="form-label">Service Name</label>
                                            <input type="text" id="service_name" name="service_name" class="form-control" required />
                                          </div>
                                          <div class="mb-3">
                                            <label for="service_description" class="form-label">Description</label>
                                            <textarea id="service_description" name="service_description" class="form-control" required></textarea>
                                          </div>
                                          <div class="mb-3">
                                            <label for="service_price" class="form-label">Price</label>
                                            <input type="number" id="service_price" name="service_price" class="form-control" required />
                                          </div>
                                          <div class="mb-3">
                                            <label for="service_duration" class="form-label">Duration</label>
                                            <input type="number" id="service_duration" name="service_duration" class="form-control" required />
                                          </div>
                                          <!-- Modal footer -->
                                          <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Add Service</button>
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
      <!-- Insert Service Form End -->

      <!-- Edit Service Form Start -->
        <div class="modal" id="editserviceModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Update Service</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                    <!-- Modal body -->
                      <div class="modal-body">
                        <form method="post" action="" enctype="multipart/form-data">
                          <div class="container">
                                <div class="row justify-content-center">
                                  <div class="col-md-10 col-lg-10">
                                      <div class="card shadow-lg p-4 bg-light">

                                            <input type="hidden" name="e_service_id" value="<?php echo esc_html($row['service_id']); ?>">
                                            <div class="mb-3">
                                              <label for="e_service_name" class="form-label">Service Name</label>
                                              <input type="text" id="e_service_name" name="e_service_name" class="form-control" required />
                                            </div>
                                            <div class="mb-3">
                                              <label for="e_service_description" class="form-label">Description</label>
                                              <textarea id="e_service_description" name="e_service_description" class="form-control" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                              <label for="e_service_price" class="form-label">Price</label>
                                              <input type="number" id="e_service_price" name="e_service_price" class="form-control" required />
                                            </div>
                                            <div class="mb-3">
                                              <label for="e_service_duration" class="form-label">Duration</label>
                                              <input type="text" id="e_service_duration" name="e_service_duration" class="form-control" required />
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="submit" name="e_submit" class="btn btn-primary">Update Service</button>
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
                const editButtons = document.querySelectorAll('.service-edit-btn');

                // Loop through each edit button
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                      //console.log(document.getElementById('e_service_id')); // Check if this logs an element or null

                        // Get data attributes from the clicked button
                        const serviceId = this.getAttribute('data-id');
                        const serviceName = this.getAttribute('data-name');
                        const serviceDescription = this.getAttribute('data-description');
                        const servicePrice = this.getAttribute('data-price');
                        const serviceDuration = this.getAttribute('data-duration');
                        
                        

                        // Populate the form fields with the retrieved data
                        document.getElementById('e_service_name').value = serviceName;
                        document.getElementById('e_service_description').value = serviceDescription;
                        document.getElementById('e_service_price').value = servicePrice;
                        document.getElementById('e_service_duration').value = serviceDuration;
                        
                        
                      
                    });
                });
            });
          </script> 
      <!-- Edit Provider Form End -->     

    

<?php
//Start Insert Function
if(isset($_POST['submit']) && 
  isset($_POST['service_name']) && 
  isset($_POST['service_description']) && 
  isset($_POST['service_price']) && 
  isset($_POST['service_duration'])

 ){


    // Sanitize and validate input data
    $service_name = sanitize_text_field($_POST['service_name']);
    $service_description = sanitize_textarea_field($_POST['service_description']);
    $service_price = floatval($_POST['service_price']);
    $service_duration = intval($_POST['service_duration']);
    

    global $wpdb;
    $table_name = $wpdb->prefix . 'booking_pro_services';

    // Insert data into database  
    $result = $wpdb->insert(
        $table_name,
        array(
            'service_name' => $service_name,
            'description' => $service_description,
            'price' => $service_price,
            'duration' => $service_duration
        ),
        array(
            '%s',
            '%s',
            '%f',
            '%d'
        )
    );
  
  if (false === $result) {
      wp_die('Database insertion failed: ' . $wpdb->last_error);
  }else{
    echo '<script>window.location.href = "'.admin_url('admin.php?page=services&message=success').'";</script>';
  }
  

}//End Insert Function


//Start Update Function
if(isset($_POST['e_submit']) &&
  isset($_POST['e_service_name']) &&
  isset($_POST['e_service_description']) &&
  isset($_POST['e_service_price']) &&
  isset($_POST['e_service_duration'])

 ){


    // Sanitize and validate input data
    $e_service_id = intval($_POST['e_service_id']);
    $e_service_name = sanitize_text_field($_POST['e_service_name']);
    $e_service_description = sanitize_textarea_field($_POST['e_service_description']);
    $e_service_price = floatval($_POST['e_service_price']);
    $e_service_duration = intval($_POST['e_service_duration']);


    global $wpdb;
    $table_name = $wpdb->prefix . 'booking_pro_services';

    // Update data into database
    $e_result = $wpdb->update(
        $table_name,
        array(
            'service_name' => $e_service_name,
            'description' => $e_service_description,
            'price' => $e_service_price,
            'duration' => $e_service_duration
        ),
        array('service_id' => $e_service_id),
        array(
            '%s',
            '%s',
            '%f',
            '%d'
        ),
        array('%d')
    );

  if (false === $e_result) {
      wp_die('Database update failed: ' . $wpdb->last_error);
  }else{
    echo '<script>window.location.href = "'.admin_url('admin.php?page=services&message=updated').'";</script>';
  }


}//End Update Function


//Start Delete Function
if (isset($_GET['service_id'])) {
    $service_id = intval($_GET['service_id']);

    global $wpdb;
    $table_name = $wpdb->prefix . 'booking_pro_services';

    $result = $wpdb->delete(
        $table_name,
        array('service_id' => $service_id),
        array('%d')
    );

    if (false === $result) {
        wp_die('Database deletion failed: ' . $wpdb->last_error);
    } else {
        echo '<script>window.location.href = "'.admin_url('admin.php?page=services&message=deleted').'";</script>';
    }
}
//End Delete Function

?>




  </div>
</div>                
