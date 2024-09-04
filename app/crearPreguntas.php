<?php

$texto = '1 El ruido en el lugar donde trabajo es molesto
2 En el lugar donde trabajo hace mucho frío
3 En el lugar donde trabajo hace mucho calor
4 El aire en el lugar donde trabajo es fresco y agradable
5 La luz del sitio donde trabajo es agradable
6 El espacio donde trabajo es cómodo
7 En mi trabajo me preocupa estar expuesto a sustancias químicas que afecten mi salud
8 Mi trabajo me exige hacer mucho esfuerzo físico
9 Los equipos o herramientas con los que trabajo son cómodos
10 En mi trabajo me preocupa estar expuesto a microbios, animales o plantas que afecten mi salud
11 Me preocupa accidentarme en mi trabajo
12 El lugar donde trabajo es limpio y ordenado
13 Por la cantidad de trabajo que tengo debo quedarme tiempo adicional
14 Me alcanza el tiempo de trabajo para tener al día mis deberes
15 Por la cantidad de trabajo que tengo debo trabajar sin parar
16 Mi trabajo me exige hacer mucho esfuerzo mental
17 Mi trabajo me exige estar muy concentrado
18 Mi trabajo me exige memorizar mucha información
19 En mi trabajo tengo que hacer cálculos matemáticos
20 Mi trabajo requiere que me fije en pequeños detalles
21 Trabajo en horario de noche
22 En mi trabajo es posible tomar pausas para descansar
23 Mi trabajo me exige laborar en días de descanso, festivos o fines de semana
24 En mi trabajo puedo tomar fines de semana o días de descanso al mes
25 Cuando estoy en casa sigo pensando en el trabajo
26 Discuto con mi familia o amigos por causa de mi trabajo
27 Debo atender asuntos de trabajo cuando estoy en casa
28 Por mi trabajo el tiempo que paso con mi familia y amigos es muy poco
29 En mi trabajo puedo hacer cosas nuevas
30 Mi trabajo me permite desarrollar mis habilidades
31 Mi trabajo me permite aplicar mis conocimientos
32 Mi trabajo me permite aprender nuevas cosas
33 Puedo tomar pausas cuando las necesito
34 Puedo decidir cuánto trabajo hago en el día
35 Puedo decidir la velocidad a la que trabajo
36 Puedo cambiar el orden de las actividades en mi trabajo
37 Puedo parar un momento mi trabajo para atender algún asunto personal
38 Me explican claramente los cambios que ocurren en mi trabajo
39 Puedo dar sugerencias sobre los cambios que ocurren en mi trabajo
40 Cuando se presentan cambios en mi trabajo se tienen en cuenta mis ideas y sugerencias
41 Me informan con claridad cuáles son mis funciones
42 Me informan cuáles son las decisiones que puedo tomar en mi trabajo
43 Me explican claramente los resultados que debo lograr en mi trabajo
44 Me explican claramente los objetivos de mi trabajo
45 Me informan claramente con quien puedo resolver los asuntos de trabajo
46 La empresa me permite asistir a capacitaciones relacionadas con mi trabajo
47 Recibo capacitación útil para hacer mi trabajo
48 Recibo capacitación que me ayuda a hacer mejor mi trabajo
49 Mi jefe ayuda a organizar mejor el trabajo
50 Mi jefe tiene en cuenta mis puntos de vista y opiniones
51 Mi jefe me anima para hacer mejor mi trabajo
52 Mi jefe distribuye las tareas de forma que me facilita el trabajo
53 Mi jefe me comunica a tiempo la información relacionada con el trabajo
54 La orientación que me da mi jefe me ayuda a hacer mejor el trabajo
55 Mi jefe me ayuda a progresar en el trabajo
56 Mi jefe me ayuda a sentirme bien en el trabajo
57 Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo
58 Mi jefe me trata con respeto
59 Siento que puedo confiar en mi jefe
60 Mi jefe me escucha cuando tengo problemas de trabajo
61 Mi jefe me brinda su apoyo cuando lo necesito
62 Me agrada el ambiente de mi grupo de trabajo
63 En mi grupo de trabajo me tratan de forma respetuosa
64 Siento que puedo confiar en mis compañeros de trabajo
65 Me siento a gusto con mis compañeros de trabajo
66 En mi grupo de trabajo algunas personas me maltratan
67 Entre compañeros solucionamos los problemas de forma respetuosa
68 Mi grupo de trabajo es muy unido
69 Cuando tenemos que realizar trabajo de grupo los compañeros colaboran
70 Es fácil poner de acuerdo al grupo para hacer el trabajo
71 Mis compañeros de trabajo me ayudan cuando tengo dificultades
72 En mi trabajo las personas nos apoyamos unos a otros
73 Algunos compañeros de trabajo me escuchan cuando tengo problemas
74 Me informan sobre lo que hago bien en mi trabajo
75 Me informan sobre lo que debo mejorar en mi trabajo
76 La información que recibo sobre mi rendimiento en el trabajo es clara
77 La forma como evalúan mi trabajo en la empresa me ayuda a mejorar
78 Me informan a tiempo sobre lo que debo mejorar en el trabajo
79 En la empresa me pagan a tiempo mi salario
80 El pago que recibo es el que me ofreció la empresa
81 El pago que recibo es el que merezco por el trabajo que realizo
82 En mi trabajo tengo posibilidades de progresar
83 Las personas que hacen bien el trabajo pueden progresar en la empresa
84 La empresa se preocupa por el bienestar de los trabajadores
85 Mi trabajo en la empresa es estable
86 El trabajo que hago me hace sentir bien
87 Siento orgullo de trabajar en esta empresa
88 Hablo bien de la empresa con otras personas
89 Atiendo clientes o usuarios muy enojados
90 Atiendo clientes o usuarios muy preocupados
91 Atiendo clientes o usuarios muy tristes
92 Mi trabajo me exige atender personas muy enfermas
93 Mi trabajo me exige atender personas muy necesitadas de ayuda
94 Atiendo clientes o usuarios que me maltratan
95 Mi trabajo me exige atender situaciones de violencia
96 Mi trabajo me exige atender situaciones muy tristes o dolorosas
97 Puedo expresar tristeza o enojo frente a las personas que atiendo';

$texto = rawurlencode($texto);

$texto = rawurldecode(str_replace("%0D%0A", "/", $texto));

$array = explode('/', $texto);

for ($i = 0; $i < 98; $i++) {
    echo '<div class="col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label>'.$array[$i].'</label>
                                                                <div class="radio inline">
                                                                    <label>
                                                                        <input type="radio" name="preg'.($i+1).'" value="siempre" checked="">
                                                                        Siempre
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="preg'.($i+1).'" value="casi siempre">
                                                                        Casi Siempre
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="preg'.($i+1).'" value="a veces">
                                                                        A Veces
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="preg'.($i+1).'" value="casi nunca">
                                                                        Casi Nunca
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" name="preg'.($i+1).'" value="nunca">
                                                                        Nunca
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ';
}
