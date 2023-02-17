let Dashboard = (() => {
    let global = {
      tooltipOptions: {
        placement: "right" },
  
      menuClass: ".c-menu" };
  
  
    let menuChangeActive = el => {
      let hasSubmenu = $(el).hasClass("has-submenu");
      $(global.menuClass + " .is-active").removeClass("is-active");
      $(el).addClass("is-active");
  
      // if (hasSubmenu) {
      // 	$(el).find("ul").slideDown();
      // }
    };
  
    let sidebarChangeWidth = () => {
      let $menuItemsTitle = $("li .menu-item__title");
  
      $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
      $(".hamburger-toggle").toggleClass("is-opened");
  
      if ($("body").hasClass("sidebar-is-expanded")) {
        $('[data-toggle="tooltip"]').tooltip("destroy");
      } else {
        $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
      }
  
    };
  
    return {
      init: () => {
        $(".js-hamburger").on("click", sidebarChangeWidth);
  
        $(".js-menu li").on("click", e => {
          menuChangeActive(e.currentTarget);
        });
  
        $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
      } };
  
  })();
  
  Dashboard.init();


  // Select Course JS
  var Higher_Secondary = ["1st Year", "2nd Year"];
  var Under_Graduate = ["1st Semester", "3rd Semester", "5th Semester"];
  var Post_Graduate = ["1st Semester", "3rd Semester"];

  $("#InputCourse").change(function(){
    var CourseSelected = $(this).val();
    var optionList;
    var htmlString = "";

    switch(CourseSelected) {
      case "Higher Secondary":
        optionList = Higher_Secondary;
        break;
      case "Under Graduate":
        optionList = Under_Graduate;
        break;
      case "Post Graduate":
        optionList = Post_Graduate;
        break;
    }

    for(var i=0; i<optionList.length; i++){
      htmlString = htmlString + "<option value = '" + optionList[i] + "'>" + optionList[i] + "</option>";
    }

    $("#InputYear").html(htmlString);
  });

  function extracarricularquota(value){
    if(value=='Yes'){
      $(".extracarricularquota").show();
    }
    else{
      $(".extracarricularquota").hide();
    }
  }


// Applicable For Higher Secondary
function hstotal_1(){
  var mark = document.getElementsByClassName('total_1');
  var total_1 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_1 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total1').value = total_1;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/600)*100;
}

function hstotal_2(){
  var mark = document.getElementsByClassName('total_2');
  var total_2 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_2 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total2').value = total_2;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/600)*100;
}

function hstotal_3(){
  var mark = document.getElementsByClassName('total_3');
  var total_3 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_3 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total3').value = total_3;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/600)*100;
}

function hstotal_4(){
  var mark = document.getElementsByClassName('total_4');
  var total_4 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_4 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total4').value = total_4;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/600)*100;
}  

function hstotal_5(){
  var mark = document.getElementsByClassName('total_5');
  var total_5 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_5 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total5').value = total_5;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/600)*100;
}

function hstotal_6(){
  var mark = document.getElementsByClassName('total_6');
  var total_6 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_6 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total6').value = total_6;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/600)*100;
}

// Applicable For Under Graduate
function total_1(){
  var mark = document.getElementsByClassName('total_1');
  var total_1 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_1 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total1').value = total_1;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/500)*100;
}

function total_2(){
  var mark = document.getElementsByClassName('total_2');
  var total_2 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_2 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total2').value = total_2;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/500)*100;
}

function total_3(){
  var mark = document.getElementsByClassName('total_3');
  var total_3 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_3 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total3').value = total_3;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/500)*100;
}

function total_4(){
  var mark = document.getElementsByClassName('total_4');
  var total_4 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_4 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total4').value = total_4;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/500)*100;
}  

function total_5(){
  var mark = document.getElementsByClassName('total_5');
  var total_5 = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total_5 += parseInt(mark[i].value);
      }
  }
  document.getElementById('s_total5').value = total_5;

  var mark = document.getElementsByClassName('totalmark');
  var total = 0;
  for(var i=0; i<mark.length; i++)
  {
      if(parseInt(mark[i].value))
      {
          total += parseInt(mark[i].value);
      }
  }

  document.getElementById('s_total').value = total;
  document.getElementById('s_percentage').value = (total/500)*100;
}


