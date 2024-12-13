import * as bootstrap from 'bootstrap';
import imagesLoaded from 'imagesloaded';
import Isotope from 'isotope-layout';
window.bootstrap = bootstrap;

import './components/header';

const grid = document.querySelector('.our-gallery__grid');
const isotope = new Isotope(grid, {
  itemSelector: '.grid-item',
  masonry: {}
});

imagesLoaded(grid, function () {
  isotope.layout();
});

window.addEventListener('load', function () {
  isotope.layout();
});
