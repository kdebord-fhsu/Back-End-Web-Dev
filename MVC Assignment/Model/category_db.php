<?php
function get_categories(){
    global $db;
    $query = 'SELECT * FROM categories ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;
}

function get_todoitem(){
    if(!$course_id){
        return "All Course";
    }
    global $db;
    $query = 'SELECT * FROM todoitems WHERE courseID = :course_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $categories = $statement->fetch();
    $statement->closeCursor();
    $course_name = $course['course_name'];
    return $course_name;
}

function delete_course($course_id){
    global $db;
    $query = 'DELETE FROM courses WHERE courseID = :course_id';
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_course($course_name){
    global $db;
    $query = 'INSERT INTO courses ( courseName ) VALUES (:course_name)';
    $statement->bindValue(':course_id', $course_name);
    $statement->execute();
    $statement->closeCursor();
}
?>