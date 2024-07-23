// This file contains all the scripts that must be loaded on page load
// Scripts that can be delayed should go to main.js

//= include ../../node_modules/body-scroll-lock/lib/bodyScrollLock.js
//= include ../../node_modules/bigpicture/dist/BigPicture.min.js

document.addEventListener("DOMContentLoaded", function(event) {

  // Image Lightbox
  document.querySelectorAll('a[href$=jpg], a[href$=jpeg], a[href$=jpe], a[href$=png], a[href$=gif]').forEach(function(element) {
    let self = { componentEl: element, componentHref: element.getAttribute('href') };

    self.options = {
      el: self.componentEl,
      imgSrc: self.componentHref,
      animationEnd: () => {
        bodyScrollLock.disableBodyScroll(
          document.getElementById('bp_container'), { reserveScrollBarGap: false }
        );
      },
      onClose: () => {
        bodyScrollLock.clearAllBodyScrollLocks();
      },
    };

    self.options = Object.assign(
      self.options,
      self.componentEl.dataset.lightbox ? JSON.parse(self.componentEl.dataset.lightbox) : {}
    );

    self.componentEl.addEventListener('click', function(event) {
      event.preventDefault();

      BigPicture(self.options);
    });
  });

  // Video Lightbox
  document.querySelectorAll('.js-video-lightbox, .popup-youtube, .popup-video').forEach(function(element) {
    let self = { componentEl: element, videoID: null, mediaType: null, componentHref: element.getAttribute('href') };

    self.options = {
      el: self.componentEl,
      dimensions: [1680, 945],
      animationEnd: () => {
        bodyScrollLock.disableBodyScroll(
          document.getElementById('bp_container'), { reserveScrollBarGap: false }
        );
      },
      onClose: () => {
        bodyScrollLock.clearAllBodyScrollLocks();
      },
    };

    self.parseYouTubeID = function(url) {
      let match = url.match(/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/);

      return (match && match[7].length == 11) ? match[7] : false;
    }

    self.parseVimeoID = function(url) {
      let regExp = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
      let parseUrl = regExp.exec(url);

      return (parseUrl[5]) ? parseUrl[5] : false;
    }

    if(self.componentEl.getAttribute('href').includes('youtu')) {
      self.mediaType = 'yt';
      self.videoID = self.parseYouTubeID(self.componentEl.getAttribute('href'));
      self.options.ytSrc = self.videoID;
      self.options.ytNoCookie = true;
    }
    else if(self.componentEl.getAttribute('href').includes('vimeo')) {
      self.mediaType = 'vimeo';
      self.videoID = self.parseVimeoID(self.componentEl.getAttribute('href'));
      self.options.vimeoSrc = self.videoID;
    }
    else {
      self.mediaType = 'vid';
      self.videoID = self.componentEl.getAttribute('href');
      self.options.vidSrc = self.videoID;
    }

    self.options = Object.assign(
      self.options,
      self.componentEl.dataset.lightbox ? JSON.parse(self.componentEl.dataset.lightbox) : {}
    );

    self.componentEl.addEventListener('click', function(event) {
      event.preventDefault();

      BigPicture(self.options);
    });
  });

  // Mobile menu
  var adminBar = document.getElementById('wpadminbar');
  var adminBarEnabled = document.body.contains(adminBar) ? true : false;

  // Off canvas panel
  var targetElement = document.querySelector('.js-main-menu-mobile-scroll');
  var header = document.querySelector('.js-header');
  var navWrap = document.querySelector('.js-nav-wrap');
  var panelTrigger = document.querySelector('.js-menu-toggle');
  var panelCover = document.querySelector('.js-cover');
  var panel = document.querySelector('.js-nav');
  var menu_available = (typeof(panelTrigger) != 'undefined' && panelTrigger != null) ? true : false ;

  // Run mobile menu code only if mobile menu is available
  if(menu_available) {
    // Custom Lazy load for panel images
    panelTrigger.addEventListener('mouseover', function(){
      var elements = document.querySelectorAll('.js-lazyload-after-panel-open');
      Array.prototype.forEach.call(elements, function(el, i){
        el.setAttribute('src', el.getAttribute('data-src'));
        el.classList.remove('js-lazyload-after-panel-open');
      });
    });

    // Setting top padding for menu. It should be the same as website header element.
    function setMenuTopPadding() {
      if(adminBarEnabled) {
        navWrap.style.paddingTop = header.offsetHeight + adminBar.offsetHeight + 'px';
      }
      else {
        navWrap.style.paddingTop = header.offsetHeight + 'px';
      }
    }
    setMenuTopPadding();

    // Function for showing the mobile menu
    function showPanel() {
      setMenuTopPadding();
      bodyScrollLock.disableBodyScroll(targetElement, { reserveScrollBarGap: false});
      panelTrigger.classList.add('is-active');
      panelCover.classList.remove('pointer-events-none', 'opacity-0');
      panel.classList.remove('-translate-y-full', 'xs:translate-y-0', 'xs:translate-x-full');
      panel.classList.add('shadow-xl');
    }

    // Function for hiding the mobile menu
    function hidePanel() {
      panelTrigger.classList.remove('is-active');
      panelCover.classList.add('pointer-events-none', 'opacity-0');
      bodyScrollLock.clearAllBodyScrollLocks();
      panel.classList.add('-translate-y-full', 'xs:translate-y-0', 'xs:translate-x-full');
      panel.classList.remove('shadow-xl');
    }

    // Open panel after click in hamburger icon
    panelTrigger.addEventListener('click', function(){
      if(panelCover.classList.contains('pointer-events-none')) {
        showPanel();
      }
      else {
        hidePanel();
      }
    });

    // Close panel after click in background cover
    panelCover.addEventListener('click', function(){
      hidePanel();
    });

    // Close panel after pressing escape button on keyboard
    document.addEventListener('keyup', function(e){
      if (e.keyCode === 27) {
        if (panelTrigger.classList.contains('is-active')) {
          hidePanel();
        }
      }
    });

    // Hide mobile menu if user is changing browser width
    window.addEventListener('resize', hidePanel);
  }

  // Function that controls header status according to the distance from top
  function setHeaderStatus(scroll){
    if(document.body.contains(document.querySelectorAll('.js-header')[0])) {
      if (scroll >= 1) { 
        document.querySelectorAll('.js-header')[0].classList.add('js-header--scrolled');
      }
      else {
        document.querySelectorAll('.js-header')[0].classList.remove('js-header--scrolled');
      }
    }
  }

  // Set status on load
  if(document.body.contains(document.querySelectorAll('.js-header')[0])) {
    setHeaderStatus(window.scrollY);
  }

  // Set status during the scroll
  if(document.body.contains(document.querySelectorAll('.js-header')[0])) {
    document.addEventListener('scroll', function(){
      setHeaderStatus(window.scrollY);
    });
  }

});