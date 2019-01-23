<h1>Update task:</h1>
<form action="/task/update" method="post">
    <input hidden type="text" name="id" id="id" value="<?= $data['id']?>">
    <label for="user">User</label>
    <input readonly type="text" name="user" id="user" value="<?= $data['user']?>">
    <label for="email">Email</label>
    <input readonly type="email" name="email" id="email" value="<?= $data['email']?>"><br><br>
    <label for="text">Text</label>
    <textarea type="text" name="text" id="text"><?= $data['text']?></textarea><br><br>
    <label for="state">State</label>
    <input type="checkbox" name="state" id="state" <?php if ($data['state'] == 1) echo "checked"?>><br><br>
    <input type="submit" value="Save" name="btn">
</form>
