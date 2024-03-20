create table if not exists courses
(
    id     bigint unsigned auto_increment
        primary key,
    name   varchar(64)                not null,
    weight decimal(5, 2) default 1.00 not null
);

create table if not exists students
(
    id             bigint unsigned auto_increment
        primary key,
    name           varchar(64)  not null,
    surname        varchar(64)  not null,
    student_number int unsigned not null,
    constraint students_student_number_uindex
        unique (student_number)
);

create table if not exists terms
(
    id   bigint unsigned auto_increment
        primary key,
    name varchar(64) not null
);

create table if not exists grades
(
    id         bigint unsigned auto_increment
        primary key,
    student_id bigint unsigned not null,
    term_id    bigint unsigned not null,
    grade      int unsigned    not null,
    course_id  bigint unsigned null,
    constraint grades_courses_id_fk
        foreign key (course_id) references courses (id)
            on update cascade on delete cascade,
    constraint grades_students_id_fk
        foreign key (student_id) references students (id)
            on update cascade on delete cascade,
    constraint grades_terms_id_fk
        foreign key (term_id) references terms (id)
            on update cascade on delete cascade
);

create index grades_student_id_index
    on grades (student_id);

create index grades_term_id_index
    on grades (term_id);

create table if not exists users
(
    id       bigint unsigned auto_increment
        primary key,
    name     varchar(64)  not null,
    surname  varchar(64)  not null,
    email    varchar(128) not null,
    password varchar(128) not null,
    constraint users_email_uindex
        unique (email)
);

