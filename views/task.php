<h1>Tasks</h1>
<p>
    <strong><a href="/task/create">Create</a></strong>
    <?php if (isset($data) && $data != false) {
        $pages = array_pop($data);

        $visual_page_count = 5;
        $page_radius = 2;
        $start = 1;
        if (isset($_GET['page'])) {

            $curent_page = $_GET['page'];
            $start = $curent_page - $page_radius;
        }
    ?>

<form action="/" method="post">
    <div class="form-group">
        <label for="sel1">Sort by</label>
        <select class="form-control" id="sel1" name="orderBy">
            <option>Email</option>
            <option>State</option>
        </select>
        <select class="form-control" id="sel2" name="sort">
            <option>ASC</option>
            <option>DESC</option>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Sort"><br><br>
</form>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">User</th>
        <th scope="col">Email</th>
        <th scope="col">Text</th>
        <th scope="col">State</th>
        <?php if (isset($_SESSION['admin'])) : ?>
            <th scope="col" colspan="2">Action</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $key => $task) : ?>
        <tr>
            <td><?= $task["id"] ?></td>
            <td><?= $task["user"] ?></td>
            <td><?= $task["email"] ?></td>
            <td><?= $task["text"] ?></td>
            <td><?= $task["state"] ?></td>
            <?php if (isset($_SESSION['admin'])) : ?>
                <td><a href="/task/update?tid=<?= $task["id"] ?>">Edit</a></td>
                <td><a href="/task/delete?tid=<?= $task["id"] ?>">Delete</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
if ($pages > $visual_page_count) {
    echo "<a href='/task/index?page=1'> First </a>";
    if ($start < 1) {
        $start = 1;

    }
    for ($i = 1; $i <= $visual_page_count; $i++) {
        if ($start <= $pages) {
            echo "<a href='/task/index?page=$start'> $start </a>";
            $start++;
        }
    }

    echo "<a href='/task/index?page=$pages'> Last </a>";

} else {
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='/task/index?page=$i'> $i </a>";
    }
}
?>
<?php } ?>
</p>
