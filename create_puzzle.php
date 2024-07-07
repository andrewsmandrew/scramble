<?php
function switch_data($array, $a, $b){
  $temp = $array[$a];
  $array[$a] = $array[$b];
  $array[$b] = $temp;
  return $array;
}

function check_solution($solution, $grid_data){
  $solved = 0;
  $count = count($solution);
  for($i = 0; $i < $count; $i++){
    $word = str_split($solution[$i]);
    for($j = 0; $j < $count; $j++){
      $match = 0;
      $pos = $j * $count;
      for($k = 0; $k < $count; $k++){
        if($word[$k] == $grid_data[$pos + $k]){
          $match++;
        }
      }
      if($match == $count){
        $solved++;
      }
    }
  }
  return $solved;  
}

function scramble($solution, $grid_data, $n){
  $solved = 0;
  $count = count($grid_data)-1;
  do {
    for($i = 0; $i < $n; $i++){
      $grid_data = switch_data(
          $grid_data, rand(0, $count), rand(0, $count));
      $solved = check_solution($solution, $grid_data);
    }
    } while ($solved > 0);
  return($grid_data);
}

function create_puzzle($words){
  $solution = [];
  $grid_data = [];
  $length = 3;

  while(count($solution) < $length){
    $word = $words[rand(0,count($words)-1)]->{"word"};
    if(!in_array($word, $solution)){
      array_push($solution, $word);
    }
  }

  for($i = 0; $i < $length; $i++){
    for($j = 0; $j < $length; $j++){
      $grid_data[$i*$length + $j] = str_split($solution[$i])[$j];
    }
  }

  $grid_data = scramble($solution, $grid_data, 10);

  return ["solution"=>$solution, "grid_data"=>$grid_data];
}




$json_file = file_get_contents("words.json");
$words = json_decode($json_file);