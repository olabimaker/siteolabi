/**
 * Type Wrapper for Related posts lite
 *
 * Version: 1.0
 * Requires: jQuery v1.9+
 *
 * Copyright (c) 2014 Ernest Marcinko
 * Under MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 */
(function($) {

  RplTypeWrapper = function(args) {
    this.init(args);
  }
  
  $.extend(RplTypeWrapper.prototype, {
     // object variables
     typeObject: '',  // the current type
     o         : null, // the options
     to        : null, // the typeObject
  
     init: function(args) {
       // do initialization here
       this.o = $.extend({
         node       : null,
         type       : 'slick',
         titleSelector: '.rpl_title',
         relevanceSelector: '.rpl_relevance',
         visibleClass: 'rpl_visible'
       }, args);
       this.create();
     },
     
     create: function() {
        switch(this.o.type) {
            case 'slick':
                this.typeObject = this.create_slick();
                break;
            default:
                this.typeObject = this.create_slick();
        }
     },
     
     arrange: function(args) { 
        switch(this.o.type) {
            case 'slick':
                this.arrange_slick(args);
                break;
            default:
                this.arrange_slick(args);
        }
     },
  
     doSomething: function() {
       // an example object method
       alert('my name is '+this.widget_name);
     },

     /* SLIP-N-SLIDE START */
     
     create_slick: function() {
       var _this = this;

       // Creating the responsive object for the slick object paramater
       var resp = [];
       var w = $(this.o.elements, this.o.node).width();
            
       for (var i=15;i>0;i--) {
          var o = {
            breakpoint : ((w+w/3)*i),
            settings : {
                slidesToShow: i,
                slidesToScroll: i,
                slide: _this.o.elements
            }
          };
          resp[i-1] = o;
       }

       

       var sl = $(this.o.node).slick({
          infinite: false,
          slidesToShow: 2,
          slidesToScroll: 2,
          slide: _this.o.elements,
          responsive: resp
       });
       
       _debug = sl;
       
       return sl;
    
     },

     arrange_slick: function(args) {
        $(this.o.node).slickRefresh();
     }

     /* SLIP-N-SLIDE END */
     
  });

})(jQuery);