/**
 * Related posts lite jQuery plugin
 *
 * Version: 1.0
 * Requires: jQuery v1.9+
 *
 * Copyright (c) 2014 Ernest Marcinko
 * Under MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 */
var _debug = null;

(function ($) {
    var methods = {

        init: function (options, elem) {

            var $this = this;

            this.elem = elem;
            this.$elem = $(elem);

            $this.o = $.extend({}, options);
            $this.n = new Object();
            $this.n.container = $(this.elem);

            $this.n.items = $('.rpl_item', $this.n.container);
            $this.n.isotopeContainer = $('.rpl_wrapper', $this.n.container);
            $this.n.progressInput = $('.rpl_progress', $this.n.container);

            $this.typeObject = null;
            $this.remainingTillNext = $this.o.autoplayTime;
            $this.apt = null;
            $this.then = 0;

            $this.initType();
            $this.initEvents();
            if ($this.o.autoplay)
                $this.initAutoPlay();

            return this;
        },

        initType: function () {
            var $this = this;

            $this.o.container = $this.n.container.get(0);
            $this.o.node = $this.n.isotopeContainer.get(0);

            $this.typeObject = new RplTypeWrapper($this.o);

        },

        initAutoPlay: function () {
            var $this = this;
            $this.startAutoPlay();
            if ($this.n.progressInput.length > 0)
                $this.n.progressInput.knob({
                    draw: function () {
                        // "tron" case
                        if (this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = true;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.value);
                                this.o.cursor
                                    && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.previousColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });

        },

        startAutoPlay: function () {
            var $this = this;
            $this.then = new Date().getTime();
            $this.apt = setTimeout(function () {
                $(".rpl_next", $this.n.container).click();
                $this.reStartAutoPlay();
            }, $this.o.autoplayTime);
            if ($this.n.progressInput.length > 0)
                $this.aptt = setInterval(function () {
                    var elapsed = new Date().getTime() - $this.then;
                    var newval = parseInt(elapsed / $this.o.autoplayTime * 100);
                    $this.n.progressInput
                        .val(newval)
                        .trigger('change');
                }, 50);
        },

        reStartAutoPlay: function () {
            var $this = this;
            $this.stopAutoPlay();
            $this.startAutoPlay();
        },

        stopAutoPlay: function () {
            var $this = this;
            clearTimeout($this.apt);
            if ($this.n.progressInput.length > 0) {
                clearInterval($this.aptt);
                $this.n.progressInput.attr('data-exactval', 0);
                $this.n.progressInput.val(0).trigger("change");
            }
        },

        initEvents: function () {

            var $this = this;

            $('nav>a', $this.n.container).hover(function (event) {
                // Hover In
                $('nav>a', $this.n.container).not(this).each(function () {
                    $(this).css("opacity", 0.55);

                });
            }, function (event) {
                // Hover Out
                $('nav>a', $this.n.container).not(this).each(function () {
                    $(this).css("opacity", 1);
                });
            });

            //Autoplay Events
            if ($this.o.autoplay) {
                $($this.n.container).hover(function (event) {
                    // Hover In
                    $this.stopAutoPlay();
                }, function (event) {
                    // Hover Out
                    $this.reStartAutoPlay();
                });
                $($this.n.container).click(function(){
                    $this.reStartAutoPlay();
                });
            }

        },


        func: function () {
            var $this = this;


        },

        destroy: function () {
            return this.each(function () {
                var $this = $.extend({}, this, methods);
                $(window).unbind($this);
            })
        }
    }

    function is_touch_device() {
        return !!("ontouchstart" in window) ? 1 : 0;
    }

    // Object.create support test, and fallback for browsers without it
    if (typeof Object.create !== 'function') {
        Object.create = function (o) {
            function F() {
            }

            F.prototype = o;
            return new F();
        };
    }


    // Create a plugin based on a defined object
    $.plugin = function (name, object) {
        $.fn[name] = function (options) {
            return this.each(function () {
                if (!$.data(this, name)) {
                    $.data(this, name, Object.create(object).init(
                        options, this));
                }
            });
        };
    };

    $.plugin('relatedpostslite', methods);
})(jQuery);