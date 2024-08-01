create database db_store;

use db_store;

-- CasIdy :Identidade
create table CasIdy (
	CasIdyCod character(36) not null,
	CasIdyDca datetime default now() not null,
	CasIdyDsc character(60) not null,
	CasIdyBlq char(1) default 'N' not null,
	CasIdyChv character(36) not null,
	CasIdyUpt datetime default now() not null,
	constraint PKCasIdy primary key (CasIdyCod),
	index ICasIdy01 (CasIdyBlq asc, CasIdyDsc asc),
	unique index ICasIdy02 (CasIdyChv asc)
);

-- Insert the first record
insert into CasIdy (CasIdyCod, CasIdyDca, CasIdyDsc, CasIdyBlq, CasIdyChv, CasIdyUpt) 
values('50f2e580-bd30-11ea-877c-fc4596f8a36d', now(), 'Access Store', 'N', '5f09c2260e8eb', now());

