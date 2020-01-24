<?php
    //Se configura el BBClone:
    define("_BBC_PAGE_NAME", "english online");
    define("_BBCLONE_DIR", "../bbclone/");
    define("COUNTER", _BBCLONE_DIR."mark_page.php");
    if (is_readable(COUNTER)) include_once(COUNTER);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>La Ran&iacute;sima &copy; (by Joan Alba Maldonado)</title>
        <!-- (c) La Ranisima - Programa realizado por Joan Alba Maldonado (granvino@granvino.com). Prohibido publicar, reproducir o modificar sin citar expresamente al autor original. -->
        <script language="JavaScript1.2" type="text/javascript">
            <!--

            //(c) La Ranisima - Programa realizado por Joan Alba Maldonado (granvino@granvino.com). Prohibido publicar, reproducir o modificar sin citar expresamente al autor original.

            //Se crean las imagenes de la animacion del personaje y de los enemigos, de forma global:
            if (document.images)
             {
                //Se crean los objetos:
                var personaje_imagen1 = new Image(40, 40);
                var personaje_imagen2 = new Image(40, 40);
                var enemigo1_imagen1 = new Image(40, 40);
                var enemigo1_imagen2 = new Image(40, 40);
                var enemigo2_imagen1 = new Image(40, 40);
                var enemigo2_imagen2 = new Image(40, 40);
                var enemigo3_imagen1 = new Image(40, 40);
                var enemigo3_imagen2 = new Image(40, 40);
                var enemigo4_imagen1 = new Image(40, 40);
                var enemigo4_imagen2 = new Image(40, 40);
                var enemigo5_imagen1 = new Image(40, 40);
                var enemigo5_imagen2 = new Image(40, 40);
                var enemigo6_imagen1 = new Image(40, 40);
                var enemigo6_imagen2 = new Image(40, 40);
                var explosion_imagen = new Image(40, 40);
                
                //Se les asigna una imagen:
                personaje_imagen1.src = "imagenes/rana1.gif";
                personaje_imagen2.src = "imagenes/rana2.gif";
                enemigo1_imagen1.src = "imagenes/mosca1.gif";
                enemigo1_imagen2.src = "imagenes/mosca2.gif";
                enemigo2_imagen1.src = "imagenes/mosca1.gif";
                enemigo2_imagen2.src = "imagenes/mosca2.gif";
                enemigo3_imagen1.src = "imagenes/mosca1.gif";
                enemigo3_imagen2.src = "imagenes/mosca2.gif";
                enemigo4_imagen1.src = "imagenes/mosca1.gif";
                enemigo4_imagen2.src = "imagenes/mosca2.gif";
                enemigo5_imagen1.src = "imagenes/mosca1.gif";
                enemigo5_imagen2.src = "imagenes/mosca2.gif";
                enemigo6_imagen1.src = "imagenes/mosca1.gif";
                enemigo6_imagen2.src = "imagenes/mosca2.gif";
                explosion_imagen.src = "imagenes/boom.gif";
             }

            //Se define la variable para que no se cambie la imagen del personaje, a no ser que se ejecute movimiento:
            var cambiar_imagen = false;
            
            //Se define la variable que guardara el primer evento que se ejecute (para que no se ejecute onKeyDown y onKeyPress a la vez en Firefox, ya que causaria demasiada velocidad de movimiento):
            var primer_evento = "";

            //Variable que setea el modo Dios (invencible), para el periodo que transcurre desde una colision hasta el reposicionamiento (para que solo reste una vida):
            var modo_dios = false;

            //Variable que setea el numero de disparos que se han ejecutado y siguen en pantalla:
            var numero_disparos = 0;
            
            //Variable que setea el numero maximo de disparos permitido mientras esten en pantalla:
            var numero_disparos_tope = 5;
            
            //El numero de milisegundos que deben pasar entre disparo y disparo:
            var milisegundos_repeticion_disparo = 200;

            //La velocidad de los disparos:
            var velocidad_disparos = 30;

            //Variable que setea el bloqueo del disparo (para que no se dispare mas de lo debido, cuando el numero de disparos llega al tope o para que no se dispare muy deprisa):
            var bloquear_disparo = false;
            
            //Se define la direccion de inicio de los enemigos (tanto horizontal como vertical):
            var direccion_enemigos_x = "derecha"; //Direccion horizontal de inicio.
            var direccion_enemigos_y = "abajo"; //Direccion vertical de inicio.
            
            //Se define la velocidad inicial de los enemigos:
            var velocidad_enemigos_inicial = 1050; //Esta es constante
            var velocidad_enemigos = velocidad_enemigos_inicial; //Esta se ira decrementando cada vez que se pase de nivel (entre mas baja mas rapido).
            
            //Se define el desplazamiento inicial de los enemigos (cuantos pixels se desplazan por cada movimiento):
            var desplazamiento_enemigos_inicial = 25; //Esta es una constante.
            var desplazamiento_enemigos = desplazamiento_enemigos_inicial; //Esta se ira incrementando cada vez que se pase de nivel.

            //Define la variable de enemigos existentes, para los distintos niveles (cuantos tipos distintos hay):
            var enemigos_existentes = 7;
            
            //Define la variable para saber que enemigos utilizar al principio (al cambiar de nivel se va incrementando, hasta alcanzar el numero de enemigos existentes y se pone otra vez a 1):
            var enemigos_nivel = 1;
            
            //Se define el numero de vidas inicial, para el personaje:
            var vidas_iniciales = 3; //Esta es constante
            var vidas = vidas_iniciales; //Esta ira restando cada vez que se pierda una vida.

            //Se define el numero de nivel inicial (numero de pantalla):
            var nivel = 1;

            //Se define la variable que contendra la puntuacion:
            var puntuacion = 0;
            
            //Se define el contador de enemigos matados (en cada nivel se pondra a cero):
            var enemigos_matados = 0;

            //Se definen las variables para hacer los setInterval y setTimeout, para que no den error al ejecutar clearInterval y clearTimeout la primera vez:
            var animacion_enemigo1 = "";
            var animacion_enemigo2 = "";
            var animacion_enemigo3 = "";
            var animacion_enemigo4 = "";
            var animacion_enemigo5 = "";
            var animacion_enemigo6 = "";
            var movimiento_enemigo1 = "";
            var movimiento_enemigo2 = "";
            var movimiento_enemigo3 = "";
            var movimiento_enemigo4 = "";
            var movimiento_enemigo5 = "";
            var movimiento_enemigo6 = "";                                    
            var movimiento_alas1 = "";
            var movimiento_alas2 = "";
            var balanceo_horizontal1 = "";
            var balanceo_horizontal2 = "";
            var balanceo_vertical1 = "";
            var balanceo_vertical2 = "";


            //Funcion que inicia el juego:
            function iniciar_juego()
             {
                //Se setea el numero de vidas a vidas_iniciales:
                vidas = vidas_iniciales;
                
                //Se setea el numero de nivel otra vez a cero:
                nivel = 1;
                
                //Se setea la puntuacion a cero:
                puntuacion = 0;
                
                //Se setean los enemigos matados a cero:
                enemigos_matados = 0;

                //Se setea la velocidad de los enemigos a la inicial:
                velocidad_enemigos = velocidad_enemigos_inicial; 
                
                //Se setea los pixels de desplazamiento del enemigo a su estado inicial:
                desplazamiento_enemigos = desplazamiento_enemigos_inicial;
              
                //Se indica el numero de vidas en el panel de estado:
                actualizar_barra_estado();

                //Se setea la variable que indica que enemigos mostrar, para que se muestre el primer enemigo:
                enemigos_nivel = 1;
                
                //Se setean las imagenes de los enemigos a los primeros:
                enemigo1_imagen1.src = "imagenes/mosca1.gif";
                enemigo1_imagen2.src = "imagenes/mosca2.gif";
                enemigo2_imagen1.src = "imagenes/mosca1.gif";
                enemigo2_imagen2.src = "imagenes/mosca2.gif";
                enemigo3_imagen1.src = "imagenes/mosca1.gif";
                enemigo3_imagen2.src = "imagenes/mosca2.gif";
                enemigo4_imagen1.src = "imagenes/mosca1.gif";
                enemigo4_imagen2.src = "imagenes/mosca2.gif";
                enemigo5_imagen1.src = "imagenes/mosca1.gif";
                enemigo5_imagen2.src = "imagenes/mosca2.gif";
                enemigo6_imagen1.src = "imagenes/mosca1.gif";
                enemigo6_imagen2.src = "imagenes/mosca2.gif";

                //Hacer visibles a todos los enemigos (por si acaso estuviera alguno invisible de una partida anterior):
                for (x=1; x<=6; x++)
                 {
                    //Hace visible al enemigo X:
                    document.getElementById("enemigo"+x).style.visibility = "visible";
                 }

                //Se oculta el texto de "tu estas aqui", si aun esta visible, en 3000 milisegundos (3 segundos) :
                if (document.getElementById('tu_estas_aqui').style.visibility == "visible") { setTimeout("document.getElementById('tu_estas_aqui').style.visibility = 'hidden';", 3000); }
                
                //Posiciona los personajes:
                posicionar_personajes();
             }

            //Funcion que posiciona los personajes (al inicio del juego y despues de una vida):
            function posicionar_personajes()
             {
                //Inicia los enemigos:
                iniciar_enemigos();

                //Inicia el personaje:
                iniciar_personaje();
             }

            //Funcion que inicia al personaje:
            function iniciar_personaje()
             {
                document.getElementById("personaje").style.left = "250px";
                document.getElementById("personaje").style.top = "250px";
             }

            //Funcion que inicia a los enemigos:
            function iniciar_enemigos()
             {
                 //Posicionar enemigos en sus posiciones iniciales:
                 document.getElementById("enemigo1").style.left = "120px";
                 document.getElementById("enemigo1").style.top = "120px";
                 document.getElementById("enemigo2").style.left = "450px";
                 document.getElementById("enemigo2").style.top = "120px";
                 document.getElementById("enemigo3").style.left = "350px";
                 document.getElementById("enemigo3").style.top = "120px";
                 document.getElementById("enemigo4").style.left = "450px";
                 document.getElementById("enemigo4").style.top = "20px";
                 document.getElementById("enemigo5").style.left = "150px";
                 document.getElementById("enemigo5").style.top = "50px";
                 document.getElementById("enemigo6").style.left = "250px";
                 document.getElementById("enemigo6").style.top = "90px";
                 
                 //Matar los intervalos de animacion y de posicionamiento anteriores, si existen (con clearInterval):
                 clearInterval(animacion_enemigo1, 30);
                 clearInterval(animacion_enemigo2, 30);
                 clearInterval(animacion_enemigo3, 30);
                 clearInterval(animacion_enemigo4, 30);
                 clearInterval(animacion_enemigo5, 30);
                 clearInterval(animacion_enemigo6, 30);
                 clearInterval(movimiento_enemigo1, 30);
                 clearInterval(movimiento_enemigo2, 30);
                 clearInterval(movimiento_enemigo3, 30);
                 clearInterval(movimiento_enemigo4, 30);
                 clearInterval(movimiento_enemigo5, 30);
                 clearInterval(movimiento_enemigo6, 30);

                 //Animar enemigos:
                 setTimeout("var animacion_enemigo1 = setInterval('animar_enemigo(1);', 1000)", 100);
                 setTimeout("var animacion_enemigo2 = setInterval('animar_enemigo(2);', 1000)", 100);
                 setTimeout("var animacion_enemigo3 = setInterval('animar_enemigo(3);', 1000)", 100);
                 setTimeout("var animacion_enemigo4 = setInterval('animar_enemigo(4);', 1000)", 100);
                 setTimeout("var animacion_enemigo5 = setInterval('animar_enemigo(5);', 1000)", 100);
                 setTimeout("var animacion_enemigo6 = setInterval('animar_enemigo(6);', 1000)", 100);
                                                   
                 //Mover enemigos:
                 setTimeout("movimiento_enemigo1 = setInterval('mover_enemigo(1);', velocidad_enemigos);", 100);
                 setTimeout("movimiento_enemigo2 = setInterval('mover_enemigo(2);', velocidad_enemigos);", 100);
                 setTimeout("movimiento_enemigo3 = setInterval('mover_enemigo(3);', velocidad_enemigos);", 100);
                 setTimeout("movimiento_enemigo4 = setInterval('mover_enemigo(4);', velocidad_enemigos);", 100);
                 setTimeout("movimiento_enemigo5 = setInterval('mover_enemigo(5);', velocidad_enemigos);", 100);
                 setTimeout("movimiento_enemigo6 = setInterval('mover_enemigo(6);', velocidad_enemigos);", 100);

                //Detectar colision:
                setInterval("detectar_colision(1);", 1);
                setInterval("detectar_colision(2);", 1);
                setInterval("detectar_colision(3);", 1);
                setInterval("detectar_colision(4);", 1);
                setInterval("detectar_colision(5);", 1);
                setInterval("detectar_colision(6);", 1);
             }

            //Funcion para animar un enemigo:
            function animar_enemigo(numero_enemigo)
             {
                 //Se matan todos los setTimeout anteriores, con la ayuda de clearTimeout:
                 clearTimeout(movimiento_alas1, 30);
                 clearTimeout(movimiento_alas2, 30);
                 clearTimeout(balanceo_horizontal1, 30);
                 clearTimeout(balanceo_horizontal2, 30);
                 clearTimeout(balanceo_vertical1, 30);
                 clearTimeout(balanceo_vertical2, 30);

                
                //Se llama a la funcion que anima al enemigo en si (despues de 20 milisegundos para que no interfiera con los clearTimeout de arriba):
                setTimeout("animacion_enemigo("+numero_enemigo+");", 100);
             }

            //Funcion que contiene la animacion del enemigo:
            function animacion_enemigo(numero_enemigo)
             {
                 //Se mueven sus alas (se alternan las imagenes):
                 var movimiento_alas1 = setTimeout("document.images['enemigo"+numero_enemigo+"_imagen'].src = enemigo"+numero_enemigo+"_imagen1.src;", 20);
                 var movimiento_alas2 = setTimeout("document.images['enemigo"+numero_enemigo+"_imagen'].src = enemigo"+numero_enemigo+"_imagen2.src;", 400);

                 //Se anima (mueve) horizontalmente:
                 var balanceo_horizontal1 = setTimeout("document.getElementById('enemigo"+numero_enemigo+"').style.left = parseInt(document.getElementById('enemigo"+numero_enemigo+"').style.left) + 5 + 'px';", 20);
                 var balanceo_horizontal2 = setTimeout("document.getElementById('enemigo"+numero_enemigo+"').style.left = parseInt(document.getElementById('enemigo"+numero_enemigo+"').style.left) - 5 + 'px';", 400);
                
                 //Se anima (mueve) verticalmente:
                 var balanceo_vertical1 = setTimeout("document.getElementById('enemigo"+numero_enemigo+"').style.top = parseInt(document.getElementById('enemigo"+numero_enemigo+"').style.top) + 5 + 'px';", 20);
                 var balanceo_vertical2 = setTimeout("document.getElementById('enemigo"+numero_enemigo+"').style.top = parseInt(document.getElementById('enemigo"+numero_enemigo+"').style.top) - 5 + 'px';", 400);
             }
            

            //Funcion que mueve al enemigo:
            function mover_enemigo(numero_enemigo)
             {
                //Define la variable que calcula si se ha tocado el bode lateral (de momento, no):
                var tocado_borde_lateral = false;
                
                //Se calculan los topes (bordes) para saber si se alcanzan:
                var borde_horizontal_derecho = 500 - 40 - desplazamiento_enemigos; //borde = 500 - 40 - desplazamiento_enemigos
                var borde_horizontal_izquierdo = 0 + desplazamiento_enemigos; //borde = 0 + desplazamiento_enemigos
                var borde_vertical_inferior = 500 - 40 - desplazamiento_enemigos; //borde = 500 - 40 - desplazamiento_enemigos
                var borde_vertical_superior = 0 + desplazamiento_enemigos; //borde = 0 + desplazamiento_enemigos
                
                //Si se ha alcanzado el borde derecho, el enemigo ira hacia la izquierda:
                if (parseInt(document.getElementById("enemigo"+numero_enemigo).style.left) >= borde_horizontal_derecho)
                 {
                    //La direccion horizontal sera hacia la izquierda:
                    direccion_enemigos_x = "izquierda";
                    //Se setea la variable como que se ha tocado borde:
                    tocado_borde_lateral = true;
                 }
                //...y si no, si se ha alcanzado el borde izquierdo, el enemigo ira hacia la derecha:
                else if (parseInt(document.getElementById("enemigo"+numero_enemigo).style.left) <= borde_horizontal_izquierdo)
                 {
                    //La direccion horizontal sera hacia la derecha:
                    direccion_enemigos_x = "derecha";
                    //Se setea la variable como que se ha tocado borde:
                    tocado_borde_lateral = true;
                 }

                //Si se ha alcanzado el borde inferior, el enemigo ira hacia arriba:
                if (parseInt(document.getElementById("enemigo"+numero_enemigo).style.top) >= borde_vertical_inferior)
                 {
                    //La direccion vertical sera hacia arriba:
                    direccion_enemigos_y = "arriba";
                 }
                //...y si no, si se ha alcanzado el borde izquierdo, el enemigo ira hacia la derecha:
                else if (parseInt(document.getElementById("enemigo"+numero_enemigo).style.top) <= borde_vertical_superior)
                 {
                    //La direccion vertical sera hacia abajo:
                    direccion_enemigos_y = "abajo";
                 }

                //Si la direccion horizontal es "izquierda":
                if (direccion_enemigos_x == "izquierda")
                 {
                    //Mueve el enemigo hacia la izquierda:
                    document.getElementById("enemigo"+numero_enemigo).style.left = parseInt(document.getElementById("enemigo"+numero_enemigo).style.left) - desplazamiento_enemigos + "px";
                 }
                //...y si la direccion horizontal es "derecha":
                else if (direccion_enemigos_x == "derecha")
                 {
                    //Mueve el enemigo hacia la derecha:
                    document.getElementById("enemigo"+numero_enemigo).style.left = parseInt(document.getElementById("enemigo"+numero_enemigo).style.left) + desplazamiento_enemigos + "px";
                 }

                //Si la direccion vertical es "arriba" y ha tocado el borde lateral:
                if (direccion_enemigos_y == "arriba" && tocado_borde_lateral)
                 {
                    //Mueve el enemigo hacia arriba:
                    document.getElementById("enemigo"+numero_enemigo).style.top = parseInt(document.getElementById("enemigo"+numero_enemigo).style.top) - desplazamiento_enemigos + "px";
                 }
                //...y si la direccion vertical es "abajo" y ha tocado el borde lateral:
                else if (direccion_enemigos_y == "abajo" && tocado_borde_lateral)
                 {
                    //Mueve el enemigo hacia abajo:
                    document.getElementById("enemigo"+numero_enemigo).style.top = parseInt(document.getElementById("enemigo"+numero_enemigo).style.top) + desplazamiento_enemigos + "px";
                 }
                
             }

            //Funcion que detecta una colision del personaje contra un enemigo:
            function detectar_colision (numero_enemigo)
             {
                //Si el enemigo no esta visible quiere decir que esta muerto y por lo tanto no puede matarnos, asi que salimos de la funcion:
                if (document.getElementById("enemigo"+numero_enemigo).style.visibility != "visible") { return; }
                
                //Detectar posicion del personaje:
                personaje_pos_x = parseInt(document.getElementById("personaje").style.left);
                personaje_pos_y = parseInt(document.getElementById("personaje").style.top);

                //Detectar posicion del enemigo:
                enemigo_pos_x = parseInt(document.getElementById("enemigo"+numero_enemigo).style.left);
                enemigo_pos_y = parseInt(document.getElementById("enemigo"+numero_enemigo).style.top);
                
                //Calcular si coinciden horizontalmente:
                if (personaje_pos_x + 40 > enemigo_pos_x && personaje_pos_x < enemigo_pos_x || personaje_pos_x < enemigo_pos_x + 40 && personaje_pos_x > enemigo_pos_x)
                 {
                    //Calcular si tambien coinciden verticalmente: 
                    if (personaje_pos_y < enemigo_pos_y + 40 && personaje_pos_y > enemigo_pos_y || personaje_pos_y + 40 > enemigo_pos_y && personaje_pos_y < enemigo_pos_y)
                     {
                        //Si esta el modo Dios activado, sale de la funcion (para no restar vidas):
                        if (modo_dios) { return; }
                        
                        //Como han chocado, se quita una vida:
                        vidas -= 1;
                        
                        //Se setea el modo Dios, para que no puedan matar al personaje durante este periodo (hasta que se posicione otra vez):
                        modo_dios = true;

                        //Se muestra en el ID del personaje una explosion a los 300 milisegundos (con z-index a 40), y a los 3000 milisegundos (2700 despues) se vuelve al personaje normal (con z-index original):
                        setTimeout("document.images['personaje_imagen'].src = explosion_imagen.src; document.getElementById('personaje').style.zIndex = 40;", 210);
                        setTimeout("document.images['personaje_imagen'].src = personaje_imagen1.src; document.getElementById('personaje').style.zIndex = 5;", 3000);
                        
                        //Si las vidas es menor a 0, se presenta "Game Over" y se sale de la funcion:
                        if (vidas < 0)
                         {
                            //Presenta "Game Over" en el panel de estado:
                            actualizar_barra_estado();
                            
                            //Cancelar todos los disparos:
                            for (x=1; x<=numero_disparos_tope; x++)
                             {
                                //Elimina de la pantalla el disparo X:
                                eliminar_disparo(x);
                             }
                            
                            //Alerta de "Game Over" (despues de un tiempo, ya que si no no daria tiempo a la rana a cambiar a "explosion"):
                            setTimeout("alert('Game Over. Click on button to play again.');", 300);
                            
                            //Se inicia el juego otra vez y se quita el modo Dios, al esperar 3000 milisegundos (3 segundos):
                            setTimeout("iniciar_juego(); modo_dios = false;", 3000);
                            
                            //Sale de la funcion:
                            return;
                         }
                        
                        //Se indican las vidas en el panel de estado:
                        actualizar_barra_estado();
                        
                        //Se hace visible el ID "tu_estas_aqui" y se indica en el que se ha perdido una vida:
                        document.getElementById("tu_estas_aqui").style.visibility = "visible";
                        document.getElementById("tu_estas_aqui").innerHTML = "A live less";

                        //Se indican las vidas restantes:
                        if (vidas == 1) { setTimeout("document.getElementById('tu_estas_aqui').innerHTML = '"+vidas+" live left';", 800); } //Si queda una vida, la frase es en singular.
                        else if (vidas <= 0) { setTimeout("document.getElementById('tu_estas_aqui').innerHTML = 'Last live';", 800); } //Si quedan cero vidas, se advierte de que es la ultima vida.
                        else { setTimeout("document.getElementById('tu_estas_aqui').innerHTML = '"+vidas+" lives left';", 800); } //...y si no, se indica normalmente, en plural.

                        //Se esconde el mensaje de las vidas restantes (se hace invisible el ID "tu_estas_aqui"):
                        setTimeout("document.getElementById('tu_estas_aqui').style.visibility = 'hidden';", 3000);
                       
                        //Se reinician posiciones tanto de personajes como de enemigos y se quita el modo Dios:
                        setTimeout("posicionar_personajes(); modo_dios = false;", 3000);
                     }
                 }
                
             }

            //Funcion que dispara:
            function disparar()
             {
                //Si esta seteada la variable para que no vuelva a disparar, salir de la funcion:
                if (bloquear_disparo) { return; }
                
                //Impedir disparar si el personaje esta demasiado arriba (si no queda espacio para un disparo, que tiene un largo de 15 pixels):
                if (parseInt(document.getElementById("personaje").style.top) <= 15) { return; }

                //Si el numero de disparos es inferior a cero, se setea a cero (por si acaso se han eliminado mas de lo debido):
                if (numero_disparos < 0) { numero_disparos = 0; }

                //Calcular si ya hay en pantalla (ya se han lanzado) el numero maximo de disparos:
                if (numero_disparos > numero_disparos_tope)
                 {
                    //Si el ultimo disparo en ejecutarse (que es el 5) esta hidden, se setea a cero y se sale de la funcion:
                    if (document.getElementById("disparo_5").style.visibility && document.getElementById("disparo_5").style.visibility == "hidden")
                     {
                        numero_disparos = 0; //Se setea el numero de disparos a cero.
                        bloquear_disparo = false; //Se quita el bloqueo de disparar.
                        return; //Sale de la funcion.
                     }

                    //Se pone el numero de disparos al limite maximo, por si a caso lo a sobrepasado:
                    numero_disparos = numero_disparos_tope;
                    numero_disparos = 0;

                    //Se elimina el desbloqueo automatico del disparo, por si acaso:
                    clearTimeout(quitar_bloqueo_disparo);

                    //Setear variable para que no vuelva a disparar hasta que no hayan menos disparos en pantalla (despues de mas milisegundos que el desbloqueo del disparo, por si acaso):
                    setTimeout("bloquear_disparo = true;", milisegundos_repeticion_disparo);
                    
                    //Se sale de la funcion:
                    return;
                 }
             
                //Incrementar la variable que cuenta el numero de disparos que hay en pantalla (que se han ejecutado):
                numero_disparos++;

                //Si el numero de disparos es superior al tope, se situa en el maximo posible:
                if (numero_disparos > numero_disparos_tope) { numero_disparos = numero_disparos_tope; }

                //Si el estado del disparo no es invisible, es que aun esta en pantalla y sale de funcion:
                if (document.getElementById("disparo_"+numero_disparos).style.visibility && document.getElementById("disparo_"+numero_disparos).style.visibility == "visible") { numero_disparos--; return; }
               
                //Situar el DIV del disparo en la posicion correcta (respecto al personaje):
                document.getElementById("disparo_"+numero_disparos).style.left = parseInt(document.getElementById("personaje").style.left) + 20 + "px";
                document.getElementById("disparo_"+numero_disparos).style.top = parseInt(document.getElementById("personaje").style.top) - 20 + "px";
                
                //Hace visible el DIV que contiene el disparo:
                document.getElementById("disparo_"+numero_disparos).style.visibility = "visible";
                
                //Hacer el movimiento del disparo (selecciona segun el numero de disparo):
                switch (numero_disparos)
                 {
                    case 1:
                        movimiento_disparo1 = setInterval("mover_disparo(1, parseInt(document.getElementById('disparo_1').style.left), parseInt(document.getElementById('disparo_1').style.top));", velocidad_disparos);
                        break;
                    case 2:
                        movimiento_disparo2 = setInterval("mover_disparo(2, parseInt(document.getElementById('disparo_2').style.left), parseInt(document.getElementById('disparo_2').style.top));", velocidad_disparos);
                        break;
                    case 3:
                        movimiento_disparo3 = setInterval("mover_disparo(3, parseInt(document.getElementById('disparo_3').style.left), parseInt(document.getElementById('disparo_3').style.top));", velocidad_disparos);
                        break;
                    case 4:
                        movimiento_disparo4 = setInterval("mover_disparo(4, parseInt(document.getElementById('disparo_4').style.left), parseInt(document.getElementById('disparo_4').style.top));", velocidad_disparos);
                        break;
                    case 5:
                        movimiento_disparo5 = setInterval("mover_disparo(5, parseInt(document.getElementById('disparo_5').style.left), parseInt(document.getElementById('disparo_5').style.top));", velocidad_disparos);
                        break;
                    default:
                        numero_disparos--; //Se vuelven a decrementar los disparos, por si acaso.
                        return;
                        break;
                 }

                //Se bloquean los disparos hasta dentro de los milisegundos indicados:
                bloquear_disparo = true;
                quitar_bloqueo_disparo = setTimeout("bloquear_disparo = false;", milisegundos_repeticion_disparo);
 
             }

            //Funcion que elimina un disparo:
            function eliminar_disparo(numero_disparo)
             {
                //Se setea la variable para saber si se ha eliminado un disparo:
                var se_ha_eliminado_disparo = false;

                //Si el disparo que se intenta eliminar ya esta eliminado, sale de la funcion:
                if (document.getElementById("disparo_"+numero_disparo).style.visibility == "hidden") { return; }

                //Elimina el movimiento del disparo enviado y pone invisible su DIV (selecciona segun el numero de disparo):
                switch (numero_disparo)
                 {
                    case 1: //En caso de que el disparo sea el 1:
                        clearInterval(movimiento_disparo1); //Elimina el intervalo.
                        document.getElementById("disparo_1").style.visibility = "hidden"; //Esconde el DIV que contiene el disparo.
                        se_ha_eliminado_disparo = true; //Se setea la variable para saber que se ha eliminado el disparo.
                        break; //Sale del switch.
                    case 2:
                        clearInterval(movimiento_disparo2);
                        document.getElementById("disparo_2").style.visibility = "hidden";
                        se_ha_eliminado_disparo = true;
                        break;
                    case 3:
                        clearInterval(movimiento_disparo3);
                        document.getElementById("disparo_3").style.visibility = "hidden";
                        se_ha_eliminado_disparo = true;
                        break;
                    case 4:
                        clearInterval(movimiento_disparo4);
                        document.getElementById("disparo_4").style.visibility = "hidden";
                        se_ha_eliminado_disparo = true;
                        break;
                    case 5:
                        clearInterval(movimiento_disparo5);
                        document.getElementById("disparo_5").style.visibility = "hidden";
                        numero_disparos = 0; //Como se ha eliminado el ultimo disparo, se setea a cero el contador de disparos.
                        se_ha_eliminado_disparo = true;
                        break;
                    default:
                        se_ha_eliminado_disparo = false;
                        break;
                 }
                
                //Calcula si se ha eliminado algun disparo en la funcion:
                if (se_ha_eliminado_disparo)
                 {
                    //Resta una unidad al numero de disparos que hay en pantalla y se han ejecutado.
                    numero_disparos--;
                    //Desbloquea los disparos (para que se pueda disparar):
                    bloquear_disparo = false;
                 }

             }


            //Funcion que realiza el movimiento del disparo:
            function mover_disparo(numero_disparo, disparo_pos_x, disparo_pos_y)
             {
                //Mueve el disparo 3 pixels hacia arriba y si alcanza el borde, elimina el disparo (selecciona segun el numero de disparo):
                switch (numero_disparo)
                 {
                    case 1:
                        if (parseInt(document.getElementById("disparo_1").style.top) <= 15) { eliminar_disparo(1); return; } //Si su posicion es mas arriba de lo que debe, se elimina el disparo de la pantalla y se sale de la funcion.
                        document.getElementById("disparo_1").style.top = disparo_pos_y - 3 + "px"; //Si no, se mueve el disparo.
                        break;
                    case 2:
                        if (parseInt(document.getElementById("disparo_2").style.top) <= 15) { eliminar_disparo(2); return; }
                        document.getElementById("disparo_2").style.top = disparo_pos_y - 3 + "px";
                        break;
                    case 3:
                        if (parseInt(document.getElementById("disparo_3").style.top) <= 15) { eliminar_disparo(3); return; }
                        document.getElementById("disparo_3").style.top = disparo_pos_y - 3 + "px"; break;
                    case 4:
                        if (parseInt(document.getElementById("disparo_4").style.top) <= 15) { eliminar_disparo(4); return; }
                        document.getElementById("disparo_4").style.top = disparo_pos_y - 3 + "px"; break;
                    case 5:
                        if (parseInt(document.getElementById("disparo_5").style.top) <= 15) { eliminar_disparo(5); return; }
                        document.getElementById("disparo_5").style.top = disparo_pos_y - 3 + "px"; break;
                    default: break;
                 }

                //Calcular si ha colisionado con un enemigo:
                detectar_colision_disparo(disparo_pos_x, disparo_pos_y, numero_disparo);
                
             }

            //Funcion que calcula si un disparo choca con un enemigo:
            function detectar_colision_disparo (disparo_pos_x, disparo_pos_y, numero_disparo)
             {
                //Variable contador de numero de enemigo:
                var x = 1;
                //Bucle que detecta la colision del disparo enviado a la funcion con todos los enemigos (en total 6):
                while (x <= 6)
                 {
                    //Calcular si en la posicion horizontal del disparo hay el enemigo X:
                    if (disparo_pos_x >= parseInt(document.getElementById("enemigo"+x).style.left) && disparo_pos_x <= parseInt(document.getElementById("enemigo"+x).style.left) + 40)
                     {
                        //Calcular si en la posicion vertical del disparo hay el enemigo X:
                        if (disparo_pos_y >= parseInt(document.getElementById("enemigo"+x).style.top) && disparo_pos_y <= parseInt(document.getElementById("enemigo"+x).style.top) + 40)
                         {
                            //Se calcula si el enemigo este visible (si no esta visible es que ya se ha matado antes):
                            if (document.getElementById("enemigo"+x).style.visibility == "visible")
                             {
                                //Se incrementa el contador de enemigos matados:
                                enemigos_matados++;

                                //Restar un disparo en pantalla:
                                eliminar_disparo(numero_disparo);

                                //Como coinciden disparo y enemigo X, se mata al enemigo:
                                matar_enemigo(x);
                                
                                //Se sale del bucle, para que solo se pueda matar a un enemigo por disparo:
                                break;
                             }
                         }
                     }
                    //Se incrementa el contador:
                    x++;
                 }
             }

            //Funcion que mata a un enemigo:
            function matar_enemigo(numero_enemigo)
             {
                //Matar enemigo (lo esconde de la pantalla):
                document.getElementById("enemigo"+numero_enemigo).style.visibility = "hidden";
               
                //Da puntos (+25):
                puntuacion += 25;
                
                //Muestra la barra de estado con la nueva informacion:
                actualizar_barra_estado();
                
                //Si ya no quedan mas, pasar de nivel:
                if (enemigos_matados >= 6) { pasar_nivel(); }
             }

            function pasar_nivel()
             {
                //Si todavia no se han matado dos los enemigos, sale de la funcion:
                if (enemigos_matados < 6) { return; }

                //Se setea el contador de enemigos matados a cero:
                enemigos_matados = 0;
                
                //Se incrementa el numero de nivel en una unidad:
                nivel++;
                
                //Da puntos (+100):
                puntuacion += 100;

                //Cancelar todos los disparos:
                for (x=1; x<=numero_disparos_tope; x++)
                 {
                    //Elimina de la pantalla el disparo X:
                    eliminar_disparo(x);
                 }

                //Se felicita por pasar de nivel:
                //alert("Felicidades. Has pasado al nivel "+nivel);

                //Se representa en la barra de estado los nuevos parametros:
                actualizar_barra_estado();

                //Se representa en la barra de estado el numero de nivel, durante 3000 milisegundos (3 segundos) y luego se esconde:
                document.getElementById("tu_estas_aqui").style.visibility = "visible";
                document.getElementById("tu_estas_aqui").innerHTML = "Level "+nivel;
                setTimeout("document.getElementById('tu_estas_aqui').style.visibility = 'hidden';", 3000);
                       
                //Hacer visibles a todos los enemigos:
                for (x=1; x<=6; x++)
                 {
                    //Hace visible al enemigo X:
                    document.getElementById("enemigo"+x).style.visibility = "visible";
                 }
                
                //Incrementar velocidad de los enemigos:
                velocidad_enemigos -= 5;
                
                //Si el resto de dividir el nivel entre 5 es igual a 0 (se han pasado 5 niveles mas), incrementar tambien el espacio de desplazamiento de los enemigos:
                if (nivel % 5 == 0 && nivel > 1)
                 {
                    //Ahora los enemigos se desplazaran 5 pixels mas en cada movimiento:
                    desplazamiento_enemigos += 5;
                    
                    //Da puntos (+200):
                    puntuacion += 200;
                 }

                //Incrementa la variable para saber que enemigos mostrar:
                enemigos_nivel++;

                //Si el contador para saber que enemigos representar es mayor a los enemigos existentes, vuelve a su estado inicial:
                if (enemigos_nivel > enemigos_existentes) { enemigos_nivel = 1; }

                //Si se debe representar los primeros enemigos:
                if (enemigos_nivel == 1)
                 {
                    //Se representan como enemigos las moscas:
                    enemigo1_imagen1.src = "imagenes/mosca1.gif";
                    enemigo1_imagen2.src = "imagenes/mosca2.gif";
                    enemigo2_imagen1.src = "imagenes/mosca1.gif";
                    enemigo2_imagen2.src = "imagenes/mosca2.gif";
                    enemigo3_imagen1.src = "imagenes/mosca1.gif";
                    enemigo3_imagen2.src = "imagenes/mosca2.gif";
                    enemigo4_imagen1.src = "imagenes/mosca1.gif";
                    enemigo4_imagen2.src = "imagenes/mosca2.gif";
                    enemigo5_imagen1.src = "imagenes/mosca1.gif";
                    enemigo5_imagen2.src = "imagenes/mosca2.gif";
                    enemigo6_imagen1.src = "imagenes/mosca1.gif";
                    enemigo6_imagen2.src = "imagenes/mosca2.gif";
                 }
                //...y si se deben representar los segundos enemigos:
                else if (enemigos_nivel == 2)
                 {
                    //Se representan los murcielagos:
                    enemigo1_imagen1.src = "imagenes/murci1.gif";
                    enemigo1_imagen2.src = "imagenes/murci2.gif";
                    enemigo2_imagen1.src = "imagenes/murci1.gif";
                    enemigo2_imagen2.src = "imagenes/murci2.gif";
                    enemigo3_imagen1.src = "imagenes/murci1.gif";
                    enemigo3_imagen2.src = "imagenes/murci2.gif";
                    enemigo4_imagen1.src = "imagenes/murci1.gif";
                    enemigo4_imagen2.src = "imagenes/murci2.gif";
                    enemigo5_imagen1.src = "imagenes/murci1.gif";
                    enemigo5_imagen2.src = "imagenes/murci2.gif";
                    enemigo6_imagen1.src = "imagenes/murci1.gif";
                    enemigo6_imagen2.src = "imagenes/murci2.gif";
                 }
                //...y si se deben representar los terceros enemigos:
                else if (enemigos_nivel == 3)
                 {
                    //Se representan los cerdos:
                    enemigo1_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo1_imagen2.src = "imagenes/cerdito2.gif";
                    enemigo2_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo2_imagen2.src = "imagenes/cerdito2.gif";
                    enemigo3_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo3_imagen2.src = "imagenes/cerdito2.gif";
                    enemigo4_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo4_imagen2.src = "imagenes/cerdito2.gif";
                    enemigo5_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo5_imagen2.src = "imagenes/cerdito2.gif";
                    enemigo6_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo6_imagen2.src = "imagenes/cerdito2.gif";
                 }
                //...y si se deben representar los cuartos enemigos:
                else if (enemigos_nivel == 4)
                 {
                    //Se representan las serpientes:
                    enemigo1_imagen1.src = "imagenes/serpien1.gif";
                    enemigo1_imagen2.src = "imagenes/serpien2.gif";
                    enemigo2_imagen1.src = "imagenes/serpien1.gif";
                    enemigo2_imagen2.src = "imagenes/serpien2.gif";
                    enemigo3_imagen1.src = "imagenes/serpien1.gif";
                    enemigo3_imagen2.src = "imagenes/serpien2.gif";
                    enemigo4_imagen1.src = "imagenes/serpien1.gif";
                    enemigo4_imagen2.src = "imagenes/serpien2.gif";
                    enemigo5_imagen1.src = "imagenes/serpien1.gif";
                    enemigo5_imagen2.src = "imagenes/serpien2.gif";
                    enemigo6_imagen1.src = "imagenes/serpien1.gif";
                    enemigo6_imagen2.src = "imagenes/serpien2.gif";
                 }
                //...y si se deben representar los quintos enemigos:
                else if (enemigos_nivel == 5)
                 {
                    //Se representan las mariquitas:
                    enemigo1_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo1_imagen2.src = "imagenes/mariqui2.gif";
                    enemigo2_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo2_imagen2.src = "imagenes/mariqui2.gif";
                    enemigo3_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo3_imagen2.src = "imagenes/mariqui2.gif";
                    enemigo4_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo4_imagen2.src = "imagenes/mariqui2.gif";
                    enemigo5_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo5_imagen2.src = "imagenes/mariqui2.gif";
                    enemigo6_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo6_imagen2.src = "imagenes/mariqui2.gif";
                 }
                //...y si se deben representar los sextos enemigos:
                else if (enemigos_nivel == 6)
                 {
                    //Se representan los osos panda:
                    enemigo1_imagen1.src = "imagenes/osito1.gif";
                    enemigo1_imagen2.src = "imagenes/osito2.gif";
                    enemigo2_imagen1.src = "imagenes/osito1.gif";
                    enemigo2_imagen2.src = "imagenes/osito2.gif";
                    enemigo3_imagen1.src = "imagenes/osito1.gif";
                    enemigo3_imagen2.src = "imagenes/osito2.gif";
                    enemigo4_imagen1.src = "imagenes/osito1.gif";
                    enemigo4_imagen2.src = "imagenes/osito2.gif";
                    enemigo5_imagen1.src = "imagenes/osito1.gif";
                    enemigo5_imagen2.src = "imagenes/osito2.gif";
                    enemigo6_imagen1.src = "imagenes/osito1.gif";
                    enemigo6_imagen2.src = "imagenes/osito2.gif";
                 }
                //...y si se deben representar todos los enemigos (septima opcion):
                else if (enemigos_nivel == 7)
                 {
                    //Se representan todos juntos:
                    enemigo1_imagen1.src = "imagenes/mosca1.gif";
                    enemigo1_imagen2.src = "imagenes/mosca2.gif";
                    enemigo2_imagen1.src = "imagenes/murci1.gif";
                    enemigo2_imagen2.src = "imagenes/murci2.gif";
                    enemigo3_imagen1.src = "imagenes/cerdito1.gif";
                    enemigo3_imagen2.src = "imagenes/cerdito2.gif";
                    enemigo4_imagen1.src = "imagenes/serpien1.gif";
                    enemigo4_imagen2.src = "imagenes/serpien2.gif";
                    enemigo5_imagen1.src = "imagenes/mariqui1.gif";
                    enemigo5_imagen2.src = "imagenes/mariqui2.gif";
                    enemigo6_imagen1.src = "imagenes/osito1.gif";
                    enemigo6_imagen2.src = "imagenes/osito2.gif";
                 }
                else
                 {
                    //Setear los enemigos por defecto (los primeros):
                    enemigo1_imagen1.src = "imagenes/mosca1.gif";
                    enemigo1_imagen2.src = "imagenes/mosca2.gif";
                    enemigo2_imagen1.src = "imagenes/mosca1.gif";
                    enemigo2_imagen2.src = "imagenes/mosca2.gif";
                    enemigo3_imagen1.src = "imagenes/mosca1.gif";
                    enemigo3_imagen2.src = "imagenes/mosca2.gif";
                    enemigo4_imagen1.src = "imagenes/mosca1.gif";
                    enemigo4_imagen2.src = "imagenes/mosca2.gif";
                    enemigo5_imagen1.src = "imagenes/mosca1.gif";
                    enemigo5_imagen2.src = "imagenes/mosca2.gif";
                    enemigo6_imagen1.src = "imagenes/mosca1.gif";
                    enemigo6_imagen2.src = "imagenes/mosca2.gif";
                 }

                //Muestra la barra de estado con la nueva informacion:
                actualizar_barra_estado();

                //Iniciar el juego otra vez, con los nuevos parametros:
                posicionar_personajes();
             }

            //Funcion que representa la informacion (vidas, nivel y puntuacion):
            function actualizar_barra_estado()
             {
                //Si las vidas son 0 o menos, se representa Game Over:
                if (vidas < 0) { document.getElementById("estado").innerHTML = "&nbsp; Game Over | Level: "+nivel+" | Score: "+puntuacion; }
                //Si no se representa normalmente, con el numero de vidas:
                else { document.getElementById("estado").innerHTML = "&nbsp; Lives: "+vidas+" | Level: "+nivel+" | Score: "+puntuacion; }
             }

            //Funcion que ocurre al pulsar una tecla:
            function tecla_pulsada(e, evento_actual)
             {
               
                //Si el primer evento esta vacio, se le introduce como valor el evento actual (el que ha llamado a esta funcion):
                if (primer_evento == "") { primer_evento = evento_actual; }
                //Si el primer evento no es igual al evento actual (el que ha llamado a esta funcion), se vacia el primer evento (para que a la proxima llamada entre en la funcion) y se sale de la funcion:
                if (primer_evento != evento_actual) { primer_evento = ""; return; }

                //Si esta el modo Dios activado, sale de la funcion (para que no pueda moverse):
                if (modo_dios) { return; }

                //Capturamos la tacla pulsada, segun navegador:
                if (e.keyCode) { var unicode = e.keyCode; }
                else if (event.keyCode) { var unicode = event.keyCode; }
                else if (window.Event && e.which) { var unicode = e.which; }
                else { var unicode = 40; } //Si no existe, por defecto se utiliza la flecha hacia abajo.

                //Definimos las variables de posicion (X e Y) del personaje:
                var posicion_x = parseInt(document.getElementById('personaje').style.left);
                var posicion_y = parseInt(document.getElementById('personaje').style.top);

                //Si el codigo es 37, se pulso la fecha hacia la izquierda:
                if (unicode == 37)
                 {
                    //Se mueve el personaje 10 pixels hacia la izquierda:
                    posicion_x -= 10;
                    //Se define la variable para que la imagen se cambie, ya que ha habido movimiento:
                    cambiar_imagen = true;
                 }

                //Si el codigo es 39, se pulso la fecha hacia la derecha:
                if (unicode == 39)
                 {
                    //Se mueve el personaje 10 pixels hacia la derecha:
                    posicion_x += 10;
                    //Se define la variable para que la imagen se cambie, ya que ha habido movimiento:
                    cambiar_imagen = true;
                 }
                                 
                //Si el codigo es 38, se pulso la fecha hacia arriba:
                if (unicode == 38)
                 {
                    //Se mueve el personaje 10 pixels hacia arriba:
                    posicion_y -= 10;
                    //Se define la variable para que la imagen se cambie, ya que ha habido movimiento:
                    cambiar_imagen = true;
                 }

                //Si el codigo es 40, se pulso la fecha hacia abajo:
                if (unicode == 40)
                 {
                    //Se mueve el personaje 10 pixels hacia abajo:
                    posicion_y += 10;
                    //Se define la variable para que la imagen se cambie, ya que ha habido movimiento:
                    cambiar_imagen = true;
                 }

                //Codigos de teclas de disparo: 17 (ctrl), 16 (shift), 32 (space), 13 (return), 45 (insert), 96 (0), 190 (.).
                //Si el codigo es una de las teclas de disparo, se llama a la funcion de disparar:
                if (unicode == 17 || unicode == 16 || unicode == 32 || unicode == 13 || unicode == 45 || unicode == 96 || unicode == 190)
                 {
                    //Se llama a la funcion de disparar:
                    disparar();
                 }

                //Se mueve el personaje:
                mover_personaje(posicion_x, posicion_y);
               
                //Se alterna la imagen del personaje:
                alternar_imagen();

                //Finaliza la funcion:
                return true;
             }
        
            //Funcion que mueve el personaje:    
            function mover_personaje (posicion_x, posicion_y)
             {
                //Calcula que la nueva posicion de X (horizontal) no sobrepase los 460 (500 - 40) ni los 0 pixels:
                if (posicion_x > 460) { document.getElementById('personaje').style.left = 460 + "px"; cambiar_imagen = false; } //La posicion sobrepasa los 460 pixels, y se situa en los 460. No se cambia la imagen (no puede haber movimiento si se encuentra en el borde).
                else if (posicion_x < 0) { document.getElementById('personaje').style.left = 0 + "px"; cambiar_imagen = false; } //La posicion es menor a 0 pixels, y se situa en los 0. No se cambia la imagen (no puede haber movimiento si se encuentra en el borde).
                else { document.getElementById('personaje').style.left = posicion_x + "px"; } //Se situa en la nueva posicion.

                //Calcula que la nueva posicion de Y (vertical) no sobrepase los 460 (500 - 40) ni los 0 pixels:
                if (posicion_y > 460) { document.getElementById('personaje').style.top = 460 + "px"; cambiar_imagen = false; } //La posicion sobrepasa los 460 pixels, y se situa en los 460. No se cambia la imagen (no puede haber movimiento si se encuentra en el borde).
                else if (posicion_y < 0) { document.getElementById('personaje').style.top = 0 + "px"; cambiar_imagen = false; } //La posicion es menor a 0 pixels, y se situa en los 0. No se cambia la imagen (no puede haber movimiento si se encuentra en el borde).
                else { document.getElementById('personaje').style.top = posicion_y + "px"; } //Se situa en la nueva posicion.
             }
            
            //Funcion que alterna la imagen del personaje:
            function alternar_imagen ()
             {
                //Se cambia la imagen a mostrar:
                if (document.images && cambiar_imagen)
                 {
                    //Si la imagen actual es la personaje_imagen1, se cambia a personaje_imagen2:
                    if (document.images["personaje_imagen"].src == personaje_imagen1.src)
                     {
                        //A los 100 milisegundos, se cambia a la personaje_imagen2:
                        setTimeout("document.images['personaje_imagen'].src = personaje_imagen2.src;", 100);
                        //A los 200 milisegundos (100 despues), se cambia a la personaje_imagen1:
                        setTimeout("document.images['personaje_imagen'].src = personaje_imagen1.src;", 200);
                     }
                    //...Pero si la imagen actual es la personaje_imagen2, se cambia a personaje_imagen1:
                    else if (document.images["personaje_imagen"].src == personaje_imagen2.src)
                     {
                        //A los 100 milisegundos, se cambia a la personaje_imagen1:
                        setTimeout("document.images['personaje_imagen'].src = personaje_imagen1.src;", 100);
                        //A los 200 milisegundos (100 despues), se cambia a la personaje_imagen2:
                        setTimeout("document.images['personaje_imagen'].src = personaje_imagen2.src;", 200);
                     }
                    //Se vuelve a setear la variable de cambiar imagen como estaba al inicio:
                    cambiar_imagen = false;
                 } //Fin de cambiar imagen a mostrar.
             }

            //-->
        </script>
    </head>
    <body onLoad="javascript:iniciar_juego();" onKeyPress="javascript:tecla_pulsada(event, 'onkeypress');" onKeyDown="javascript:tecla_pulsada(event, 'onkeydown');" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#eeeeee">
        <!-- Se representa la Zona de Juego: -->
        <div style="left:20px; top:20px; width:500px; height:500px; background:#0000aa; color:#ffffff; position:absolute; border:0px; padding:0px; z-index:1;">
            <!-- Se representan las Nubes: -->
            <div style="left:0px; top:0px; width:500px; height:120px; background-image:url('imagenes/nubes.gif'); color:#ffffff; position:absolute; padding:0px; border:0px; z-index:2;">
                <!-- Se representa el Sol: -->
                <div style="left:420px; top:0px; width:40px; height:40px; position:relative; background:transparent; padding:0px; border:0px; z-index:3; filter:alpha(opacity=80); opacity:0.8; -moz-opacity:0.8;" id="sol">
                    <img src="imagenes/sol.gif" width="80" height="80" hspace="0" vspace="0" name="sol_imagen" style="filter:alpha(opacity=80); opacity:0.8; -moz-opacity:0.8;">
                </div>
                <!-- Fin del Sol. -->
            </div>
            <!-- Fin de las Nubes. -->
            <!-- Se representa el Cesped: -->
            <div style="left:0px; top:460px; width:500; height:40px; background-image:url('imagenes/cesped1.gif'); color:#ffffff; position:absolute; padding:0px; border:0px; z-index:4;" id="cesped1">
            </div>
            <div style="left:0px; top:480px; width:500; height:20px; background-image:url('imagenes/cesped2.gif'); color:#ffffff; position:absolute; padding:0px; border:0px; z-index:8;" id="cesped2">
            </div>
            <!-- Fin del Cesped. -->
            <!-- Se representa la Seta: -->
            <div style="left:450px; top:460px; width:40px; height:40px; background:transparent; color:#ffffff; position:absolute; padding:0px; border:0px; z-index:7;" id="seta">
                <img src="imagenes/seta.gif" width="40" height="40" hspace="0" vspace="0" name="seta_imagen">
            </div>
            <!-- Fin de la Seta. -->
            <!-- Se representan los Disparos -->
            <div style="visibility:hidden; left:252px; top:245px; width:5px; height:15px; position:absolute; border:0px; padding:0px; background:transparent; z-index:13;" id="disparo_1">
                <img src="imagenes/disparo.gif" width="5" height="15" hspace="0" vspace="0" name="disparo1_imagen">
            </div>
            <div style="visibility:hidden; left:252px; top:245px; width:5px; height:15px; position:absolute; border:0px; padding:0px; background:transparent; z-index:14;" id="disparo_2">
                <img src="imagenes/disparo.gif" width="5" height="15" hspace="0" vspace="0" name="disparo2_imagen">
            </div>
            <div style="visibility:hidden; left:252px; top:245px; width:5px; height:15px; position:absolute; border:0px; padding:0px; background:transparent; z-index:15;" id="disparo_3">
                <img src="imagenes/disparo.gif" width="5" height="15" hspace="0" vspace="0" name="disparo3_imagen">
            </div>
            <div style="visibility:hidden; left:252px; top:245px; width:5px; height:15px; position:absolute; border:0px; padding:0px; background:transparent; z-index:16;" id="disparo_4">
                <img src="imagenes/disparo.gif" width="5" height="15" hspace="0" vspace="0" name="disparo4_imagen">
            </div>
            <div style="visibility:hidden; left:252px; top:245px; width:5px; height:15px; position:absolute; border:0px; padding:0px; background:transparent; z-index:17;" id="disparo_5">
                <img src="imagenes/disparo.gif" width="5" height="15" hspace="0" vspace="0" name="disparo5_imagen">
            </div>
            <!-- Fin de los Disparos -->
            <!-- Se representa el Personaje: -->
            <div style="visibility:visible; left:250px; top:250px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:5;" id="personaje">
                <img src="imagenes/rana1.gif" width="40" height="40" hspace="0" vspace="0" name="personaje_imagen">
            </div>
            <!-- Fin del Personaje. -->
            <!-- Se representan los Enemigos: -->
            <div style="visibility:visible; left:120px; top:120px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:6;" id="enemigo1">
                <img src="imagenes/mosca1.gif" width="40" height="40" hspace="0" vspace="0" name="enemigo1_imagen">
            </div>
            <div style="visibility:visible; left:450px; top:120px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:8;" id="enemigo2">
                <img src="imagenes/mosca1.gif" width="40" height="40" hspace="0" vspace="0" name="enemigo2_imagen">
            </div>
            <div style="visibility:visible; left:350px; top:120px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:9;" id="enemigo3">
                <img src="imagenes/mosca1.gif" width="40" height="40" hspace="0" vspace="0" name="enemigo3_imagen">
            </div>
            <div style="visibility:visible; left:450px; top:20px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:10;" id="enemigo4">
                <img src="imagenes/mosca1.gif" width="40" height="40" hspace="0" vspace="0" name="enemigo4_imagen">
            </div>
            <div style="visibility:visible; left:150px; top:50px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:11;" id="enemigo5">
                <img src="imagenes/mosca1.gif" width="40" height="40" hspace="0" vspace="0" name="enemigo5_imagen">
            </div>
            <div style="visibility:visible; left:250px; top:90px; width:40px; height:40px; position:absolute; border:0px; padding:0px; background:transparent; z-index:12;" id="enemigo6">
                <img src="imagenes/mosca1.gif" width="40" height="40" hspace="0" vspace="0" name="enemigo6_imagen">
            </div>
            <!-- Fin de los Enemigos. -->
            <!-- Texto "tu estas aqui": -->
            <div style="visibility:visible; left:310px; top:250px; width:150px; height:20px; position:absolute; border:0px; padding:0px; background:#ff0000; color:#ffffff; text-align:center; line-height:20px; text-decoration:blink; font-weight:bold; font-family:arial; font-size:12px; z-index:20;" id="tu_estas_aqui">
                You are here
            </div>
            <!-- Fin del Texto "tu estas aqui". -->
        </div>
        <!-- Fin de Zona de Juego. -->
        <!-- Barra de Estado: -->
        <div style="visibility:visible; left:20px; top:522px; width:500px; height:20px; position:absolute; border:0px; padding:0px; background:#ff0000; color:#ffff00; text-align:left; line-height:20px; text-decoration:none; font-weight:bold; font-family:arial; font-size:14px; z-index:25;" id="estado">
            &nbsp; Loading parameters...
        </div>
        <!-- Informacion del autor: -->
        <div style="visibility:visible; left:250px; top:524px; width:250px; height:15px; position:absolute; border:0px; padding:0px; background:transparent; color:#ffffff; text-align:right; line-height:15px; text-decoration:none; font-weight:bold; font-family:verdana; font-size:9px; z-index:26;" id="autor">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La Ran&iacute;sima&copy; by Joan Alba Maldonado
        </div>
        <!-- Fin de Informacion del autor. -->
        <!-- Fin de Barra de Estado. -->
        <!-- Informacion: -->
        <div style="left:560px; top:40px; height:0px; position:absolute; border:0px; padding:0px; background:transparent; color:#333333; text-align:left; line-height:20px; text-decoration:none; font-family:verdana; font-size:14px;">
            &copy; <b>La Ran&iacute;sima</b> 0.96a
            <br>
            &nbsp;&nbsp;by <i>Joan Alba Maldonado</i> (<a href="mailto:granvino@granvino.com;">granvino@granvino.com</a>) &nbsp;<sup>(DHTML 100%)</sup>
            <br>
            &nbsp;&nbsp;- Prohibited to publish, reproduce or modify without maintain original
            <br>&nbsp;&nbsp;&nbsp;&nbsp;author's name
            <br>
            &nbsp;&nbsp;<tt>* Use the keyboard arrows to move, and spacebar (also control, shift
            <br>
            &nbsp;&nbsp;  or return) to fire. Under Opera, leave the mouse cursor over game zone.</tt>
            <br>
            &nbsp;&nbsp;<i>Dedicated to Yasmina Llaveria del Castillo</i>
        <!-- Fin de Informacion. -->
        </div>
    </body>
</html>
