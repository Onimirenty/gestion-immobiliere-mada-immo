CREATE TABLE comparaison(
    id_comparaison SERIAL PRIMARY KEY,
    min DECIMAL(10,2),
    max DECIMAL(10,2)
);

insert into comparaison(min,max) values (1000,1000000) ;

update comparaison set min=3000000.00 ,max=4000000.00;
update comparaison set min=1000000.00 ,max=2000000.00;
update comparaison set min=1000000.00 ,max=1890000.00;

update comparaison set min=1889999.00 ,max=1890002.00;
update comparaison set min=1890001.00 ,max=1890002.00;
