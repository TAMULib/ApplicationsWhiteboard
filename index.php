<?php  
include 'app.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Whiteboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <div class="global-header">
            <img src="images/Libraries_white.svg" alt="Texas A&amp;M Libraries" />
        </div>
    </header>

    <input type="checkbox" id="menu" name="menu" class="menu-checkbox" />
    <div class="menu">
      <label class="menu-toggle" for="menu"> <span class="icon">&#9776;</span></label>
      <div id="static" class="container column-content">
        
          <div class="card">
              <div class="card-title">
                  <h3></h3>
              </div>
          </div>

          <div class="card">
              <div class="card-title">
                  <h3>DSpace</h3>
              </div>
          </div>

          <div class="card">
              <div class="card-title">
                  <h3>DAME</h3>
              </div>
          </div>
      </div>
    </div>




<div class="wrapper" id="app">
  
  <div class="columns">
    <div class="sub-columns">
        <div class="column">
          <h2 class="column-title">Pending</h2>
          <span class="expand-colapse">Expand All</span>
            <div id="pending" class="container column-content">
              <?php $getCards->theCards('1');  ?>
          </div>
        </div>

        <div class="column">
          <h2 class="column-title">Stuff @ Large</h2>
          <span class="expand-colapse">Expand All</span>
            <div id="at-large" class="container column-content">
              <?php $getCards->theCards('2');  ?>
          </div>
        </div>

        <div class="column">
          <h2 class="column-title">Ongoing</h2>
          <span class="expand-colapse">Expand All</span>
            <div id="ongoing" class="container column-content">
              <?php $getCards->theCards('3');  ?>
            </div>
        </div>


    </div>
  </div>

  <div class="columns">
    <div class="sub-columns">
        <div class="column">
          <h2 class="column-title">On Deck</h2>
          <span class="expand-colapse">Expand All</span>
            <div id="on-deck" class="column-content">
                <?php $getCards->theCards('4');  ?>
            </div>
        </div>
        <div class="column">
          <h2 class="column-title">Current</h2>
          <span class="expand-colapse">Expand All</span>
            <div id="current" class="column-content">
              <?php $getCards->theCards('5');  ?>
            </div>
        </div>
    </div>
  </div>


  <div class="columns">
    <div class="sub-columns">
      <div class="column">
        <h2 class="column-title">Moving To Pre</h2>
        <span class="expand-colapse">Expand All</span>
          <div id="moving-pre" class="column-content">
            <?php $getCards->theCards('6');  ?>
          </div>
      </div>

      <div class="column">
        <h2 class="column-title">On Pre</h2>
        <span class="expand-colapse">Expand All</span>
          <div id="on-pre" class="column-content">
            <?php $getCards->theCards('7');  ?>
          </div>
      </div>
    </div>
  </div>


  <div class="columns">
    <div class="sub-columns">
      <div class="column">
        <h2 class="column-title">Moving To Production</h2>
        <span class="expand-colapse">Expand All</span>
        <div id="moving-prod" class="column-content">
          <?php $getCards->theCards('8');  ?>
        </div>
      </div>

      <div class="column">
        <h2 class="column-title">On Production</h2>
        <span class="expand-colapse">Expand All</span>
        <div id="on-prod" class="column-content">
          <?php $getCards->theCards('9');  ?>
        </div>
      </div>
    </div>
  </div>

</div>


    <div id="trash" class="hidden">
        <img src="images/trashcan.png" alt="Delete Card" />
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="js/dragula.js"></script>
    <script src="js/main.js"></script>
</body>
</html>