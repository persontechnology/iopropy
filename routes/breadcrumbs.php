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

Breadcrumbs::for('comunidadesLista', function ($trail) {
    $trail->parent('home');
    $trail->push('Comunidades', route('comunidadesLista'));
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




// mis asociaciones

Breadcrumbs::for('miAsociaciones', function ($trail) {
    $trail->parent('home');
    $trail->push('Mis asociaciones', route('miAsociaciones'));
});
// mis comunidades
Breadcrumbs::for('miComunidades', function ($trail,$aso) {
    $trail->parent('miAsociaciones');
    $trail->push('Mis comunidades en '.$aso->nombre, route('miComunidades',$aso->id));
});

// propiedades

Breadcrumbs::for('propiedades', function ($trail,$comu) {
    $trail->parent('miComunidades',$comu->asociacion);
    $trail->push('Propiedades en '.$comu->nombre, route('propiedades',$comu->id));
});
Breadcrumbs::for('nuevaPropiedad', function ($trail,$comu) {
    $trail->parent('propiedades',$comu);
    $trail->push('Nueva propiedad en '.$comu->nombre, route('nuevaPropiedad',$comu->id));
});
Breadcrumbs::for('editarPropiedad', function ($trail,$pro) {
    $trail->parent('propiedades',$pro->comunidad);
    $trail->push('Editar propiedad '.$pro->codigo, route('editarPropiedad',$pro->id));
});
Breadcrumbs::for('informacionPropiedad', function ($trail,$pro) {
    $trail->parent('propiedades',$pro->comunidad);
    $trail->push('Información propiedad '.$pro->codigo, route('informacionPropiedad',$pro->id));
});

// propiedeades en federacion

Breadcrumbs::for('propiedadesFed', function ($trail) {
    $trail->parent('home');
    $trail->push('Propiedades', route('propiedadesFed'));
});
Breadcrumbs::for('nuevaPropiedadFed', function ($trail) {
    $trail->parent('propiedadesFed');
    $trail->push('Nueva propiedad', route('nuevaPropiedadFed'));
});
Breadcrumbs::for('editarPropiedadFed', function ($trail,$pro) {
    $trail->parent('propiedadesFed');
    $trail->push('Nueva propiedad', route('editarPropiedadFed',$pro->id));
});
Breadcrumbs::for('informacionPropiedadFed', function ($trail,$pro) {
    $trail->parent('propiedadesFed');
    $trail->push('Actualizar propiedad', route('informacionPropiedadFed',$pro->id));
});



// usuarios
Breadcrumbs::for('usuarios', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios'));
});

Breadcrumbs::for('nuevoUsuario', function ($trail) {
    $trail->parent('usuarios');
    $trail->push('Nuevo usuario', route('nuevoUsuario'));
});
Breadcrumbs::for('editarUsuario', function ($trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Editar usuario', route('editarUsuario',$user->id));
});


// ventas
Breadcrumbs::for('ventas', function ($trail) {
    $trail->parent('home');
    $trail->push('Ventas', route('ventas'));
});
Breadcrumbs::for('nuevoVenta', function ($trail) {
    $trail->parent('ventas');
    $trail->push('Nueva venta', route('nuevoVenta'));
});
Breadcrumbs::for('infoVenta', function ($trail,$venta) {
    $trail->parent('ventas');
    $trail->push('Venta '.$venta->numero, route('infoVenta',$venta->id));
});

// estaticas

Breadcrumbs::for('nosotros', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Acerca de nosotros', route('nosotros'));
});
Breadcrumbs::for('noticias', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Noticias', route('noticias'));
});
Breadcrumbs::for('detalleNoticia', function ($trail,$noticia) {
    $trail->parent('noticias');
    $trail->push('Detalle de la noticia', route('detalleNoticia',$noticia->id));
});

Breadcrumbs::for('contactos', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Contactos', route('contactos'));
});


// noticias
Breadcrumbs::for('noticiasAdmin', function ($trail) {
    $trail->parent('home');
    $trail->push('Noticias', route('noticiasAdmin'));
});

Breadcrumbs::for('noticiaNuevo', function ($trail) {
    $trail->parent('noticiasAdmin');
    $trail->push('Nueva noticia', route('noticiaNuevo'));
});


Breadcrumbs::for('editarNoticia', function ($trail,$noticia) {
    $trail->parent('noticiasAdmin');
    $trail->push('Editar noticia', route('editarNoticia',$noticia->id));
});

// soporte

Breadcrumbs::for('soporte', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Soporte', route('soporte'));
});
