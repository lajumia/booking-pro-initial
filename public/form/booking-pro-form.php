<?php


// Process the form data (you can save to the database here or send an email)
global $wpdb;


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_appoinment'])) {
    // Sanitize form inputs
    $user_name = sanitize_text_field($_POST['user_name'] ?? '');
    $user_phone = sanitize_text_field($_POST['user_phone'] ?? '');
    $user_email = sanitize_email($_POST['user_email'] ?? '');
    $service = sanitize_text_field($_POST['service'] ?? '');
    $provider = sanitize_text_field($_POST['provider'] ?? '');
    $date = sanitize_text_field($_POST['date'] ?? '');
    $time = sanitize_text_field($_POST['time'] ?? '');



    // Example: Insert the data into a custom table (replace with your table)
    $table_name = $wpdb->prefix . 'booking_pro_bookings';
    $result = $wpdb->insert(
        $table_name,
        array(
            'name' => $user_name,
            'phone' => $user_phone,
            'email' => $user_email,
            'service_id' => $service,
            'provider_id' => $provider,
            'booking_date' => $date,
            'booking_time' => $time,
        ),
        array('%s', '%s', '%s', '%d', '%d', '%s', '%s')
    );

    // Redirect or show a success message
      if (false === $result) {
        wp_die('Database update failed: ' . $wpdb->last_error);
      }else{
        echo '<script>window.location.href = "'.home_url('/booking-pro-thank-you').'";</script>';

      }
}
?>


<section class="" style="background:#2779e2;">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Appoinment Form</h3>
            <form action="" method="post">

              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Full Name</label>
                  <input type="text" name="user_name" placeholder="ex: Md Laju Miah" id="">
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Phone No</label>
                  <input type="number" name="user_phone" placeholder="Include country code" id="">
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Email</label>
                  <input type="email" name="user_email" placeholder="example@gmail.com" id="">
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Services</label>
                  <select name="service" class="select form-control-lg">
                    <option value="" disabled>Choose Service</option>
                    <?php
                      // Define your table name (using the WordPress prefix)
                      $table_service = $wpdb->prefix . 'booking_pro_services';

                      // Fetch the service_id and service_name from the table
                      $services = $wpdb->get_results( "SELECT service_id, service_name FROM $table_service" );

                      // Check if there are results and display them
                      if ( !empty($services) ) {
                          foreach ( $services as $row ) {
                              echo '<option value="'.esc_html( $row->service_id ).'">' . esc_html( $row->service_name ) . '</option>';
                          }
                      } else {
                          echo '<option disabled>No services found.</option>';
                      }
                    ?>

                    
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Providers</label>
                  <select name="provider" class="select form-control-lg">
                    <option  value="" disabled>Choose Providers</option>
                    <?php 
                    
                    // Define your table name (using the WordPress prefix)
                    $table_provider = $wpdb->prefix . 'booking_pro_service_providers';
                    
                    // Fetch the provider_name from the table
                    $providers = $wpdb->get_results( "SELECT provider_id, provider_name FROM $table_provider" );
                    
                    // Check if there are results and display them
                    if ( !empty($providers) ) {
                        foreach ( $providers as $row ) {
                            echo '<option value="'.esc_html( $row->provider_id ).'">' . esc_html( $row->provider_name ) . '</option>';
                        }
                    } else {
                        echo 'No provider found.';
                    }
                    

                    ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Date</label>
                  <input name="date" type="date" name="" id="">
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                <label class="form-label select-label">Available Time</label>
                  <select name="time" class="select form-control-lg">
                    <option value="" disabled>Choose Time</option>
                    <option value="9">9am-10am</option>
                    <option value="10">10am-11am</option>
                    <option value="11">11am-12pm</option>
                    <option value="12">12pm-1pm</option>
                    <option value="1">1pm-2pm</option>
                    <option value="2">2pm-3pm</option>
                    <option value="3">3pm-4pm</option>
                    <option value="4">4pm-5pm</option>
                    <option value="5">5pm-6pm</option>
                    <option value="6">6pm-7pm</option>
                    <option value="7">7pm-8pm</option>
                    <option value="8">8pm-9pm</option>

                  </select>
                </div>
              </div>
              
              <div class="mt-4 pt-2">
                <input type="hidden" name="action" value="submit_appoinment_data" />
                <button class="btn btn-primary" name="submit_appoinment">Book Appoinment</button>
                
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>