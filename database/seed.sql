-- ---------------------------------------------------------------------------
-- Attendance System - optional demo data
--
-- Import after schema.sql. Every demo teacher and student uses the password
-- "password123". Attendance is generated for the last two weeks (Sundays and
-- today are skipped, so you can try taking today's attendance yourself).
-- ---------------------------------------------------------------------------

USE `attendance`;

INSERT INTO `teacher` (`first_name`, `last_name`, `email`, `password`) VALUES
    ('Anita', 'Mehta', 'teacher@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Rohan', 'Shah',  'rohan.shah@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK');

INSERT INTO `student` (`first_name`, `last_name`, `email`, `password`) VALUES
    ('Aarav',  'Patel',   'student@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Diya',   'Desai',   'diya.desai@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Kabir',  'Joshi',   'kabir.joshi@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Meera',  'Trivedi', 'meera.trivedi@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Vivaan', 'Bhatt',   'vivaan.bhatt@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Isha',   'Parmar',  'isha.parmar@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Arjun',  'Solanki', 'arjun.solanki@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK'),
    ('Riya',   'Chauhan', 'riya.chauhan@example.com', '$2y$10$pXzDLBxVRll2qFOUNygSEuB3yVupqU7qDVOd/5kSROooh4HVuEYDK');

-- Deterministic "random" attendance for the previous 14 days, roughly 80% present.
INSERT INTO `attendance` (`student_id`, `attendance_date`, `is_present`)
SELECT s.id,
       CURDATE() - INTERVAL d.n DAY,
       IF((s.id * 7 + d.n * 3) % 5 = 0, 0, 1)
FROM `student` s
CROSS JOIN (
    SELECT 1 AS n UNION ALL SELECT 2  UNION ALL SELECT 3  UNION ALL SELECT 4
    UNION ALL SELECT 5  UNION ALL SELECT 6  UNION ALL SELECT 7  UNION ALL SELECT 8
    UNION ALL SELECT 9  UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
    UNION ALL SELECT 13 UNION ALL SELECT 14
) d
WHERE DAYOFWEEK(CURDATE() - INTERVAL d.n DAY) <> 1;

INSERT INTO `feedback` (`name`, `email`, `phone`, `message`) VALUES
    ('Parent of Aarav', 'parent@example.com', '+91 98765 43210', 'The attendance dashboard is very easy to follow. Thank you!');
