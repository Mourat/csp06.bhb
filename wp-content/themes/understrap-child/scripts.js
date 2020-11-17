/**
 * Transform menu on scroll
 */
jQuery(window).scroll(function () {
  let scroll = jQuery(window).scrollTop();
  if (scroll >= 48) {
    jQuery('.navbar').addClass('navbar-thin');
  } else {
    jQuery('.navbar').removeClass('navbar-thin');
  }
});

/**
 * Dropdown submenu on mouse over
 */
jQuery(window).on("load resize", function () {
  const $dropdown = jQuery('.dropdown');
  const $dropdownToggle = jQuery('.dropdown-toggle');
  const $dropdownMenu = jQuery('.dropdown-menu');
  const showClass = 'show';

  if (this.matchMedia("(min-width: 768px)").matches) {
    /**
     * Dropdown menu when item hover
     */
    $dropdown.hover(function () {
        const $this = jQuery(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      }, function () {
        const $this = jQuery(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  }
});




/**
 * VC Full width
 */
// jQuery(document).ready(function() {
//
//   function bs_fix_vc_full_width_row(){
//     var $elements = jQuery('[data-vc-full-width="true"]');
//     jQuery.each($elements, function () {
//       var $el = jQuery(this);
//       // $el.css('right', $el.css('left')).css('left', '');
//       $el.css('width', window.innerWidth).css('right', 0).css('left', 0).css('padding-left', 0).css('padding-right', 0);
//     });
//   }
//
//   // Fixes rows in RTL
//   jQuery(document).on('vc-full-width-row', function () {
//     bs_fix_vc_full_width_row();
//   });
//
//   // Run one time because it was not firing in Mac/Firefox and Windows/Edge some times
//   bs_fix_vc_full_width_row();
//
// });
