<?php
/*-------------------------------------------- Before using the class ------------------------------------------------*/
/*All examples start with this symbol 🎈  and ends with another comment , please comment what is under it, and you
 can skip  to the next example. */

/*Please, always require and create a new TalkToAtlante instance. */

require_once 'TalkToAtlante.php';
$talk = new \TalkToAtlante();

/*-------------------------------------------- MANAGING  ERRORS  -----------------------------------------------------*/

/* 🎈 One error example using default error clases 🎈:
In this case, the custom message  and the status code are ignored becase an error class has already been instantiated */

$talk->setError(new NotFoundError(), 'Ignored message', 500);

/* 🎈 Multiple error example 🎈 :
In this case, we will create a custom error, but also a default error class will be instantiated.
In this case both errors will be included in the api response. The http code of the last error code will override the
other http status codes previously added.*/

$talk->setError(null, 'Error al conectar con la base de datos', 500);
$talk->setError(new NotFoundError());

/*🎈 Finally, call sendResponse method. It will ignore the data you pass to the method if any error are detected 🎈 */
$talk->sendResponse();

/*-------------------------------------------- SENDING DATA -----------------------------------------------------*/

//🎈 Single response example. This will output this data as a json response. A 200 status code will be added by default🎈
$talk->sendResponse([
    'nombre' => 'Pepito',
    'correo' => 'email@email.com'
]);


// 🎈 Multiple response usage. In this case we'll send a custom status code as well.  🎈
$talk->sendResponse([[
    'nombre' => 'Pepito',
    'correo' => 'email@email.com'
], [
    'nombre' => 'Pepito',
    'correo' => 'email@email.com'
]],201);



