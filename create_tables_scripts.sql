create table professors
(
    prof_num int generated always as identity,
    dept_code int not null,
    prof_specialty varchar2(50) not null,
    prof_rank int not null,
    prof_lname varchar2(50) not null,
    prof_fname varchar2(50) not null,
    prof_initial varchar2(50),
    prof_email varchar2(100) not null,
    constraint pk_professors primary key(prof_num)
);

create table schools
(
    school_code int generated always as identity,
    school_name varchar(100) not null,
    prof_num int not null,
    constraint pk_schools primary key(school_code)
);

create table departments
(
    dept_code int generated always as identity,
    dept_name varchar2(100) not null,
    school_code int not null,
    prof_num int not null,
    constraint pk_departments primary key(dept_code)
);

create table courses(
    crs_code int generated always as identity,
    dept_code int not null,
    crs_title VARCHAR2(100) not null,
    crs_description VARCHAR2(100) not null,
    crs_credit int not null,
    constraint pk_courses primary key(crs_code)
);

create table students
(
    stu_num int generated always as identity,
    dept_code int,
    stu_lname varchar2(50) not null,
    stu_fname varchar2(50) not null,
    stu_initial varchar2(50) not null,
    stu_email varchar2(100),
    prof_num int not null,
    constraint pk_students primary key (stu_num)
);

create table classes
(
    class_code int generated always as identity,
    class_section int not null,
    class_time varchar2(50) not null,
    crs_code int not null,
    prof_num int not null,
    room_code int not null,
    semester_code int not null,
    constraint pk_classes primary key(class_code)
);

create table buildings
(
    bldg_code int generated always as identity,
    bldg_name varchar2(100) not null,
    blng_location varchar2(255) not null,
    constraint pk_buildings primary key(bldg_code)
);

create table rooms
(
    room_code int generated always as identity,
    room_type varchar2(50) not null,
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
    role_id int generated always as identity,
    role_name varchar2(50) not null,
    constraint pk_roles primary key(role_id)
);

create table users
(
    user_id int generated always as identity,
    username varchar2(50) not null,
    password varchar2(255) not null,
    entity_type varchar2(100) not null,
    entity_id int not null,
    role_id int not null,
    constraint uk_entity_type_entity_id unique(entity_type, entity_id)
);

