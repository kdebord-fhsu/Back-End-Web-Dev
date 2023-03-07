<?php include('view/header.php');?>

<section id="list" class="list">
    <header>
        <h1>Assignments</h1>
        <form action="." method="get" id="list_header_select" class="list_header_select"></form>
            <input type="hidden" name="action" value="list_assignments">
            <select>
                <option value="0">View All</option>
                <?php foreach($courses as $course ) : ?>
                    <?php if ($course_id == $course['course_ID']) { ?>
                    <option value="<?= $course['course_ID']?>"> selected>
                    <?php} else { ?>
                    <option value="<?= $course['course_ID']?>">
                    <?php} ?>
                    <?= $course['courseName'] ?>
                    </option>
                    <?php endforeach; ?>
            </select>
            <button> GO </button>
            </form>
    </header>

    <?php if($assignments) { ?>
     <?php  foreach($assignments as $assignment)?>
        <div class="list__row">
            <div class="list__item"></div>
            <p><?= $assignment['coursename'] ?></p>
            <p><?= $assignment['Description'] ?></p>
           </div>
           <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_assignment">
                <input type="hidden" name="assignment_id" value="<?= $assignment['ID']?>">
                <buttton>X</button>
            </form>
           </div>
    <?php endforeach;?>
    <?php} else{?>

        <?php } ?>
    <br>
    <?php if($course_id) {?>
        <p>No assignments exists for this course yet</P>
        <?php} else {?>
            <p>No assignments exit yet</p>
            <?php }?>
</section>

<section id="add" class="add">
        <h2>Add Assigment</h2>
        <form action="." method="post" id="add__form" class="add__form"></form>
            <input type="hidden" name="action" value="add_assignment">
            <div class="add__inputs">
            <label>Course:</label>
            <select name="course_id" required>
                <option value="">Please Select the course</option>
                <?php foreach($courses as $course) : ?>
                    <option value="<?= $course['courseID']?>">
                    <?= $course['courseName']?>
                </option>
            </select>
            <label>Description</label>
            <input type="text" name="description" maxlength="120" placeholder="Assignment Description" required>
            </div>
            <div class="add_addItem">
                <button>Add Assignment</button>
            </div>

</section>

<p><a href=""></a></p>

<?php include('view/footer.php');?>