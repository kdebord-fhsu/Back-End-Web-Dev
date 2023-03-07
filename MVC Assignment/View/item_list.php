<?php include('View/header.php')?>
<?php if($courses) {?>
    <section id="list" class ="list">
        <header>
            <h1>Course List</h1>
    </header>
    <?php foreach($courses as $course) : ?>
            <div class="list__row">
                <p><?=$course['courseName']?></p>
            </div>
            <div class="list__remove">
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_course">
                    <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">
                    <button>X</button>
            </div>
    <?php endforeach; ?>
<?php } else {  ?> 
       <p>No catagories exist yet</p>
<?php }     ?>

<section>
    <h2>Add Course</h2>
    <form action="." method="post" id="add_form" class="add_form">
        <input type="hidden" name="action" value="add_course">
        <div class="add_inputs">
            <label>Course Name:</label>
            <input type="text" name="course_name" maxlength="30" placeholder="Course Name" autofocus required>
        </div>
        <div class="add__additem">
            <button class="add-button">Add Course</button>
        </div>
</form>
</section>
<p><a href=".?action=list_assignments">View/Edit Assignments</a></p>
<?php include('view/footer.php')?>
