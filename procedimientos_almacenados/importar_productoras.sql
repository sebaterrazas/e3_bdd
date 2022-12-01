CREATE OR REPLACE FUNCTION importar_productora(id int, nombre varchar, contraseña varchar, id_par int, id_impar int)
RETURNS void AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario from usuarios) THEN
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES (nombre, contraseña, 'productora');
        RETURN TRUE;
    ELSE 
        RETURN FALSE;
    END IF;
END
$$ language plpgsql