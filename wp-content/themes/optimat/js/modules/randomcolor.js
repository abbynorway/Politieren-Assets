$(document).ready(function(){
  var colors = ["#834f21","#f3467f","#990099"];                
  var rand = Math.floor(Math.random()*colors.length);           
  $('h1').css("color", colors[rand]);
});