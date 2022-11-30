CREATE OR REPLACE FUNCTION importar_artista(id int, nombre varchar, contraseña varchar, id_par int, id_impar int)
RETURNS void AS
$$
BEGIN
    INSERT INTO Usuarios VALUES (id, nombre, contraseña, "Artista", id_par, id_impar);
END
$$ language plpgsql