<h1>Create task:</h1>
<form action="/task/create" method="post">
    <label for="user">User</label>
    <input type="text" name="user" id="user">
    <label for="email">Email</label>
    <input type="email" name="email" id="email"><br><br>
    <label for="text">Text</label>
    <textarea type="text" name="text" id="text"></textarea><br><br>
    <label for="state">State</label>
    <input type="checkbox" name="state" id="state"><br><br>
    <input type="submit" class="btn btn-primary" value="Save" name="btn">
</form>