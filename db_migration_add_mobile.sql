-- Use this if you already created the DB earlier without mobile_no
ALTER TABLE bookings ADD COLUMN mobile_no VARCHAR(20) NOT NULL AFTER passenger_name;
