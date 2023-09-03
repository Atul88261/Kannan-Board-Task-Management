<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your website description goes here. This should include keywords like 'kanban board,' 'task management,' 'todo list,' 'best todo list,' 'todo list template,' and 'kanban board template.'">
    <meta name="keywords" content="kanban board, task management, todo list, best todo list, todo list template, kanban board template, project management, productivity, task tracker, task organizer, team collaboration, agile methodology, project planning, time management, online task manager, task scheduler, project planner, task app, task software, project tracking, task dashboard, task planner, task list, productivity tools, work management, task management system, task manager app, project management software, task management app, kanban software, task management tool, online task list, task board, task tracker app, task manager tool, project manager, team task management, todo list app, task management website, task management platform, project management app, team task manager, task management application, online task organizer, task management solution, task management program, project management tool, project management system, task management software, task management system software, best task management, top task management, task management online, task management for teams, kanban board software, kanban board tool, kanban board online">
    <meta name="author" content="Your Name">
    <meta name="robots" content="index, follow">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.1/css/all.min.css" integrity="sha384-xjw8IiGw9ac2USv93Dw5d0z/DMwdb5pJS04tw1Hb/xB/bfa36WSqb4zL0p9A5I5AeB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    
    <title>PHP CRUD - Kanban Board, Task Management, Todo List</title>
</head>

<body>
    <div class="main">
    <div class="form">
