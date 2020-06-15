DECLARE @OUTPUT as varchar(MAX),@SqlScript as varchar(MAX);
Set @OUTPUT = '';
Set @SqlScript = '';
Select @OUTPUT =CONCAT('''',REPLACE((SELECT zona FROM usuaripsPromo WHERE nombre='pedro'),',',''','''),'''') ;
select @SqlScript ='SELECT * FROM usuarionom usu
LEFT OUTER JOIN incentivo inc on inc.idempleado = usu.ucfdi 
where usu.gafete=''B'' and usu.dni in ('+@OUTPUT+') 
ORDER BY usu.canal,usu.us_apellidos,usu.puesto ASC' ;
select @OUTPUT;
EXEC (@SqlScript);
/*
SELECT * FROM usuarionom usu
LEFT OUTER JOIN incentivo inc on inc.idempleado = usu.ucfdi 
where usu.gafete='B' and usu.dni in (@OUTPUT) 
ORDER BY usu.canal,usu.us_apellidos,usu.puesto ASC;
*/


/*SELECT TOP 1 periodo, period, sem FROM periodo ORDER BY idp DESC;*/
SELECT zona FROM usuaripsPromo WHERE nombre='pedro';

