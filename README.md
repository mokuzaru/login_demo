# login_demo

Este ejemplo de registro de datos para alguna plataforma, web, etc. Tiene la finalidad de dar una idea de la configuración basica 
de seguridad, manejo de variables y flujo a implementar. El servidor se manejó a nivel local con ayuda de xamp (default config). 
La base de datos creada tiene el nombre de test, la tabla users. Los datos (columnas) son las siguientes:
<ul>
  <li>*id       (Tipo :int(8) , Auto_increment)</li>
  <li>*fecha    (Tipo:timestamp, Predeterminado: current_timestamp)</li>
  <li>*user     (Tipo:varchar(40), Cotejamiento: latin1_swedsh_ci)</li>
  <li>*password (Tipo:varchar(80),Cotejamiento: latin1_swedsh_ci)</li>
  <li>*mail     (Tipo:varchar(60),Cotejamiento: latin1_swedsh_ci)</li>
</ul>

Con la anterior configuración el demo deberia funcionar.

Nota la parte del envio del mail de confimación NO funcionará debido a que esa parte esta hecha para correr en un servidor con los
servicios necesarios para ser ejecutado exitosamente.