<?php
if(isset($_GET['update'])){
    $id=$_GET['update'];
    $q = "SELECT * FROM tasks WHERE id=$id";
    $r = mysqli_query($db,$q);
    $d = mysqli_fetch_array($r);
    ?>
<form method="post" action="update.php">
    <input type="hidden" name='id' value="<?=$d['id']?>">
    <input type="text" name="task_title" value="<?=$d['task_title']?>" class="input" placeholder="Title">
    <input type="text" name="task_description" value="<?=$d['task_description']?>" class="input" placeholder="Description">
    <input type="submit" name="update" class="long-input add-button" value="UPDATE RECORD">
    </form>
    <?php
}else{
    ?>
<form method="post" action="add.php">
    <input type="text" name="task_title" class="input" placeholder="Title">
    <input type="text" name="task_description" class="input" placeholder="Description">
    <input type="submit" name="add" class="long-input add-button" value="ADD TO DATABASE">
    </form>
    <?php
}
?>
    </div>

    <form action="" method="POST">
        <div class="button-container">
            <input type="button" class="button" name="all" value="All" onclick="allFunction()">
            <input type="button" class="button" name="todo" value="Todo" onclick="todoFunction()">
            <input type="button" class="button" name="doing" value="Doing" onclick="doingFunction()">
            <input type="button" class="button" name="done" value="Done" onclick="doneFunction()">
        </div>
    </form>

            <!-- All section starts here -->

        <div class="record" id="all">
            <?php
                $readQuery = "SELECT * FROM tasks ORDER BY id DESC";
                $readRun = mysqli_query($db,$readQuery);
                while($data = mysqli_fetch_array($readRun))
                {
            ?>
            <div class="record-item">
                <div>
                    <span class=title><?=$data['task_title']?></span><br><br>
                    <span class=description><?=$data['task_description']?></span><hr>
                </div>
                <div>
                    <table>
                        <tr>
                            <th><span class=time><b>Started at:</b></span></th>
                            <th><span class=time>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['task_created']?></span</th>
                        </tr>
                        <tr>
                            <th><span class=time><b>Completed at:</b></span></th>
                            <th>    <?php
                if($data['task_status']=="done")
                {
                ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=time><?=$data['task_completed']?></span>
                <?php
                    }
                ?></th>
                        </tr>
                    </table>
                <br>

                <?php
                    if($data['task_status']=="todo")
                    {
                ?>
                        <p style="color: #ff0000; border-radius: 10px; background-color: #f0f0f0;">
                            To Do
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Doing" name="doing" class="doing">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="doing")
                    {
                ?>
                        <p style="color: orange; border-radius: 10px; background-color: #f0f0f0;">
                            Doing
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="done")
                    {
                ?>
                        <p style="color: green; border-radius: 10px; background-color: #f0f0f0;">
                            Done
                        </p>
                <?php
                    }
                ?>

                </div>
                <div class=edit_and_delete>
                    <a href="index.php?update=<?=$data['id']?>">
                    <button class="menu-btn edit-btn">Edit</button>
                    </a>
                    <a href="delete.php?delete=<?=$data['id']?>">
                        <button class="menu-btn delete-btn">Delete</button>
                    </a>
                </div>
            </div> 
            <?php
                }
            ?>
            </div>
        </div>
                <!-- All section ends here -->
                
                <!-- TODO section starts here -->

        <div class="record" id="todo">
            <?php
                $readQuery = "SELECT * FROM tasks WHERE task_status='todo'";
                $readRun = mysqli_query($db,$readQuery);
                while($data = mysqli_fetch_array($readRun))
                {
            ?>
            <div class="record-item">
                <div>
                    <span class=title><?=$data['task_title']?></span><br><br>
                    <span class=description><?=$data['task_description']?></span><hr>
                </div>
                <div>
                    <table>
                        <tr>
                            <th><span class=time><b>Started at:</b></span></th>
                            <th><span class=time>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['task_created']?></span</th>
                        </tr>
                        <tr>
                            <th><span class=time><b>Completed at:</b></span></th>
                            <th>    <?php
                if($data['task_status']=="done")
                {
                ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=time><?=$data['task_completed']?></span>
                <?php
                    }
                ?></th>
                        </tr>
                    </table>
                <br>

                <?php
                    if($data['task_status']=="todo")
                    {
                ?>
                        <p style="color: #ff0000; border-radius: 10px; background-color: #f0f0f0;">
                            To Do
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Doing" name="doing" class="doing">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="doing")
                    {
                ?>
                        <p style="color: orange; border-radius: 10px; background-color: #f0f0f0;">
                            Doing
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="done")
                    {
                ?>
                        <p style="color: green; border-radius: 10px; background-color: #f0f0f0;">
                            Done
                        </p>
                <?php
                    }
                ?>

                </div>
                <div class=edit_and_delete>
                    <a href="index.php?update=<?=$data['id']?>">
                    <button class="menu-btn edit-btn">Edit</button>
                    </a>
                    <a href="delete.php?delete=<?=$data['id']?>">
                        <button class="menu-btn delete-btn">Delete</button>
                    </a>
                </div>
            </div> 
            <?php
                }
            ?>
            </div>
        </div>
                <!-- TODO section ends here -->

            <!-- Doing section starts here -->

        <div class="record" id="doing">
            <?php
                $readQuery = "SELECT * FROM tasks WHERE task_status='doing'";
                $readRun = mysqli_query($db,$readQuery);
                while($data = mysqli_fetch_array($readRun))
                {
            ?>
            <div class="record-item">
                <div>
                    <span class=title><?=$data['task_title']?></span><br><br>
                    <span class=description><?=$data['task_description']?></span><hr>
                </div>
                <div>
                    <table>
                        <tr>
                            <th><span class=time><b>Started at:</b></span></th>
                            <th><span class=time>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['task_created']?></span</th>
                        </tr>
                        <tr>
                            <th><span class=time><b>Completed at:</b></span></th>
                            <th>    <?php
                if($data['task_status']=="done")
                {
                ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=time><?=$data['task_completed']?></span>
                <?php
                    }
                ?></th>
                        </tr>
                    </table>
                <br>

                <?php
                    if($data['task_status']=="todo")
                    {
                ?>
                        <p style="color: #ff0000; border-radius: 10px; background-color: #f0f0f0;">
                            To Do
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Doing" name="doing" class="doing">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="doing")
                    {
                ?>
                        <p style="color: orange; border-radius: 10px; background-color: #f0f0f0;">
                            Doing
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="done")
                    {
                ?>
                        <p style="color: green; border-radius: 10px; background-color: #f0f0f0;">
                            Done
                        </p>
                <?php
                    }
                ?>

                </div>
                <div class=edit_and_delete>
                    <a href="index.php?update=<?=$data['id']?>">
                    <button class="menu-btn edit-btn">Edit</button>
                    </a>
                    <a href="delete.php?delete=<?=$data['id']?>">
                        <button class="menu-btn delete-btn">Delete</button>
                    </a>
                </div>
            </div> 
            <?php
                }
            ?>
            </div>
        </div>
                <!-- Doing section ends here -->

                <!-- Done section starts here -->

        <div class="record" id="done">
            <?php
                $readQuery = "SELECT * FROM tasks WHERE task_status='done'";
                $readRun = mysqli_query($db,$readQuery);
                while($data = mysqli_fetch_array($readRun))
                {
            ?>
            <div class="record-item">
                <div>
                    <span class=title><?=$data['task_title']?></span><br><br>
                    <span class=description><?=$data['task_description']?></span><hr>
                </div>
                <div>
                    <table>
                        <tr>
                            <th><span class=time><b>Started at:</b></span></th>
                            <th><span class=time>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['task_created']?></span</th>
                        </tr>
                        <tr>
                            <th><span class=time><b>Completed at:</b></span></th>
                            <th>    <?php
                if($data['task_status']=="done")
                {
                ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class=time><?=$data['task_completed']?></span>
                <?php
                    }
                ?></th>
                        </tr>
                    </table>
                <br>

                <?php
                    if($data['task_status']=="todo")
                    {
                ?>
                        <p style="color: #ff0000; border-radius: 10px; background-color: #f0f0f0;">
                            To Do
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Doing" name="doing" class="doing">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="doing")
                    {
                ?>
                        <p style="color: orange; border-radius: 10px; background-color: #f0f0f0;">
                            Doing
                        </p>
                        <form action="status.php?update=<?=$data['id']?>" method="post">
                            <input type=submit value="Done" name="done" class="done">
                        </form>
                <?php
                    }
                ?>

                <?php
                    if($data['task_status']=="done")
                    {
                ?>
                        <p style="color: green; border-radius: 10px; background-color: #f0f0f0;">
                            Done
                        </p>
                <?php
                    }
                ?>

                </div>
                <div class=edit_and_delete>
                    <a href="index.php?update=<?=$data['id']?>">
                    <button class="menu-btn edit-btn">Edit</button>
                    </a>
                    <a href="delete.php?delete=<?=$data['id']?>">
                        <button class="menu-btn delete-btn">Delete</button>
                    </a>
                </div>
            </div> 
            <?php
                }
            ?>
            </div>
        </div>
                <!-- Done section ends here -->
</body>

<script>
        function allFunction() {
            var allElement = document.getElementById("all");
            var todoElement = document.getElementById("todo");
            var doingElement = document.getElementById("doing");
            var doneElement = document.getElementById("done");

            // Check the current display property
            if (allElement.style.display === "none" || allElement.style.display === "") {
                allElement.style.display = "block"; // Set it to block if it's none or empty
                todoElement.style.display = "none"; // Otherwise, hide it
                doingElement.style.display = "none"; // Otherwise, hide it
                doneElement.style.display = "none"; // Otherwise, hide it
            } else {
                allElement.style.display = "none"; // Otherwise, hide it
            }
        }

        function todoFunction() {
            var allElement = document.getElementById("all");
            var todoElement = document.getElementById("todo");
            var doingElement = document.getElementById("doing");
            var doneElement = document.getElementById("done");

            // Check the current display property
            if (todoElement.style.display === "none" || todoElement.style.display === "") {
                todoElement.style.display = "block"; // Set it to block if it's none or empty
                allElement.style.display = "none"; // Otherwise, hide it
                doingElement.style.display = "none"; // Otherwise, hide it
                doneElement.style.display = "none"; // Otherwise, hide it
            } else {
                todoElement.style.display = "none"; // Otherwise, hide it
            }
        }

        function doingFunction() {
            var allElement = document.getElementById("all");
            var todoElement = document.getElementById("todo");
            var doingElement = document.getElementById("doing");
            var doneElement = document.getElementById("done");

            // Check the current display property
            if (doingElement.style.display === "none" || doingElement.style.display === "") {
                doingElement.style.display = "block"; // Set it to block if it's none or empty
                allElement.style.display = "none"; // Otherwise, hide it
                todoElement.style.display = "none"; // Otherwise, hide it
                doneElement.style.display = "none"; // Otherwise, hide it
            } else {
                doingElement.style.display = "none"; // Otherwise, hide it
            }
        }

        function doneFunction() {
            var allElement = document.getElementById("all");
            var todoElement = document.getElementById("todo");
            var doingElement = document.getElementById("doing");
            var doneElement = document.getElementById("done");

            // Check the current display property
            if (doneElement.style.display === "none" || doneElement.style.display === "") {
                doneElement.style.display = "block"; // Set it to block if it's none or empty
                allElement.style.display = "none"; // Otherwise, hide it
                todoElement.style.display = "none"; // Otherwise, hide it
                doingElement.style.display = "none"; // Otherwise, hide it
            } else {
                doneElement.style.display = "none"; // Otherwise, hide it
            }
        }
    </script>

</html>
