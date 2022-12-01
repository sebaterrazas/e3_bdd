CREATE OR REPLACE FUNCTION importar_productora(nombre varchar, contraseña_usuario varchar)
RETURNS BOOLEAN AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario FROM usuarios) THEN
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES (nombre, contraseña_usuario, 'productora');
        RETURN TRUE;
    ELSE 
        RETURN FALSE;
    END IF;
END
$$ language plpgsql