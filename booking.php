<?php
require_once "db_connect.php";
require_once "utils.php";

$trip_id = (int) get('trip_id');
$passengers = max(1, (int) get('passengers', 1));

$trip = null;
if ($trip_id > 0) {
  $q = "SELECT t.trip_id, r.source, r.destination, t.travel_date, t.travel_time, t.fare, b.bus_name, b.capacity
        FROM trips t
        JOIN routes r ON t.route_id = r.route_id
        JOIN buses b ON t.bus_id = b.bus_id
        WHERE t.trip_id = $trip_id
        LIMIT 1";
  $tripRes = mysqli_query($conn, $q);
  $trip = $tripRes ? mysqli_fetch_assoc($tripRes) : null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking</title>
  <link rel="stylesheet" href="styles.css?v=5" />
</head>
<body>
<header>
  <img src="green_university_logo.png" alt="Green University Logo" />
  <h2>Green University - Bus Ticket Booking</h2>
</header>

<div class="container">
  <div class="card">
    <h2>Booking</h2>
    <?php if (!$trip): ?>
      <p>Invalid trip.</p>
      <p><a class="btn secondary" href="index.php">Back</a></p>
    <?php else: ?>
      <p>
        <strong><?php echo esc($trip['bus_name']); ?></strong> —
        <?php echo esc($trip['source']); ?> → <?php echo esc($trip['destination']); ?>,
        <?php echo esc($trip['travel_date']); ?> at <?php echo esc($trip['travel_time']); ?>,
        Fare: BDT <?php echo esc($trip['fare']); ?>
      </p>

      <form action="confirm.php" method="post">
        <input type="hidden" name="trip_id" value="<?php echo esc($trip['trip_id']); ?>" />
        <div class="row">
          <div>
            <label for="passenger_name">Passenger Name</label>
            <input type="text" id="passenger_name" name="passenger_name" placeholder="Your full name" required />
          </div>
          <div>
            <label for="mobile_no">Mobile Number</label>
            <input type="tel" id="mobile_no" name="mobile_no" placeholder="e.g. 017XXXXXXXX" required />
          </div>
        </div>
        <div>
          <label for="seat_no">Seat No</label>
          <input type="number" id="seat_no" name="seat_no" min="1" max="<?php echo esc($trip['capacity']); ?>" required />
        </div>
        <button class="btn" type="submit" name="submit">Confirm Booking</button>
      </form>
    <?php endif; ?>
  </div>
</div>

<footer><p>&copy; <?php echo date('Y'); ?> Green University Project</p></footer>
</body>
</html>
