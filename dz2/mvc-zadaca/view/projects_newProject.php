<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<hr>
<form  action="index.php?rt=projects/createNewProject" method="post">

Project title: <input type="text" name="projectName" >
<br>
Project description: <br>
<textarea name="projectDescription" rows="8" cols="80">
</textarea>
<br>
Target project members: <input type="number" name="projectNumber" >
<hr>

<input type="submit" name="create" value="Create Project">

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
