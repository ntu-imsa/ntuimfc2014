/*
# Preload Elements
*/


(function() {
  var $dom, $mapCanva, $menu, $menuItem, $menuItems, $sections, $window, SECTIONS, loadMap, page, pc, resetMenuActiveItem, screenHeight, screenWidth, setMenuActiveItem, tablet;

  $window = $(window);

  $dom = $("html");

  screenWidth = $window.width();

  screenHeight = $window.height();

  $menu = $("#main-menu ul");

  $menuItems = $menu.children('.item');

  $menuItem = [$($menuItems[0]), $($menuItems[1]), $($menuItems[2]), $($menuItems[3]), $($menuItems[4])];

  $sections = {
    "#about": $("#about"),
    "#location": $("#location"),
    "#schedule": $("#schedule"),
    "#sponsor": $("#sponsor"),
    "#team": $("#team")
  };

  /*
  # Media Query in JS
  */


  tablet = Modernizr.mq("(min-width: 48em)");

  pc = Modernizr.mq("(min-width: 64em)");

  $mapCanva = document.querySelector("#map-canva");

  /*
  # Helper
  */


  resetMenuActiveItem = function() {
    return $menuItems.removeClass("active");
  };

  setMenuActiveItem = function(index) {
    var hash;

    resetMenuActiveItem();
    $menuItem[index].addClass("active");
    hash = $menuItem[index].children('a').attr('href');
    return ga('send', 'pageview', "/freshman/" + hash);
  };

  $window.on('resize', function() {
    screenWidth = $window.width();
    return screenHeight = $window.height();
  });

  /*
  # Navigation
  */


  $menu.on("click", "a", function(e) {
    var targetScrollTop;

    targetScrollTop = $sections[e.target.hash].offset().top;
    $window.scrollTo(targetScrollTop - 55, 1000);
    ga('send', 'pageview', "/freshman/" + e.target.hash);
    return e.preventDefault();
  });

  /*
  # About Section
  */


  /*
  # Location
  */


  loadMap = function() {
    var map, mapLatLng, mapOptions, marker;

    mapLatLng = new google.maps.LatLng(24.9059493, 121.2681086);
    mapOptions = {
      center: mapLatLng,
      mapTypeId: google.maps.MapTypeId.HYBRID,
      zoom: 16,
      scrollwheel: false
    };
    map = new google.maps.Map($mapCanva, mapOptions);
    return marker = new google.maps.Marker({
      position: mapLatLng,
      map: map,
      icon: "images/map_pin.png"
    });
  };

  /*
  # Schedule
  */


  $sections["#schedule"].on("click", ".session.block", function(e) {
    return $(e.currentTarget).attr("tabindex", -1).focus();
  });

  /*
  # Parallax Scrolling
  */


  SECTIONS = {
    LANDING: 0,
    NAVIGATION: 1,
    ABOUT: 2,
    LOCATION: 3,
    SCHEDULE: 4,
    SPONSOR: 5,
    TEAM: 6
  };

  page = sections.create({
    autoSectionHeight: false
  });

  page.on('changed', function(current, previous) {
    var pageID;

    pageID = current.element.id;
    if (pageID === "landing") {
      $menu.parent().removeClass("fixed");
      return $dom.removeClass("fixed");
    } else {
      $menu.parent().addClass("fixed");
      return $dom.addClass("fixed");
    }
  });

  page.section(SECTIONS.LANDING, function(section) {
    var scrollDownNotice, transitions;

    transitions = [];
    scrollDownNotice = document.querySelector("#scroll-down-notice");
    section.on("scrollIn", function() {
      return resetMenuActiveItem();
    });
    transitions.push({
      target: scrollDownNotice,
      start: 100,
      end: 120,
      key: 'opacity',
      from: 1,
      to: 0
    });
    if (pc) {
      return section.transitions(transitions);
    }
  });

  page.section(SECTIONS.NAVIGATION, function(section) {
    return section.on("scrollIn", function(way) {
      return setMenuActiveItem(0);
    });
  });

  page.section(SECTIONS.ABOUT, function(section) {
    var aboutDescription, element, sitconJiangElements, transitions, _i, _len;

    transitions = [];
    aboutDescription = document.querySelector("#about-description");
    sitconJiangElements = [document.querySelector("#about"), document.querySelector("#about .overlay.cg")];
    section.on("scrollIn", function() {
      return setMenuActiveItem(0);
    });
    transitions.push({
      target: aboutDescription,
      start: 0,
      end: 100,
      key: 'transform',
      from: 100,
      to: 35,
      format: "translateY(%spx)",
      afterCalculate: function(val) {
        return (val / 100) * screenHeight;
      }
    });
    for (_i = 0, _len = sitconJiangElements.length; _i < _len; _i++) {
      element = sitconJiangElements[_i];
      transitions.push({
        target: element,
        start: 0,
        end: 100,
        key: 'background-position-y',
        from: -100,
        to: 40,
        format: "%spx",
        afterCalculate: function(val) {
          return (val / 100) * screenHeight;
        }
      });
    }
    if (pc) {
      return section.transitions(transitions);
    }
  });

  page.section(SECTIONS.LOCATION, function(section) {
    var sitconJiangAtMap, transitions;

    transitions = [];
    sitconJiangAtMap = document.querySelector("#sitcon-jiang-at-map");
    section.on("scrollIn", function() {
      return setMenuActiveItem(1);
    });
    transitions.push({
      target: sitconJiangAtMap,
      start: 0,
      end: 100,
      key: 'transform',
      from: -50,
      to: 0,
      format: "translateY(%spx)",
      afterCalculate: function(val) {
        return val = (val / 100) * screenHeight;
      }
    });
    if (pc) {
      return section.transitions(transitions);
    }
  });

  page.section(SECTIONS.SCHEDULE, function(section) {
    var transitions;

    transitions = [];
    section.on("scrollIn", function() {
      return setMenuActiveItem(2);
    });
    return section.transitions(transitions);
  });

  page.section(SECTIONS.SPONSOR, function(section) {
    return section.on("scrollIn", function() {
      return setMenuActiveItem(3);
    });
  });

  page.section(SECTIONS.TEAM, function(section) {
    return section.on("scrollIn", function() {
      return setMenuActiveItem(4);
    });
  });

  /*
  # Onload
  */


  $window.ready(function() {
    page.init();
    loadMap();
  });

}).call(this);
