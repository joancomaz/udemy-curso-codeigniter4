<?= view("dashboard/partials/_form-error") ?>

<form action="/movie/update/<?= $movie->id ?>" method="post" enctype="multipart/form-data">

    <?= view("dashboard/movie/_form", [
        'movie' => $movie,   // Esto es opcional, ya que si cargamos la instancia en la parte superior "<?= $movie->id", se carga de manera automática en las vistas posteriores
        'textButton' => 'Actualizar',
        'created' => false,
    ]) ?>

</form>
