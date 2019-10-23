(function($)
{"use strict";

if($("#chart-09").length){var options={colors:[colors[14],colors[4]],chart:{height:400,type:"bar"},plotOptions:{bar:{horizontal:false,endingShape:"rounded",columnWidth:"45%"}},dataLabels:{enabled:false},stroke:{show:true,width:2,colors:["transparent"]},series:[{name:"Last Month",data:[44,55,57,56,61,58,63,60,66,45,50,55]},{name:"This Month",data:[76,85,101,98,87,105,91,114,94,80,75,90]}],xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]},fill:{opacity:1},tooltip:{y:{formatter:function(val){return val+" Commits"}}}};var chart=new ApexCharts(document.querySelector("#chart-09"),options);chart.render()}})(window.jQuery);
