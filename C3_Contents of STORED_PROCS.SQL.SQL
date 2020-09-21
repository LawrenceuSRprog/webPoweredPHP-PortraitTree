
### CODE WRITTEN: {RESTART in 4 parts} 

delimiter //
CREATE PROCEDURE cntrRESTART()
    BEGIN
       DELETE FROM carry_spread;
       INSERT INTO carry_spread(subject, colAs_Orig, row_id, 
                 colAs_Num, parent)
       SELECT * from basic
       ;
       DELETE FROM carry_back;
       INSERT INTO carry_back(subject, colAs_Orig, row_id, 
                 colAs_Num, parent)
       SELECT * from basic
       ;
       DELETE FROM move_horizon;
       INSERT into move_horizon(row_stays)
       SELECT distinct row_id from basic
       ;
       DELETE FROM move_backon;
       INSERT into move_backon(row_stays)
       SELECT distinct row_id from basic
       ;
    END//
delimiter ;


CREATE TABLE basic(
    subject     CHAR(25) PRIMARY KEY,
    col_Letter  CHAR(2),
    row_id      INT,
    colAs_Num   INT,
    parent      CHAR(25)
);

======< Macro: SIMULATED_StartHere >=====
DELETE from basic;
INSERT INTO basic VALUES('WHOLE-THING','A',1,1,'ITSELF');
INSERT INTO basic VALUES('UpBody','A',2,1,'WHOLE-THING');
INSERT INTO basic VALUES('Head','B',2,2,'WHOLE-THING');
INSERT INTO basic VALUES('MidBody','C',2,3,'WHOLE-THING');
INSERT INTO basic VALUES('RightArm','A',3,1,'UpBody');
INSERT INTO basic VALUES('LeftArm','B',3,2,'UpBody');
INSERT INTO basic VALUES('Chest','C',3,3,'UpBody');
INSERT INTO basic VALUES('Face','E',3,5,'Head');
INSERT INTO basic VALUES('Ears','F',3,6,'Head');
INSERT INTO basic VALUES('RestOfHead','G',3,7,'Head');
INSERT INTO basic VALUES('Center','I',3,9,'MidBody');
INSERT INTO basic VALUES('LeftLeg','K',3,11,'LowBody');
INSERT INTO basic VALUES('RightLeg','L',3,12,'LowBody');
INSERT INTO basic VALUES('Nose','A',4,1,'Face');
INSERT INTO basic VALUES('Eyes','B',4,2,'Face');
INSERT INTO basic VALUES('Mouth','C',4,3,'Face');

CREATE TABLE carry_spread
(
    subject     CHAR(25) PRIMARY KEY,
    colAs_Orig  CHAR(2),  
    row_id      INT,
    colAs_Num   INT,
    parent      CHAR(25)
);

CREATE TABLE carry_back
(
    subject     CHAR(25) PRIMARY KEY,
    colAs_Orig  CHAR(2),  
    row_id      INT,
    colAs_Num   INT,
    parent      CHAR(25)
);

CREATE TABLE move_backon
(
    row_stays     INT  PRIMARY KEY,
    col_gradient  INT  DEFAULT 1,
    col_add       INT  DEFAULT 0
);

CREATE TABLE move_horizon
(
    row_stays     INT  PRIMARY KEY,
    col_gradient  INT  DEFAULT 1,
    col_add       INT  DEFAULT 0
);


### CODE WRITTEN: {PROCESS in 2 parts}
delimiter //
CREATE PROCEDURE cntrPROCESS()
    BEGIN
       DROP TABLE IF EXISTS thru_put;
       CREATE TABLE thru_put AS
              SELECT subject,
                  row_stays, 
                  (colAs_Num * col_gradient) + col_add as 'desti_col',
                  parent
              from move_horizon,carry_spread
              where row_stays = row_id;

       DELETE from carry_spread;
       INSERT INTO carry_spread(subject, row_id, 
                  colAs_Num, parent)
              SELECT *
              from thru_put
       ;
       DROP TABLE IF EXISTS thru_put;
       CREATE TABLE thru_put AS
       SELECT subject,
           row_stays, 
           (colAs_Num * col_gradient) + col_add as 'desti_col',
           parent
              from move_backon,carry_back
              where row_stays = row_id;

       DELETE from carry_back;
       INSERT INTO carry_back(subject, row_id, 
                  colAs_Num, parent)
              SELECT *
              from thru_put
       ;
    END//
delimiter ;

### CODE WRITTEN: {ACCEPT in 2 parts} <NOW TESTABLE>
delimiter //
CREATE PROCEDURE cntrACCEPT()
    BEGIN
       DELETE from carry_back;
       INSERT into carry_back(subject,
                   colAs_Orig,row_id,
                   colAs_Num,parent)
              SELECT * from carry_spread
       ;
       delete from move_backon;
       INSERT into move_backon(row_stays,
                 col_gradient,col_add)
               SELECT * from  move_horizon
       ;
    END//
delimiter ;

### CODE WRITTEN: {REJECT in 2 parts}  ====> <NOW TESTABLE>
delimiter //
CREATE PROCEDURE cntrREJECT()
    BEGIN
       DELETE from carry_spread;
       INSERT into carry_spread(subject,
                   colAs_Orig,row_id,
                   colAs_Num,parent)
              SELECT * from carry_back
       ;
       delete from move_horizon;
       INSERT into move_horizon(row_stays,
                 col_gradient,col_add)
               SELECT * from  move_backon
       ;
    END//
delimiter ;


