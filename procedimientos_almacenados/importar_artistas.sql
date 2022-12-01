CREATE OR REPLACE FUNCTION importar_artista(nombre varchar(90), contraseña_usuario varchar(30))
RETURNS BOOLEAN AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario FROM usuarios) THEN
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES (nombre, contraseña_usuario, 'artista');
        RETURN TRUE;
    ELSE 
        RETURN FALSE;
    END IF;
END
$$ language plpgsql