CREATE OR REPLACE FUNCTION importar_artista(nombre varchar(90), contraseña_usuario varchar(30))
RETURNS void AS
$$
BEGIN
    IF nombre NOT IN (SELECT nombre_usuario FROM usuarios) THEN
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('nombre', 'contraseña_usuario', 'artista');
    ELSE
        INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES ('no_nombre', 'np_contraseña_usuario', 'artista');
    END IF;
END
$$ language plpgsql