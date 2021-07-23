# ws-policy-example

Este servicio web expone una función `create_user_account` en la cual se encarga de crear una cuenta de usuario, donde el cliente web tiene la opción de seleccionar un **algoritmo criptográfico** para el cifrado de su contraseña. 

La [política de este servicio web](https://github.com/MrDave1999/ws-policy-example/blob/main/user.wsdl#L16) proporciona varias alternativas de métodos criptograficos al cliente: `sha1`, `sha256`, `aes128` y `aes256`.

## Instalación

Para probar esta implementación se necesita tener:

- Apache HTTP
- PHP 8.0
  - Las extensiones `php8.0-mysqli` y `php8.0-xml` deben estar habilitadas.
- Biblioteca NuSOAP
- MySQL Server 8.0

Para importar `policy_example.sql` necesita primero crear la base de datos:
```sql
CREATE DATABASE policy_example;
```
Luego ejecute este comando (reemplace en `username` por el nombre de usuario que use, por ejemplo: `root`):
```bash
mysql -u username -p policy_example < policy_example.sql 
```

**Nota:** No olvide modificar el archivo `config.php` de acuerdo a sus necesidades.


