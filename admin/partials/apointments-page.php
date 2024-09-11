<?php 
global $wpdb;

$table_bookings=$wpdb->prefix.'booking_pro_bookings';
$bookings = $wpdb->get_results("SELECT * FROM $table_bookings", ARRAY_A);

$table_services=$wpdb->prefix.'booking_pro_services';


$table_providers=$wpdb->prefix.'booking_pro_service_providers';



?>
<div class="wrap">
  <div class="container db-container">


      <!-- Providers Header Start -->
        <div class="row" style="padding-bottom:40px;height: 100px;s">
          <div class="col-5">
              <h2 class="bp-title">Appoinments</h2>
          </div>
          <div class="col-5">
              <?php
              if (isset($_GET['status']) && $_GET['status'] == 'changed') {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Status updated!</strong>
                        <p>Notification sent to customer</p>
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
      
      <!-- Appoinments List Section Start -->
        <div class="row">
            <table id="customers-table" class="table align-middle mb-0 bg-white">
              <thead class="bg-light">
                <tr>
                  <th>ID</th>
                  <th class="text-center">Full Name</th>
                  <th class="text-center">Phone</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Service</th>
                  <th class="text-center">Provider</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Time</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($bookings as $index => $row): ?>
                  <tr class="customer-row">
                    <td><p><?php echo $index + 1; ?></p></td>

                    <td class="text-center"><p><?php echo esc_html($row['name']); ?></p></td>
                    <td class="text-center"><p><?php echo esc_html($row['phone']);?></p></td>
                    <td class="text-center"><p><?php echo esc_html($row['email']);?></p></td>
                    <td class="text-center">
                      <p>
                        <?php
                          $service_id = $row['service_id'];
                          $service_name = $wpdb->get_results("SELECT service_name FROM $table_services WHERE service_id=$service_id");
                          echo esc_html($service_name[0]->service_name);
                                      
                        ?>
                      </p>
                    </td>
                    <td class="text-center">
                      <p>
                          <?php
                            $provider_id = $row['provider_id'];
                            $provider_name = $wpdb->get_results("SELECT provider_name FROM $table_providers WHERE provider_id=$provider_id");
                            echo esc_html($provider_name[0]->provider_name);
                                        
                          ?>
                        </p>                    
                    </td>
                    <td class="text-center"><p><?php echo esc_html($row['booking_date']);?></p></td>
                    <td class="text-center">
                      <p>
                        <?php 
                          $booking_time = $row['booking_time'];
                          if($booking_time<9){
                            echo esc_html($booking_time).':00 PM - '.esc_html($booking_time+1).':00 PM';
                          }else{
                            echo esc_html($booking_time).':00 AM - '.esc_html($booking_time+1).':00 AM';
                          }
                        
                        
                        ?>
                      </p>
                    </td>
                    <td class="text-center">
                      <?php
                      $status = $row['status'];
                      if($status == 'pending'){
                        echo '<p class="btn btn-warning">'.$status.'</p>';
                      }elseif($status == 'confirmed'){
                        echo '<p class="btn btn-success">'.$status.'</p>';
                      }elseif($status == 'completed'){
                        echo '<p class="btn btn-primary">'.$status.'</p>';
                      }elseif($status == 'canceled'){
                        echo '<p class="btn btn-danger">'.$status.'</p>';
                      }
                      
                      
                      ?>
                    </td>
                    <td class="text-center">
                      <button type="button" class="btn btn-link btn-sm btn-rounded booking-edit-btn" 
                              data-bs-toggle="modal" 
                              data-bs-target="#editbookingModal" 
                              data-id="<?php echo esc_attr($row['booking_id']); ?>"
                              data-email="<?php echo esc_attr($row['email']); ?>">
                              
                        <a class="btn btn-warning btn-sm"><span class="dashicons dashicons-edit"></span></a>
                      </button>
                      <button type="button" class="btn btn-link btn-sm btn-rounded delete-btn" 
                              data-id="<?php echo esc_attr($row['booking_id']); ?>">
                        <a href="<?php echo esc_url(admin_url('admin.php?page=apointments&booking_id=' . $row['booking_id'])); ?>" 
                          class="btn btn-danger btn-sm"><span class="dashicons dashicons-trash"></span></a>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
  
                
              </tbody>
            </table>

        </div>
      <!-- Appoinments List Section End -->   

      <!-- Update Appoinments Section Start -->
              
        <div class="modal" id="editbookingModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Update Appoinmens</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                    <!-- Modal body -->
                      <div class="modal-body">
                        <form method="post" action="">
                          <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-md-10 col-lg-10">
                                  <div class="card shadow-lg p-4 bg-light">

                                    <input type="hidden" name="e_booking_id" id="e_booking_id">
                                    <input type="hidden" name="e_booking_mail" id="e_booking_mail">
                                    
                                    
                                    
                                    <div class="mb-3">
                                      <label for="" class="form-label">Status</label>
                                      <select name="e_booking_status" id="">
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Canceled</option>
                                        
                  
                                      </select>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                      <button type="submit" name="e_submit" class="btn btn-primary">Update Appoinment</button>
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
                const editButtons = document.querySelectorAll('.booking-edit-btn');

                // Loop through each edit button
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                      //console.log(document.getElementById('e_service_id')); // Check if this logs an element or null

                        // Get data attributes from the clicked button
                        const booking_id = this.getAttribute('data-id');
                        const booking_mail = this.getAttribute('data-email');
                        
                        

                        // Populate the form fields with the retrieved data
                        document.getElementById('e_booking_id').value = booking_id;
                        document.getElementById('e_booking_mail').value = booking_mail;
                        
                        
                      
                    });
                });
            });
          </script> 
      
      <!-- Update Appoinments Section End -->


<?php
// Status update section
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['e_submit'])) {
  $e_booking_id = $_POST['e_booking_id'];
  $e_booking_mail = $_POST['e_booking_mail'];
  $e_booking_status = $_POST['e_booking_status'];

  // Fetch the old status before updating
  $old_booking_status = $wpdb->get_var(
      $wpdb->prepare("SELECT status FROM $table_bookings WHERE booking_id = %d", $e_booking_id)
  );

  // Update the status in the database
  $wpdb->update(
      $table_bookings,
      array(
          'status' => $e_booking_status
      ),
      array(
          'booking_id' => $e_booking_id
      )
  );

  // Check if the status has changed
  if ($old_booking_status != $e_booking_status) {
      // Send an email notification
      $to = $e_booking_mail; // Recipient's email
      $subject = 'Booking Status Changed';
      $message = 'The status of your booking has changed from ' . $old_booking_status . ' to ' . $e_booking_status . '.';
      $headers = array('Content-Type: text/html; charset=UTF-8');

      wp_mail($to, $subject, $message, $headers);
  }

  // Redirect to the appointments page after updating
  echo '<script>window.location.href = "' . admin_url('admin.php?page=apointments&status=changed') . '";</script>';
  exit;
}



// Delete Appoinments Section Start

if(isset($_GET['booking_id'])){
  $booking_id = $_GET['booking_id'];


  $wpdb->delete(
      $table_bookings,
      array(
          'booking_id' => $booking_id
      )
  );

  echo '<script>window.location.href = "' . admin_url('admin.php?page=apointments') . '";</script>';
  exit;
}

// Delete Appoinments Section End
















?>      
  </div>
</div>                
