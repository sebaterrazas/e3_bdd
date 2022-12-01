CREATE OR REPLACE FUNCTION importar_artista(nombre varchar(90), contraseña_usuario varchar(30))
RETURNS BOOLEAN AS
$$
BEGIN
    INSERT INTO usuarios (nombre_usuario, contraseña, tipo) VALUES (nombre, contraseña_usuario, 'artista');
END
$$ language plpgsql