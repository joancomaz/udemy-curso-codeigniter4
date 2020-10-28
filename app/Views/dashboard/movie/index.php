<a href="/movie/new">Crear</a>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movies as $key => $m) : ?>
        <tr>
            <td><?= $m->id ?></td>
            <td><?= $m->title ?></td>
            <td><?= $m->category_name ?></td>
            <td>
                <form action="/movie/delete/<?= $m->id ?>" method="post">
                    <input type="submit" name="submit" value="Borrar" />
                </form>
                <a href="/movie/<?= $m->id ?>/edit">Editar</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $pager->links() ?>