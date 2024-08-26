alter table CLASSES
    add constraint FK_CLASSES_COURSES
        foreign key (CRS_CODE) references COURSES
/

alter table CLASSES
    add constraint FK_CLASSES_PROFESSORS
        foreign key (PROF_NUM) references PROFESSORS
/

alter table CLASSES
    add constraint FK_CLASSES_ROOMS
        foreign key (ROOM_CODE) references ROOMS
/

alter table CLASSES
    add constraint FK_CLASSES_SEMESTERS
        foreign key (SEMESTER_CODE) references SEMESTERS
/

alter table COURSES
    add constraint FK_COURSES_DEPARTMENTS
        foreign key (DEPT_CODE) references DEPARTMENTS
/

alter table DEPARTMENTS
    add constraint FK_DEPARTMENTS_PROFESSORS
        foreign key (PROF_NUM) references PROFESSORS
/

alter table DEPARTMENTS
    add constraint FK_DEPARTMENTS_SCHOOLS
        foreign key (SCHOOL_CODE) references SCHOOLS
/

alter table ENROLLS
    add constraint FK_ENROLLS_CLASSES
        foreign key (CLASS_CODE) references CLASSES
/

alter table ENROLLS
    add constraint FK_ENROLLS_STUDENTS
        foreign key (STU_NUM) references STUDENTS
/

alter table PROFESSORS
    add constraint FK_PROFESSORS_DEPARTMENTS
        foreign key (DEPT_CODE) references DEPARTMENTS
/

alter table ROOMS
    add constraint FK_ROOMS_BUILDINGS
        foreign key (BLDG_CODE) references BUILDINGS
/

alter table SCHOOLS
    add constraint FK_SCHOOLS_PROFESSORS
        foreign key (PROF_NUM) references PROFESSORS
/

alter table STUDENTS
    add constraint FK_STUDENTS_PROFESSORS
        foreign key (PROF_NUM) references PROFESSORS
/

alter table USERS
    add constraint FK_USERS_ROLES
        foreign key (ROLE_ID) references ROLES
/





