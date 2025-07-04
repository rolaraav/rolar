/** This file is part of KCFinder project
  *
  *      @desc Right Click jQuery Plugin
  *   @package KCFinder
  *   @version 3.10
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license https://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license https://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link https://kcfinder.sunhater.com
  */

(function($) {
    $.fn.rightClick = function(func) {
        var events = "contextmenu rightclick";
        $(this).each(function() {
            $(this).unbind(events).bind(events, function(e) {
                e.preventDefault();
                if ($.isFunction(func))
                    func(this, e);
            });
        });
        return $(this);
    };
})(jQuery);