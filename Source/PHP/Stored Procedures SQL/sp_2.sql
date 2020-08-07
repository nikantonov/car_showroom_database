create or replace PROCEDURE a_m(nn IN VARCHAR, typ OUT VARCHAR)
 IS
BEGIN
  Select m.typ INTO typ from auto a, motor m
  where a.modell=nn AND a.motorid=m.motorid;
  END;
  