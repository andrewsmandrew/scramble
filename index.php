<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">

</head>


<body>
  <div class="game-header" id="head">
      <div class="game-header-content"><h1>Scramble</h1></div>
  </div>
    <center>
    <p>Create three words!</p>
    <div class="grid">
      <button class="grid-box a" id="0">
        <p class="letter"></p>
      </button>
      <button class="grid-box a" id="1">
        <p class="letter"></p>
      </button>
      <button class="grid-box a" id="2">
        <p class="letter"></p>
      </button>
      <button class="grid-box b" id="3">
        <p class="letter"></p>
      </button>
      <button class="grid-box b" id="4">
        <p class="letter"></p>
      </button>
      <button class="grid-box b" id="5">
        <p class="letter"></p>
      </button>
      <button class="grid-box c" id="6">
        <p class="letter"></p>
      </button>
      <button class="grid-box c" id="7">
        <p class="letter"></p>
      </button>
      <button class="grid-box c" id="8">
        <p class="letter"></p>
      </button>
    </center>
  </div>


  <?php
    include "query.php";
    $date = date("Y-m-d");
    $puzzle = getData($pdo, $date);

  
    if($puzzle == FALSE){
      include "create_puzzle.php";
      $puzzle = create_puzzle($words);
      $solution = json_encode($puzzle["solution"]);
      $grid_data = json_encode($puzzle["grid_data"]);
      postData($pdo, $grid_data, $solution);
    } else {
      $solution = $puzzle["Solution"];
      $grid_data = $puzzle["Puzzle"];
    }
  


  echo "<script>
  let solution = $solution;
  let gridData = $grid_data;
  </script>";
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/0.6.0/fastclick.min.js" integrity="sha512-oljyd1wg75alHReTpDvNIQ4Yj1wZwGxxZhJhId3vr2dKY+26/r/wmMrImwDgin03+7wxyhX+adOQB/2BTvO5tQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="script.js" type="module"></script>

  
</body>

</html>