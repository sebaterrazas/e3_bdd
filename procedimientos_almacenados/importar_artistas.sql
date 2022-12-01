CREATE OR REPLACE FUNCTION importar_artista(nombre varchar(90), contraseña_usuario varchar(30))
RETURNS void AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario FROM usuarios) THEN
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES (nombre::varchar, contraseña_usuario::varchar, 'artista');
    END IF;
END
$$ language plpgsql