<!DOCTYPE html>
        <html>
            <head> 
                <meta charset="utf-8">
                <title>4096</title>
                <link rel="stylesheet" type="text/css"  href="css/bootstrap.css"/>
                <link rel="stylesheet" type="text/css"  href="css/4096.css" />
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="bootstrap.js"></script>
                <script src="svg.js"></script>
                <script src="4096.js" type="text/javascript"></script>
            </head>
               <body>
               
           			<a href="menu.php"><button class="submit" type="button">Main Menu</button></a><br>
               <?php session_start()?>
               
                <div class="container">
                    <div id="one" class="row" name='menu'>
                        <div class='col-md-3'><h1>4096</h1></div>
                        <div class='col-md-4' id='score'>
                            <label>SCORE </label>
                            <label id='score-value'></label>
                        </div>
                    </div>
                    <div class="row" id="newgame">
                        <div class='col-md-4 col-md-offset-2'>
                            <button id='newgame-btn'>New Game</button>
                        </div>
                    </div>
                    <div class='row' id='game'>
                        <div class='col-md-12'>
                            <svg class="grid" id="grid" width='500' height='500'>
                            </svg>
                        </div>
                    </div>
                    <div class='row' id="note">
                        <div class='col-sm-5'>
                            <p><strong>How to play:</strong> Use your arrow keys to move the tiles.
                            When two tiles with the same number touch, they merge into one!</p>        
                        </div>
                        <input type="hidden" id="userid" value='<?php echo $_SESSION["userNameValue"]?>'/>
                    </div>
                </div>
            </body>
        </html>