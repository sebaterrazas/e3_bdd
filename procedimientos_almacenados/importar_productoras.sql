CREATE OR REPLACE FUNCTION importar_productora(nombre varchar, contraseña varchar)
RETURNS BOOLEAN AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario from usuarios) THEN
        INSERT INTO usuarios VALUES (nombre, contraseña, 'productora');
        RETURN TRUE;
    ELSE 
        RETURN FALSE;
    END IF;
END
$$ language plpgsql