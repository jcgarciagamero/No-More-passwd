 NO MORE PASSWD
 
Sistema de login con Telegram, mediante contraseñas temporales, que se borran tras iniciar sesión. El nombre de usuario está hasheado para que no se pueda identificar, con lo que el único dato del usuario sería su ID del bot de Telegram.  La idea era utilizar el segundo factor como primero y que los usuarios no tengan que estar pensando una contraseña diferente para cada servicio. 

Si hubiese una brecha de seguridad, el problema de la contraseña desaparece. La única manera posible que se me ocurre de robar la cuenta, sería que tuviesen acceso al servidor, supiesen que el hash del usuario corresponde a un usuario determinado, o supiesen el chat ID para introducir una contraseña temporal, ya que si el campo está vacío no puede acceder. Además de todo eso, el usuario debería aceptar el inicio de sesión, con lo que, a no ser que pase algo por encima, sería muy complicado sin acceso físico a su cuenta de Telegram.

BOT: https://web.telegram.org/#/im?p=@Nomorepasswd_bot </br>
DEMO: https://demo.nomorepasswd.com </br>
WEB: https://nomorepasswd.com/

[![IMAGE ALT TEXT](https://i63.tinypic.com/8vnptg.png)](http://www.youtube.com/watch?v=KFj9PCgrxb4 "No More Passwd")
