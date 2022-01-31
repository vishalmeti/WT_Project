<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tasks.css">
    <title>Manage Your Tasks</title>
</head>

<body>

    <script>
        function refill(task, date, id){
            document.getElementById('name').value = task;
            document.getElementById('due').value = date;
            document.getElementById('taskId').value = id;
            document.getElementById('taskbtn').innerHTML = "Update Task";
            document.getElementById('taskbtn').name = "update";
            document.getElementById('heading').innerHTML = "Update Task";
            document.getElementById('cancel').style = "display:block";
        }

        function cancelUpdate(){
            document.getElementById('name').value = '';
            document.getElementById('due').value = '';
            document.getElementById('taskId').value = '';
            document.getElementById('heading').innerHTML = "New Task";
            document.getElementById('taskbtn').innerHTML = "Add Task";
            document.getElementById('taskbtn').name = "addTask";
            document.getElementById('cancel').style = "display:none";
        }
    </script>
    
    <div class="head" align="center" style="z-index:34">
        <h1>Welcome</h1>
        <p>Good to go with your tasks</p>
        <a href="logout.php" style="float: right;">Logout</a>
    </div>

    <?php require_once 'taskManage.php' ?>
    <?php if(isset($_SESSION['message'])): ?>
    <script>
        alert('<?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
             ?>');
    </script>
    <?php endif; ?>
    <?php
            $con = new mysqli('localhost','root','','todo');
            $email = $_SESSION['email'];
            $id = 0;
            $result = $con->query("SELECT * FROM tasks WHERE EMAIL = '$email'");
        ?>

    <div class="addTask">
        <form action="taskManage.php" method="post" name="newTask">
            <input type="hidden" name="ID" id="taskId" value="">
            <label for="newTask" id="heading"></label><br>
            <input type="text" name="name" id="name" placeholder="Add new task" required>
            <h4>Due Date</h4>
            <input type="date" name="due" id="due" placeholder="Set a due date" required>
            <button name="addTask" id="taskbtn" type="submit"></button>
            <button type="button" name="cancel" id="cancel" class="cancel" onclick="cancelUpdate()">Cancel Update</button>
        </form>
    </div>

    <?php if($_SESSION['taskNo']!=0): ?>
    <center>
    <div class="taskLists">
       <table style="width:50%">
           <caption>--:Current Tasks:--</caption>
           <?php while($row = $result->fetch_assoc()): ?>
            <?php if($row['DONE']==0): ?>
           <tr>
                <?php $id = $id + 1; ?>
               <td width="5%"><?php echo $id; ?></td>
               <td width="68%">
                   <p><?php echo $row['LABEL']; ?></p>
                   <?php if($row['UPDATED_ON']==NULL): ?>
                    <p class="due">Added On: <?php echo $row['ADDED_ON']; ?></p>
                   <?php else: ?>
                    <p class="due">Updated On: <?php echo $row['UPDATED_ON']; ?></p>
                    <?php endif; ?>
                    <p class="due">Due Date: <?php echo $row['LAST_DATE']; ?></p>
                   
               </td>
               <form method="post" action="taskManage.php"> 
               <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
               <td width="9%"><input type="submit" class="done" name="done" value="Done"></td>
               <td width="9%"><input type="button" class="update" name="update" value="Update" onclick="refill('<?php echo strval($row['LABEL']) ?>','<?php echo strval($row['LAST_DATE']) ?>','<?php echo strval($row['id']) ?>')" ></td>
               <td width="9%"><input type="submit" class="delete" name="delete" value="Delete"></td>
                </form>
           </tr>
           <?php endif; ?>
           <?php endwhile; ?>
            
           <?php
           $result = $con->query("SELECT * FROM tasks WHERE EMAIL = '$email'");
            while($row = $result->fetch_assoc()): ?>
            <?php if($row['DONE']==1): ?>
           <tr> 
                <?php $id = $id + 1; ?>
               <td width="5%"><?php echo $id; ?></td>
                   
               <td width="68%">
                   <p><?php echo $row['LABEL']; ?></p>
                   <?php if($row['UPDATED_ON']==NULL): ?>
                    <p class="due">Added On: <?php echo $row['ADDED_ON']; ?></p>
                   <?php else: ?>
                    <p class="due">Updated On: <?php echo $row['UPDATED_ON']; ?></p>
                    <?php endif; ?>
                    <p class="due">Due Date: <?php echo $row['LAST_DATE']; ?></p>
                   
               </td>
                   
               </td>
               <form method="post" action="taskManage.php"> 
               <input type="hidden" name="ID" value="<?php echo $row['id']; ?>">
               <td width="9%"><input type="submit" class="disabled" name="done" value="Done" disabled></td>
               <td width="9%"><input type="button" class="disabled" name="update" value="Update" disabled></td>
               <td width="9%"><input type="submit" class="delete" name="delete" value="Delete"></td>
                </form>
           </tr>
           <?php endif; ?>
           <?php endwhile; ?>
       </table>
    </div>
    </center>
    <?php endif; ?>

    <script>
        document.getElementById('heading').innerHTML = "New Task";
        document.getElementById('taskbtn').innerHTML = "Add Task";
        document.getElementById('taskbtn').name = "addTask";
        document.getElementById('cancel').style = "display:none";
    </script>

</body>
</html>