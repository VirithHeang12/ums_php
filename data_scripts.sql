-- Insert into roles
INSERT INTO roles (role_name) VALUES ('Admin');
INSERT INTO roles (role_name) VALUES ('Professor');
INSERT INTO roles (role_name) VALUES ('Student');

-- Insert into professors
INSERT INTO professors (dept_code, prof_specialty, prof_rank, prof_lname, prof_fname, prof_initial, prof_email) VALUES
(1, 'Computer Science', 1, 'Chan', 'Sokha', 'S', 'sokha.chan@example.com');

INSERT INTO professors (dept_code, prof_specialty, prof_rank, prof_lname, prof_fname, prof_initial, prof_email) VALUES
(2, 'Mathematics', 2, 'Sok', 'Rath', 'R', 'rath.sok@example.com');

INSERT INTO professors (dept_code, prof_specialty, prof_rank, prof_lname, prof_fname, prof_initial, prof_email) VALUES
(1, 'Physics', 3, 'Vann', 'Sovann', 'V', 'sovann.vann@example.com');

-- Insert into schools
INSERT INTO schools (school_name, prof_num) VALUES
('Royal University of Phnom Penh', 1);

INSERT INTO schools (school_name, prof_num) VALUES
('Cambodia University', 2);

-- Insert into departments
INSERT INTO departments (dept_name, school_code, prof_num) VALUES
('Department of Computer Science', 1, 1);

INSERT INTO departments (dept_name, school_code, prof_num) VALUES
('Department of Mathematics', 2, 2);

-- Insert into semesters
INSERT INTO semesters (semester_year, semester_term, semester_start_date, semester_end_date) VALUES
(2024, 1, TO_DATE('2024-01-10', 'YYYY-MM-DD'), TO_DATE('2024-05-30', 'YYYY-MM-DD'));

INSERT INTO semesters (semester_year, semester_term, semester_start_date, semester_end_date) VALUES
(2024, 2, TO_DATE('2024-08-10', 'YYYY-MM-DD'), TO_DATE('2024-12-20', 'YYYY-MM-DD'));

-- Insert into courses
INSERT INTO courses (dept_code, crs_title, crs_description, crs_credit) VALUES
(1, 'Introduction to Programming', 'Basics of programming with Python', 3);

INSERT INTO courses (dept_code, crs_title, crs_description, crs_credit) VALUES
(2, 'Calculus I', 'Fundamentals of calculus', 4);

-- Insert into students
INSERT INTO students (dept_code, stu_lname, stu_fname, stu_initial, stu_email, prof_num) VALUES
(1, 'Phan', 'Sopheap', 'P', 'sopheap.phan@example.com', 1);

INSERT INTO students (dept_code, stu_lname, stu_fname, stu_initial, stu_email, prof_num) VALUES
(2, 'Heng', 'Srey', 'H', 'srey.heng@example.com', 2);

-- Insert into buildings
INSERT INTO buildings (bldg_name, blng_location) VALUES
('Science Building', '123 University Ave, Phnom Penh');

INSERT INTO buildings (bldg_name, blng_location) VALUES
('Mathematics Building', '456 College St, Phnom Penh');

-- Insert into rooms
INSERT INTO rooms (room_type, bldg_code) VALUES
('Lecture Hall', 1);

INSERT INTO rooms (room_type, bldg_code) VALUES
('Classroom', 2);

-- Insert into classes
INSERT INTO classes (class_section, class_time, crs_code, prof_num, room_code, semester_code) VALUES
(101, '08:00-09:30', 1, 1, 1, 1);

INSERT INTO classes (class_section, class_time, crs_code, prof_num, room_code, semester_code) VALUES
(102, '10:00-11:30', 2, 2, 2, 2);

-- Insert into enrolls
INSERT INTO enrolls (class_code, stu_num, enroll_date, enroll_grade) VALUES
(1, 1, TO_DATE('2024-01-15', 'YYYY-MM-DD'), 'A');

INSERT INTO enrolls (class_code, stu_num, enroll_date, enroll_grade) VALUES
(2, 2, TO_DATE('2024-08-15', 'YYYY-MM-DD'), 'B');

-- Insert into users
INSERT INTO users (username, password, entity_type, entity_id, role_id) VALUES
('admin_user', 'admin_pass', 'Admin', 1, 1);

INSERT INTO users (username, password, entity_type, entity_id, role_id) VALUES
('professor_user', 'prof_pass', 'Professor', 1, 2);

INSERT INTO users (username, password, entity_type, entity_id, role_id) VALUES
('student_user', 'stu_pass', 'Student', 1, 3);





