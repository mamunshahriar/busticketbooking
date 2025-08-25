<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bus Ticket Booking</title>
  <link rel="stylesheet" href="styles.css?v=5" />
</head>
<body>
<header>
  <img src="green_university_logo.png" alt="Green University Logo" />
  <h2>Green University - Bus Ticket Booking</h2>
</header>

<div class="container">
  <div class="card">
    <h1>🚌 Book Your Trip</h1>
    <form action="results.php" method="get">
      <label for="source">From</label>
      <input list="locations" id="source" name="source" placeholder="Choose departure city" required>

      <label for="destination">To</label>
      <input list="locations" id="destination" name="destination" placeholder="Choose destination city" required>
      <datalist id="locations">
        <option value="Dhaka">
        <option value="Chattogram">
        <option value="Sylhet">
        <option value="Rajshahi">
        <option value="Khulna">
      </datalist>

      <label for="bus">Bus Company</label>
      <select id="bus" name="bus">
        <option value="">Any</option>
        <option>Hanif Enterprise</option>
        <option>Green Line Paribahan</option>
        <option>Shyamoli NR Travels</option>
        <option>Desh Travels</option>
        <option>S.Alam Service</option>
      </select>

      <label for="date">Date</label>
      <input type="date" id="date" name="date" required>

      <label for="passengers">Passengers</label>
      <input type="number" id="passengers" name="passengers" min="1" max="10" value="1">

      <button class="btn" type="submit">Search Trips</button>
    </form>
  </div>

  
<div class="team-box">
  <h3>Our Team</h3>
  <div class="team-grid">
    <div class="team-card"><strong>Md. Mamun Shahriar (Leader)</strong><span>ID: 232002008</span></div>
    <div class="team-card"><strong>Akhi Akter</strong><span>ID: 232002031</span></div>
    <div class="team-card"><strong>Sanjida Salam Joyonti</strong><span>ID: 232002215</span></div>
    <div class="team-card"><strong>Rokaiya Hossen Deya</strong><span>ID: 232002094</span></div>
    <div class="team-card"><strong>Habiba Akter</strong><span>ID: 232002268</span></div>
    <div class="team-card"><strong>Meherin Afrin Muna</strong><span>ID: 232002149</span></div>
    <div class="team-card"><strong>Jannatul Mawa Sriti</strong><span>ID: 232002070</span></div>
    <div class="team-card"><strong>Nazmonnshar</strong><span>ID: 223002001</span></div>
  </div>
</div>

</div>

<footer><p>&copy; 2025 Green University Project</p></footer>
</body>
</html>
