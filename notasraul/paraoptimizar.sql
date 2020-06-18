SELECT * FROM asistencia where id_usuario=382 and fecha >= '2020-02-15' and fecha <= '2020-02-21' and asistencia = '1';
SELECT * FROM asistencia where id_usuario= 4 and asistencia = '1' and fecha between '2020-06-08' and '2020-06-14';
SELECT * FROM asistencia WHERE id_usuario=4 AND asistencia = '1' AND '22/07/2016' BETWEEN '2020-06-08' AND '2020-06-14';
SELECT * FROM asistencia where id_usuario=4 and fecha >= '2020-06-08' and fecha <= '2020-06-14' and id_motivo = '3';
SELECT * FROM asistencia where id_usuario= 4 and id_motivo = '3' and fecha between '2020-06-08' and '2020-06-14';
SELECT * FROM asistencia WHERE id_usuario=4 AND id_motivo = '3' AND '22/07/2016' BETWEEN '2020-06-08' AND '2020-06-14';