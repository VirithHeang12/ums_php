create table professors
(
    prof_num int auto_increment,
    dept_code int not null,
    prof_specialty varchar(50) not null,
    prof_rank int not null,
    prof_lname varchar(50) not null,
    prof_fname varchar(50) not null,
    prof_initial varchar(50),
    prof_email varchar(100) not null,
    constraint pk_professors primary key(prof_num)
);

create table schools
(
    school_code int auto_increment,
    school_name varchar(100) not null,
    prof_num int not null,
    constraint pk_schools primary key(school_code)
);

create table departments
(
    dept_code int auto_increment,
    dept_name varchar(100) not null,
    school_code int not null,
    prof_num int not null,
    constraint pk_departments primary key(dept_code)
);

create table courses(
    crs_code int auto_increment,
    dept_code int not null,
    crs_title varchar(100) not null,
    crs_description varchar(100) not null,
    crs_credit int not null,
    constraint pk_courses primary key(crs_code)
);

create table students
(
    stu_num int auto_increment,
    dept_code int,
    stu_lname varchar(50) not null,
    stu_fname varchar(50) not null,
    stu_initial varchar(50) not null,
    stu_email varchar(100),
    prof_num int not null,
    constraint pk_students primary key (stu_num)
);

create table classes
(
    class_code int auto_increment,
    class_section int not null,
    class_time varchar(50) not null,
    crs_code int not null,
    prof_num int not null,
    room_code int not null,
    semester_code int not null,
    constraint pk_classes primary key(class_code)
);

create table buildings
(
    bldg_code int auto_increment,
    bldg_name varchar(100) not null,
    blng_location varchar(255) not null,
    constraint pk_buildings primary key(bldg_code)
);

create table rooms
(
    room_code int auto_increment,
    room_type varchar(50) not null,
    bldg_code int not null,
    constraint pk_rooms primary key (room_code)
);

create table enrolls(
    class_code int not null,
    stu_num int not null,
    enroll_date date not null,
    enroll_grade char(1),
    constraint pk_enrolls primary key (class_code, stu_num)
);

create table roles
(
    role_id int auto_increment,
    role_name varchar(50) not null,
    constraint pk_roles primary key(role_id)
);

create table users
(
    user_id int auto_increment,
    username varchar(50) not null,
    password varchar(255) not null,
    entity_type varchar(100) not null,
    entity_id int not null,
    role_id int not null,
    constraint pk_users primary key (user_id),
    constraint uk_entity_type_entity_id unique(entity_type, entity_id)
);

create table semesters
(
    semester_code int auto_increment,
    semester_year int not null,
    semester_term int not null,
    semester_start_date date not null,
    semester_end_date date not null,
    constraint pk_semesters primary key(semester_code)
);

create table medias
(
    media_id int auto_increment,
    media_type varchar(50) not null,
    media_url varchar(255) not null,
    entity_type varchar(100) not null,
    entity_id int not null,
    constraint pk_medias primary key(media_id)
);
