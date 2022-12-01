CREATE OR REPLACE FUNCTION importar_artista(nombre varchar, contraseña varchar)
RETURNS BOOLEAN AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario from usuarios) THEN
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES (nombre, contraseña, 'artista');
        RETURN TRUE;
    ELSE 
        RETURN FALSE;
    END IF;
END
$$ language plpgsql