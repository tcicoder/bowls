<?php 
    session_start();
    
//Make a database connection
    define("DB_SERVER","localhost");
    define("DB_USER","randyg");
    define("DB_PASS","tiger");
    define("DB_NAME","bowls");
$connection=mysqli_connect(DB_SERVER  , DB_USER, DB_PASS, DB_NAME);
If(mysqli_connect_errno()) {
    die("Database Connection Failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"

    );
}


if(isset($_POST['Submit'])) {
    $gameWinner1 = $_POST['gameWinner1'];
    $pointsGame1 = $_POST['pointsGame1'];
    
    
} else {
    $gameWinner1 = "";
    $pointsGame1 = "";
    
    
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Bowl Game 1</title>
    <link rel="stylesheet" type="text/css" href="pickstest2.css">
    
</head>

<body>
    
        
        <div id="game_container" class="game_container">
         
            <div id=team1_container class="team_container">
                <?php
                
                $query = "SELECT * FROM games WHERE `GameID` = 1";
                $result = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($result)) {
                $team1 = $row['team1'];
                echo $team1;
                
                
                $logo_query = "SELECT teamLogo FROM teams WHERE `teamName` = '$team1'";
                $logo_result = mysqli_query($connection,$logo_query);
                
                while($logo_row = mysqli_fetch_assoc($logo_result)) {
                    $logo = $logo_row['teamLogo'];
                echo "<div id='team1_logo'>";
                echo     "<img src= " . $logo . " style='height: 80%; width: 80%; object-fit: contain'/>";
                echo "</div>";
                }
                        
                
                }
                ?>
                    
            </div>
            
         
            <div id="gameinfo_container" class="team_container">
                <form method="post" action="Bowl_Game_1.php">
                    <?php
                    $query = "SELECT * FROM games WHERE `GameID` = 1";
                    $result = mysqli_query($connection,$query);
    
                    while($row = mysqli_fetch_assoc($result)) {
                    echo $row['bowlGame'];
                    echo "</br>";
                    echo $row['Venue'];
                    echo "</br>";
                    echo $row['Location'];
                    echo "</br>";
                    }
    
                    
                    $game= "SELECT team1, team2 FROM games WHERE GameID = 1";
                    $result=mysqli_query($connection, $game);
                    //print_r($result);
        
        
                    echo "Game Winner: <select name='gameWinner1'>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['team1'] ."'>" . "" ."</option>";
                        echo "<option value='" . $row['team1'] ."'>" . $row['team1'] ."</option>";
                        echo "<option value='" . $row['team2'] ."'>" . $row['team2'] ."</option>";
                    }
                    echo "</select>";
                    echo "<br />";
            
                    ?>
                    <input type="number" name="pointsGame1"/>
                
                    <a href="Bowl_Game_2.php">Next Game</a>
                    
                    <?php
                    
                    $Final =    "INSERT INTO picks (gameWinner1, pointsGame1)
                                
                                
                    VALUES ('$gameWinner1', '$pointsGame1')";
                    
        
                    mysqli_query($connection,$Final);
            
                    ?>
                    
       
                <input id="submit" type="submit" name="Submit"/>
                </form>
            </div>

            <div id="team2_container" class="team_container">
                    
                    <?php

                    $query = "SELECT * FROM games WHERE `GameID` = 1";
                    $result = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($result)) {
                       $team2 = $row['team2'];
                       echo $team2;
                    }
                
                    $logo_query = "SELECT teamLogo FROM teams WHERE `teamName` = '$team2'";
                    $logo_result = mysqli_query($connection,$logo_query);
                
                    while($logo_row = mysqli_fetch_assoc($logo_result)) {
                        $logo = $logo_row['teamLogo'];
                    echo "<div id='team2_logo'>";
                    echo     "<img src= " . $logo . " style='height: 40%; width: 40%; object-fit: contain'/>";
                    echo "</div>";
                    }
                    ?>
                    
            </div>
            
        </div>        


</body>
</html>