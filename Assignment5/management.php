<h2>Role Management</h2>
<ul>
    <li>Admin</li>
    <li>Manager</li>
    <li>User</li>
    <!-- List existing roles here -->
</ul>

<!-- Create a new role form -->
<h3>Create New Role</h3>
<form action="create_role.php" method="post">
    <input type="text" name="new_role" placeholder="New Role Name" required>
    <input type="submit" value="Create Role">
</form>

<!-- Edit existing role form -->
<h3>Edit Role</h3>
<form action="edit_role.php" method="post">
    <input type="text" name="edit_role" placeholder="Role to Edit" required>
    <input type="text" name="new_name" placeholder="New Role Name" required>
    <input type="submit" value="Edit Role">
</form>

<!-- Delete existing role form -->
<h3>Delete Role</h3>
<form action="delete_role.php" method="post">
    <input type="text" name="delete_role" placeholder="Role to Delete" required>
    <input type="submit" value="Delete Role">
</form>