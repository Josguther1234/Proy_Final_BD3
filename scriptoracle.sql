
---------------Creacion de Tablas-------------
create table role(
    id_role int primary key,
    name_role nvarchar2(80),
    status char(1)
);

create table users(
    id_user int primary key,
    first_name nvarchar2(80),
    last_name nvarchar2(80),
    username nvarchar2(50),
    password nvarchar2(100),
    email nvarchar2(100),
    phone_number nvarchar2(15),
    id_role int,
    status char(1),
    CONSTRAINT FK_ROLE FOREIGN KEY (id_role) references role(id_role)
);

create table person(
    id_person int primary key,
    dpi nvarchar2(15),
    first_name nvarchar2(100),
    last_name nvarchar2(100),
    birthday date,
    birth_country nvarchar2(80),
    sex char(1),
    marital_status char(1),
    book int,
    page_book int,
    record int,
    id_person_mother int,
    id_person_father int,
    status char(1),
    CONSTRAINT FK_Person_M FOREIGN KEY (id_person_mother) references person(id_person),
    CONSTRAINT FK_Person_F FOREIGN KEY (id_person_father) references person(id_person)
);

create table payment(
    id_payment int primary key,
    dpi nvarchar2(15),
    status char(1)
);

create table certificate(
    id_certificate int primary key,
    id_user int,
    id_person int,
    id_payment int,
    date_hour date,
    CONSTRAINT FK_User FOREIGN KEY (id_user) references users(id_user),
    CONSTRAINT FK_Person FOREIGN KEY (id_person) references person(id_person),
    CONSTRAINT FK_Payment FOREIGN KEY (id_payment) references payment(id_payment)
);


---------------- Creacion de Secuencias para generar el autoincrementable de cada tabla
--------Users---------------
create sequence Auidusers
start with 1 -- se determina que empiece en 1
increment by 1 --se establece el incremento
order;

--Creacion de Trigger-------------
create or replace trigger AutoIdUsers
before insert on users
for each row
begin
    select Auidusers.nextval into :new.id_user from dual;
end;

--------ROLE---------------
create sequence Auid
start with 1 -- se determina que empiece en 1
increment by 1 --se establece el incremento
order;

--Creacion de Trigger-------------
create or replace trigger AutoIdRole
before insert on role
for each row
begin
    select Auid.nextval into :new.id_role from dual;
end;

--------Person---------------
create sequence AuidPerson
start with 1 -- se determina que empiece en 1
increment by 1 --se establece el incremento
order;
--Creacion de Trigger-------------
create or replace trigger AutoIdPerson
before insert on PERSON
for each row
begin
    select AuidPerson.nextval into :new.ID_PERSON from dual;
end;

--------Payment---------------
create sequence AuidPayment
start with 1 -- se determina que empiece en 1
increment by 1 --se establece el incremento
order;
--Creacion de Trigger-------------
create or replace trigger AutoIdPayment
before insert on PAYMENT
for each row
begin
    select AuidPayment.nextval into :new.ID_PAYMENT from dual;
end;

--------Certificate---------------
create sequence AuidCertificate
start with 1 -- se determina que empiece en 1
increment by 1 --se establece el incremento
order;
--Creacion de Trigger-------------
create or replace trigger AutoIdCedrtificate
before insert on CERTIFICATE
for each row
begin
    select AuidPayment.nextval into :new.ID_CERTIFICATE from dual;
end;