# ws-policy-example

Este servicio web expone una función `create_user_account` en la cual se encarga de crear una cuenta de usuario, donde el cliente web tiene la opción de seleccionar un **algoritmo criptográfico** para el cifrado de su contraseña. 

La [política de este servicio web](https://github.com/MrDave1999/ws-policy-example/blob/main/public/user.wsdl#L17) proporciona varias alternativas de métodos criptograficos al cliente: `sha1`, `sha256`, `aes128` y `aes256`.

## Instalación

**1.** Clone el repositorio:
```
git clone https://github.com/MrDave1999/ws-policy-example.git
```
**2.** Cambie de directorio:
```
cd ws-policy-example
```
**3.** Instale las dependencias del proyecto:

En Linux:
```
docker run --rm -it -v $PWD:/app composer install
```
En Windows:
```
docker run --rm -it -v %cd%:/app composer install
```

**4.** Copie el contenido de `.env.example` en `.env`:

En Linux:
```
cp .env.example .env
```
En Windows:
```
xcopy .env.example .env
```

**5.** Construya la imagen e inicie los servicios:
```
docker-compose up --build -d
```
**6.** Acceda a la aplicación de esta forma:
```
http://localhost:8080/
```

## Prueba

Puedes usar el **cliente de prueba** para comprobar si todo está funcionando:
```
docker-compose exec app php soapclient.php admin 1234 sha1
```
