<?php

// Inicio
Breadcrumbs::for('inicio', function ($trail) {
    $trail->push('Inicio', url('/'));
});

// login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Ingresar', route('login'));
});

// password reset
Breadcrumbs::for('restablecerPasword', function ($trail) {
    $trail->parent('login');
    $trail->push('Restablecer contraseña', route('password.request'));
});

/*nuevo password*/
Breadcrumbs::for('cambiarPasword', function ($trail,$token) {
    $trail->parent('login');
    $trail->push('Restablecer contraseña', route('password.reset',$token));
});

/*home*/
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Inicio', route('home'));
});

/*cantones*/
Breadcrumbs::for('cantones', function ($trail) {
	$trail->parent('home');
    $trail->push('Cantones', route('cantones'));
});

/*parroquias*/

Breadcrumbs::for('parroquias', function ($trail,$canton) {
    $trail->parent('cantones');
    $trail->push('Parroquias en '.$canton->nombre, route('parroquias',$canton->id));
});
/*lista de parroquias*/
Breadcrumbs::for('parroquiasLista', function ($trail) {
    $trail->parent('home');
    $trail->push('Parroquias', route('parroquiasLista'));
});


/*comunidades*/

Breadcrumbs::for('comunidades', function ($trail,$parroquia) {
    $trail->parent('parroquias',$parroquia->canton);
    $trail->push('Comunidades en '.$parroquia->nombre, route('comunidades',$parroquia->id));
});
Breadcrumbs::for('agregarComunidad', function ($trail,$parroquia) {
    $trail->parent('comunidades',$parroquia);
    $trail->push('Agregar comunidad', route('agregarComunidad',$parroquia->id));
});
Breadcrumbs::for('editarComunidad', function ($trail,$comunidad) {
    $trail->parent('comunidades',$comunidad->parroquia);
    $trail->push('Actualizar comunidad, '.$comunidad->nombre, route('editarComunidad',$comunidad->id));
});


Breadcrumbs::for('comunidadListaEnParroquia', function ($trail,$parroquia) {
    $trail->parent('parroquiasLista');
    $trail->push('Comunidades en '.$parroquia->nombre, route('comunidadListaEnParroquia',$parroquia->id));
});


/*asociaciones*/
Breadcrumbs::for('asociaciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Asociaciones', route('asociaciones'));
});
Breadcrumbs::for('nuevaAsociacion', function ($trail) {
    $trail->parent('asociaciones');
    $trail->push('Nueva asociación', route('nuevaAsociacion'));
});

Breadcrumbs::for('editarAsociacion', function ($trail,$asociacion) {
    $trail->parent('asociaciones');
    $trail->push('Actualizar asociación '.$asociacion->nombre, route('editarAsociacion',$asociacion->id));
});
Breadcrumbs::for('autoridadesAsociacion', function ($trail,$aso) {
    $trail->parent('asociaciones');
    $trail->push('Autoridades en '.$aso->nombre, route('autoridadesAsociacion',$aso->id));
});



/*autoridades*/
Breadcrumbs::for('autoridades', function ($trail) {
    $trail->parent('home');
    $trail->push('Autoridades', route('autoridades'));
});

Breadcrumbs::for('editarAutoridad', function ($trail,$user) {
    $trail->parent('autoridades');
    $trail->push('Editar '.$user->email, route('editarAutoridad',$user->id));
});