// Applicable For Post Graduate
function semtotal_1(){
  var semtheory = parseFloat(document.getElementById('semtheory_1').value);
  var sempractical = parseFloat(document.getElementById('sempractical_1').value);
  var semtotal_1 = semtheory * sempractical;

  document.getElementById('s_semtotal1').value = semtotal_1;

  var semmark = document.getElementsByClassName('semtotalmark');
  var semtotal = 0;
  for(var i=0; i<semmark.length; i++)
  {
      if(parseInt(semmark[i].value))
      {
          semtotal += parseInt(semmark[i].value);
      }
  }

  document.getElementById('s_semtotal').value = semtotal/6;
  document.getElementById('s_sempercentage').value = (semtotal/6)*9.5 ;
}

function semtotal_2(){
  var semtheory = parseFloat(document.getElementById('semtheory_2').value);
  var sempractical = parseFloat(document.getElementById('sempractical_2').value);
  var semtotal_2 = semtheory * sempractical;

  document.getElementById('s_semtotal2').value = semtotal_2;

  var semmark = document.getElementsByClassName('semtotalmark');
  var semtotal = 0;
  for(var i=0; i<semmark.length; i++)
  {
      if(parseInt(semmark[i].value))
      {
          semtotal += parseInt(semmark[i].value);
      }
  }

  document.getElementById('s_semtotal').value = semtotal/6;
  document.getElementById('s_sempercentage').value = (semtotal/6)*9.5;
}

function semtotal_3(){
  var semtheory = parseFloat(document.getElementById('semtheory_3').value);
  var sempractical = parseFloat(document.getElementById('sempractical_3').value);
  var semtotal_3 = semtheory * sempractical;

  document.getElementById('s_semtotal3').value = semtotal_3;

  var semmark = document.getElementsByClassName('semtotalmark');
  var semtotal = 0;
  for(var i=0; i<semmark.length; i++)
  {
      if(parseInt(semmark[i].value))
      {
          semtotal += parseInt(semmark[i].value);
      }
  }

  document.getElementById('s_semtotal').value = semtotal/6;
  document.getElementById('s_sempercentage').value = (semtotal/6)*9.5;
}

function semtotal_4(){
  var semtheory = parseFloat(document.getElementById('semtheory_4').value);
  var sempractical = parseFloat(document.getElementById('sempractical_4').value);
  var semtotal_4 = semtheory * sempractical;

  document.getElementById('s_semtotal4').value = semtotal_4;

  var semmark = document.getElementsByClassName('semtotalmark');
  var semtotal = 0;
  for(var i=0; i<semmark.length; i++)
  {
      if(parseInt(semmark[i].value))
      {
          semtotal += parseInt(semmark[i].value);
      }
  }

  document.getElementById('s_semtotal').value = semtotal/6;
  document.getElementById('s_sempercentage').value = (semtotal/6)*9.5;
}

function semtotal_5(){
  var semtheory = parseFloat(document.getElementById('semtheory_5').value);
  var sempractical = parseFloat(document.getElementById('sempractical_5').value);
  var semtotal_5 = semtheory * sempractical;

  document.getElementById('s_semtotal5').value = semtotal_5;

  var semmark = document.getElementsByClassName('semtotalmark');
  var semtotal = 0;
  for(var i=0; i<semmark.length; i++)
  {
      if(parseInt(semmark[i].value))
      {
          semtotal += parseInt(semmark[i].value);
      }
  }

  document.getElementById('s_semtotal').value = semtotal/6;
  document.getElementById('s_sempercentage').value = (semtotal/6)*9.5;
}

function semtotal_6(){
  var semtheory = parseFloat(document.getElementById('semtheory_6').value);
  var sempractical = parseFloat(document.getElementById('sempractical_6').value);
  var semtotal_6 = semtheory * sempractical;

  document.getElementById('s_semtotal6').value = semtotal_6;

  var semmark = document.getElementsByClassName('semtotalmark');
  var semtotal = 0;
  for(var i=0; i<semmark.length; i++)
  {
      if(parseInt(semmark[i].value))
      {
          semtotal += parseInt(semmark[i].value);
      }
  }

  document.getElementById('s_semtotal').value = semtotal/6;
  document.getElementById('s_sempercentage').value = (semtotal/6)*9.5;
}
