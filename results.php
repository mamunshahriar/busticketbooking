<?php
require_once "db_connect.php";
require_once "utils.php";

$source = get('source');
$destination = get('destination');
$date = get('date');
$bus = get('bus');
$passengers = (int) get('passengers', 1);

$err = [];
if ($source === '') $err[] = "Source is required";
if ($destination === '') $err[] = "Destination is required";
if ($date === '') $err[] = "Date is required";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Available Trips</title>
  <link rel="stylesheet" href="styles.css?v=5" />
</head>
<body>
<header>
  <img src="green_university_logo.png" alt="Green University Logo" />
  <h2>Green University - Bus Ticket Booking</h2>
</header>

<div class="container">
  <div class="card">
    <h2>Available Trips</h2>
    <p>From <strong><?php echo esc($source); ?></strong> to <strong><?php echo esc($destination); ?></strong> on <strong><?php echo esc($date); ?></strong>
    <?php if ($bus) echo " | Bus: <strong>" . esc($bus) . "</strong>"; ?></p>
    <p><a class="btn secondary" href="index.php">← Modify Search</a></p>
    <?php if ($err): ?>
      <p><?php echo esc(implode(", ", $err)); ?></p>
    <?php else: ?>
      <?php
        $source_esc = mysqli_real_escape_string($conn, $source);
        $destination_esc = mysqli_real_escape_string($conn, $destination);
        $date_esc = mysqli_real_escape_string($conn, $date);
        $bus_filter = "";
        if ($bus !== "") {
          $bus_filter = " AND b.bus_name = '" . mysqli_real_escape_string($conn, $bus) . "' ";
        }
        $sql = "
          SELECT t.trip_id, r.source, r.destination, t.travel_date, t.travel_time, t.fare,
                 b.bus_name, b.capacity
          FROM trips t
          JOIN routes r ON t.route_id = r.route_id
          JOIN buses b ON t.bus_id = b.bus_id
          WHERE r.source = '$source_esc'
            AND r.destination = '$destination_esc'
            AND t.travel_date = '$date_esc'
            $bus_filter
          ORDER BY t.travel_time ASC
        ";
        $res = mysqli_query($conn, $sql);
      ?>
      <?php if (!$res || mysqli_num_rows($res) === 0): ?>
        <p>No trips found. Try a different date or route.</p>
      <?php else: ?>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Bus</th>
                <th>Time</th>
                <th>Fare (BDT)</th>
                <th>Capacity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($res)): ?>
              <tr>
                <td><?php echo esc($row['bus_name']); ?></td>
                <td><?php echo esc($row['travel_time']); ?></td>
                <td><?php echo esc($row['fare']); ?></td>
                <td><?php echo esc($row['capacity']); ?></td>
                <td>
                  <form action="booking.php" method="get">
                    <input type="hidden" name="trip_id" value="<?php echo esc($row['trip_id']); ?>" />
                    <input type="hidden" name="passengers" value="<?php echo esc($passengers); ?>" />
                    <button class="btn" type="submit">Book</button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<footer><p>&copy; <?php echo date('Y'); ?> Green University Project</p></footer>
</body>
</html>
