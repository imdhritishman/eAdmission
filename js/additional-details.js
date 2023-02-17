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
