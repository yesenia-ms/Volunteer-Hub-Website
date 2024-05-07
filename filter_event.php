<?php 

if($_SERVER["REQUEST_METHOD"] == "GET"){
	if(isset($_GET['filter'])){
		// query the database for events with that keyword in the 
		// event name or the organization name
		$sql = "SELECT * FROM `events` WHERE `event_name` LIKE '%food%'";
        $res = $dblink->query($sql) or die("<p>Something went wrong with $sql<br>".$dblink->error);
		if($res->num_rows > 0){
                    while($row = $res->fetch_array(MYSQLI_ASSOC)){
                        echo "<div class='opportunity'>";
                        echo "<form method='post' action='register_event.php'>";
                        echo "<input type='hidden' name='event_id' value='" . $row['event_id'] . "'>";
                        echo "<input type='hidden' name='org_id' value='" . $row['org_id'] . "'>";
						if(stristr($row['event_name'], "tree")){
							echo '<img class="img_volunteer" src="images/plant_trees.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "clean")){
							echo '<img class="img_volunteer" src="images/clean_up_community.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "charity")){
							echo '<img class="img_volunteer" src="images/charity_center_happy.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "food")){
							echo '<img class="img_volunteer" src="images/food_bank_happy.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "cloth")){
							echo '<img class="img_volunteer" src="images/clothes_box_happy.jpeg" alt="Responsive image">';
						}
						else if(stristr($row['event_name'], "kitchen")){
							echo '<img class="img_volunteer" src="images/kitchen_volunteer.jpeg" alt="Responsive image">';
						}
						else{
							echo '<img class="img_volunteer" src="images/volunteer_group_happy.jpeg" alt="Responsive image">';
						}
                        echo "<p><strong>Event Name:</strong> " . htmlspecialchars($row['event_name']) . "</p>";
                        echo "<p><strong>Organization:</strong> " . htmlspecialchars($row['org_name']) . "</p>";
                        echo "<p><strong>Task:</strong> " . htmlspecialchars($row['task']) . "</p>";
                        echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                        echo "<p><strong>Start Time:</strong> " . htmlspecialchars($row['start_time']) . "</p>";
                        echo "<p><strong>End Time:</strong> " . htmlspecialchars($row['end_time']) . "</p>";
                        echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                        if (isset($_SESSION['user_id'])) {
                            echo "<button type='submit' class='search-button' name='register'>Register</button>";
                        } else {
                            echo "<button type='button' onclick=\"location.href='signin.php'\" class='search-button'>Register</button>";
                        }
                        echo "</form>";
                        echo "</div>";            
                    }
		}
	}
}
?>
