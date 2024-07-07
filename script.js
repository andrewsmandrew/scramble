function getTomorrow(){
    let dateTomorrow = new Date(Date.now() + 86400000);
    dateTomorrow.setHours(0);
    dateTomorrow.setMinutes(0);
    dateTomorrow.setSeconds(0);
    return dateTomorrow.toGMTString();
}

const TOMORROW = getTomorrow();
console.log(TOMORROW);

function getCookie(cookieName){
  let decodedCookie = document.cookie;
  let cookies = decodedCookie.split(";");
  for (let i = 0; i < cookies.length; i++){
    let cookie = cookies[i]
    let type = cookie.substring(0, cookieName.length + 1)
    if (type.includes(cookieName)){
      let cookieData = cookie.split("=")[1];
      return cookieData;
    }
  }
  return decodedCookie;
}

function switchData(x, y) {
  let temp = gridData[x];
  gridData[x] = gridData[y];
  gridData[y] = temp;

}

function checkSolution() {
  solved = 0;
  $(".grid-box").removeClass("correct");
  for (let i = 0; i < solution.length; i++) {
    let word = solution[i];
    for (let j = 0; j < Math.sqrt(gridData.length); j++) {
      let match = 0;
      let pos = j * 3;
      for (let k = 0; k < word.length; k++) {
        if (word[k] == gridData[pos + k]) {
          match++;
        }
      }
      if (match == word.length) {
        $(ROW_CLASSES[j]).addClass("correct");
        solved++;
      }
    }
  }
}

function updateBoxes() {
  for (let i = 0; i < 9; i++) {
    $("#" + i).children().text(gridData[i].toUpperCase());
  }
  checkSolution();
  document.cookie = `active=true; expires= ${TOMORROW} 00:00:00 GMT`;
  document.cookie = `solution=${JSON.stringify(solution)}; expires= ${TOMORROW} 00:00:00 GMT`;
  document.cookie = `gridData=${JSON.stringify(gridData)}; expires= ${TOMORROW} 00:00:00 GMT`;
}

const ROW_CLASSES = ['.a', '.b', '.c'];
let selected = -1;
let solved = 0;

let d = new Date();
console.log()

if(getCookie("active") == "true"){
  gridData = JSON.parse(getCookie("gridData"));
  solution = JSON.parse(getCookie("solution"));
  
}

console.log(solution);
console.log(gridData);


$(document).ready(function() {
  FastClick.attach(document.body);
  $(".grid-box").click(function() {
    if (!this.classList.contains("correct")) {
      if (selected == -1) {
        selected = this.id;
        $(this).addClass("selected");
      } else {
        switchData(selected, this.id);
        $(".grid-box").removeClass("selected");
        updateBoxes();
        selected = -1;
      }
    }
  });  
  updateBoxes();
});

