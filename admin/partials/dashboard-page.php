<?php 
global $wpdb;

$table_bookings = $wpdb->prefix . 'booking_pro_bookings';


// Fetch the total number of appointments
$total_bookings = $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings");
// Fetch the confirmed booking from the database
$confirmed_bookings = $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings WHERE status = 'confirmed'");
// Fetch the pending booking from the database
$pending_bookings = $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings WHERE status = 'pending'");
// Fetch the cancelled booking from the database
$cancelled_bookings = $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings WHERE status = 'canceled'");
// Fetch the rejected booking from the database
$completed_bookings = $wpdb->get_var("SELECT COUNT(*) FROM $table_bookings WHERE status = 'completed'");

// Fetch the total customers from the database
$total_customers = $wpdb->get_var("SELECT COUNT(DISTINCT email) FROM $table_bookings");







?>


<div class="wrap">
        <div class="container db-container">
                <div class="row"><h2 class="bp-title">Dashboard</h2></div>
                <div class="row">                      
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-dark text-center card-number"><?php echo $total_bookings; ?></h3>
                                                <p class="bp-text text-center card-text">Total Appointment</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-center card-number" style="color:rgb(13 110 253);"><?php echo $confirmed_bookings; ?></h3>
                                                <p class="bp-text text-center card-text">Approved Appointment</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-center card-number" style="color:#f5ae41;"><?php echo $pending_bookings; ?></h3>
                                                <p class="bp-text text-center card-text">Pending Appointment</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-center card-number" style="color:#12D48B;"><?php echo $completed_bookings; ?></h3>
                                                <p class="bp-text text-center card-text">Completed Appointment</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-center card-number" style="color:rgb(220 53 69);"><?php echo $cancelled_bookings; ?></h3>
                                                <p class="bp-text text-center card-text">Canclled Appointment</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-center card-number" style="color:#2167f1;">$0.00</h3>
                                                <p class="bp-text text-center card-text">Revenue</p>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="card bp-card fw-bold">
                                        <div class="card-body">
                                                <h3 class="bp-h text-center card-number" style="color:#d436c4;"> 
                                                        <?php echo $total_customers;?>
                                                </h3>
                                                <p class="bp-text text-center card-text">Total Customers</p>
                                        </div>
                                </div>
                        </div>
                        
                        
                       
                        
                        
                       
                </div>
        </div>
</div>