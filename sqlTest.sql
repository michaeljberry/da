SELECT COUNT(sc.id) as total_number_of_students
FROM student_classes sc
INNER JOIN classes c ON c.id = sc.class
WHERE c.id = 1

SELECT s.first_name, s.last_name
FROM students s
INNER JOIN student_classes sc ON sc.student = s.id
INNER JOIN classes c ON c.id = sc.class
WHERE c.id = 3

SELECT c.class_name, c.id
FROM classes c
INNER JOIN student_classes sc ON sc.class = c.id
INNER JOIN students s ON s.id = sc.student
-- WHERE s.id = 49
WHERE s.first_name = 'Kyle' AND s.last_name = 'Randall';