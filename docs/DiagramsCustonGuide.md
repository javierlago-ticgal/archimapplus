## 1. Uso del .xml con iconos en diagrams
Una vez en el diagrama simplemente importa el .xml y al usarlos y dar nombres a sus respectivos activos los encontrara y se enlazaran en GLPI al guardar y recargar la pagina
#### Para poder importar diagramas el perfil del usuario tiene que contener la palabra "admin" si no lo tiene no tendrá visibilidad de este apartado
<img width="1849" height="965" alt="image" src="https://github.com/user-attachments/assets/15ab627c-b459-47bf-8c71-1dc82038f754" />
Por lo que lo mejor que un admin añada estos diagramas interactivos en la libreria central: glpi y asi da igual el perfil podra usar estos diagramas interactivos ya que cualquier perfil tiene acceso a ella. 

#### AVISO NO AÑADIR ICONOS O IMAGENES QUE NO ESTEN PREPARADAS (INTERACTIVAS) EN LA LIBRERIA "GLPI" esto puede hacer que dejen de ser interactivos tanto los iconos por defecto como los preparados para ser interactivos.
<img width="1853" height="906" alt="image" src="https://github.com/user-attachments/assets/3d6ae13e-5308-448e-b7f4-d401e71886da" />


## 2. Como añadí la imagen el diagrama interactivo
Proceso para agregar una imagen a un diagrama GLPI interactivo
Crea una nueva biblioteca, agrega, por ejemplo, un diagrama de computadora y asígnale un nombre.

<img width="732" height="830" alt="image" src="https://github.com/user-attachments/assets/170348a9-0792-4f36-98a0-6307126f329b" />
<img width="732" height="830" alt="image" src="https://github.com/user-attachments/assets/0c184fd4-8703-479e-96af-2a025a56b586" />

A continuación: Añade esto al estilo del PC interactivo GLPI:shape=image;html=1;appType=node;verticalLabelPosition=bottom;verticalAlign=top;image=LINK;

<img width="1670" height="865" alt="image" src="https://github.com/user-attachments/assets/b9ac27b4-654f-4781-8b38-ce4f9307a436" />

Importa una imagen a tu nueva biblioteca y elige ambas, ahora edita el estilo desde el diagrama GLPI.

<img width="1670" height="865" alt="image" src="https://github.com/user-attachments/assets/5417133e-c038-4763-ac77-5a1ede0b4321" />
Selecciona ambas
<img width="1665" height="865" alt="image" src="https://github.com/user-attachments/assets/807b2c45-5b28-4a9f-9cc2-1fcbaa000fba" />
Copia el style de la imagen
<img width="801" height="443" alt="image" src="https://github.com/user-attachments/assets/1ce79be9-531b-433e-bddd-90a8510142f3" />

GLPI Interactive PC: Péguelo al final del comando image=LINK;
shape=image;html=1;appType=node;verticalLabelPosition=bottom;verticalAlign=top;image=LINK;

<img width="801" height="443" alt="image" src="https://github.com/user-attachments/assets/ae8749d0-46f8-4092-9ca7-28231fbbf44f" />

Arrastra el nuevo diagrama interactivo a tu biblioteca y expórtalo para usarlo cuando lo necesites.

<img width="1357" height="635" alt="image" src="https://github.com/user-attachments/assets/c3aa4f05-4233-413b-ab3d-0d7eb2def852" />
<img width="1665" height="865" alt="image" src="https://github.com/user-attachments/assets/33277c59-b437-4bfd-b54d-8a4be1fbfd56" />
