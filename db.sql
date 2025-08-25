-- Database: bus_ticket_booking (utf8mb4)
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS trips;
DROP TABLE IF EXISTS buses;
DROP TABLE IF EXISTS routes;

CREATE TABLE routes (
  route_id INT AUTO_INCREMENT PRIMARY KEY,
  source VARCHAR(100) NOT NULL,
  destination VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE buses (
  bus_id INT AUTO_INCREMENT PRIMARY KEY,
  bus_name VARCHAR(100) NOT NULL,
  capacity INT NOT NULL DEFAULT 40
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE trips (
  trip_id INT AUTO_INCREMENT PRIMARY KEY,
  route_id INT NOT NULL,
  bus_id INT NOT NULL,
  travel_date DATE NOT NULL,
  travel_time TIME NOT NULL,
  fare DECIMAL(10,2) NOT NULL,
  CONSTRAINT fk_trips_route FOREIGN KEY (route_id) REFERENCES routes(route_id) ON DELETE CASCADE,
  CONSTRAINT fk_trips_bus FOREIGN KEY (bus_id) REFERENCES buses(bus_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bookings (
  booking_id INT AUTO_INCREMENT PRIMARY KEY,
  trip_id INT NOT NULL,
  passenger_name VARCHAR(150) NOT NULL,
  mobile_no VARCHAR(20) NOT NULL,
  seat_no INT NOT NULL,
  booked_at DATETIME NOT NULL,
  UNIQUE KEY uniq_trip_seat (trip_id, seat_no),
  CONSTRAINT fk_bookings_trip FOREIGN KEY (trip_id) REFERENCES trips(trip_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO routes (source, destination) VALUES
  ('Dhaka', 'Chattogram'),
  ('Dhaka', 'Sylhet'),
  ('Dhaka', 'Rajshahi'),
  ('Chattogram', 'Dhaka');

INSERT INTO buses (bus_name, capacity) VALUES
  ('Green Line Paribahan', 40),
  ('Hanif Enterprise', 36),
  ('Shyamoli NR Travels', 38),
  ('Desh Travels', 40),
  ('S.Alam Service', 36);

INSERT INTO trips (route_id, bus_id, travel_date, travel_time, fare) VALUES
  (1, 1, CURDATE(), '08:30:00', 1200.00),
  (1, 2, CURDATE(), '13:00:00', 1100.00),
  (2, 3, CURDATE(), '18:45:00', 1000.00),
  (4, 1, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:00:00', 1200.00);
