<?php
require_once "db_connect.php";
require_once "utils.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $trip_id = (int) ($_POST['trip_id'] ?? 0);
    $passenger_name = trim($_POST['passenger_name'] ?? '');
    $mobile_no = trim($_POST['mobile_no'] ?? '');
    $seat_no = (int) ($_POST['seat_no'] ?? 0);

    $errors = [];
    if ($trip_id <= 0) $errors[] = "Invalid trip.";
    if ($passenger_name === '') $errors[] = "Name is required.";
    if ($mobile_no === '') $errors[] = "Mobile is required.";
    if ($seat_no <= 0) $errors[] = "Seat is required.";

    if (!$errors) {
        $q = "SELECT booking_id FROM bookings WHERE trip_id = $trip_id AND seat_no = $seat_no LIMIT 1";
        $res = mysqli_query($conn, $q);
        if ($res && mysqli_num_rows($res) > 0) {
            $errors[] = "Seat already booked. Please choose another.";
        } else {
            $ins = sprintf(
                "INSERT INTO bookings (trip_id, passenger_name, mobile_no, seat_no, booked_at) VALUES (%d, '%s', '%s', %d, NOW())",
                $trip_id,
                mysqli_real_escape_string($conn, $passenger_name),
                mysqli_real_escape_string($conn, $mobile_no),
                $seat_no
            );
            if (!mysqli_query($conn, $ins)) {
                $errors[] = "Booking failed. Try again later.";
            }
        }
    }
} else {
    $errors = ["Invalid request."];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirmation</title>
  <link rel="stylesheet" href="styles.css?v=5" />
</head>
<body>
<header>
  <img src="green_university_logo.png" alt="Green University Logo" />
  <h2>Green University - Bus Ticket Booking</h2>
</header>

<div class="container">
  <div class="card">
    <h2>Booking Confirmation</h2>
    <?php if (!empty($errors)): ?>
      <p><?php echo esc(implode(" | ", $errors)); ?></p>
      <p><a class="btn secondary" href="index.php">Back to Home</a></p>
    <?php else: ?>
      <?php
        $trip = null;
        $q2 = "SELECT t.trip_id, r.source, r.destination, t.travel_date, t.travel_time, t.fare, b.bus_name
               FROM trips t
               JOIN routes r ON t.route_id = r.route_id
               JOIN buses b ON t.bus_id = b.bus_id
               WHERE t.trip_id = $trip_id LIMIT 1";
        $r2 = mysqli_query($conn, $q2);
        $trip = $r2 ? mysqli_fetch_assoc($r2) : null;
      ?>
      <?php if ($trip): ?>
        <div class="ticket">
          <ul>
            <li>Passenger: <strong><?php echo esc($passenger_name); ?></strong></li>
            <li>Mobile: <?php echo esc($mobile_no); ?></li>
            <li>Bus: <strong><?php echo esc($trip['bus_name']); ?></strong></li>
            <li>Route: <?php echo esc($trip['source']); ?> → <?php echo esc($trip['destination']); ?></li>
            <li>Date/Time: <?php echo esc($trip['travel_date'] . " " . $trip['travel_time']); ?></li>
            <li>Seat: <?php echo esc($seat_no); ?></li>
            <li>Fare: BDT <?php echo esc($trip['fare']); ?></li>
          </ul>
        </div>
      <?php endif; ?>
      <p style="margin-top:16px;"><a class="btn" href="index.php">Book Another</a></p>
    <?php endif; ?>
  </div>
</div>

<footer><p>&copy; <?php echo date('Y'); ?> Green University Project</p></footer>
</body>
</html>
