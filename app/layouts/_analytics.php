<?php defined('A') or die('Access denied');?>
<!-- Аналитика -->
<?php if (DOMEN == 'rolar.ru'): ?>
<!-- Google Analytics -->
<!-- Новый тег Google Analytics-4 -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T7W7HX2KSL"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-T7W7HX2KSL');
</script>
<!-- Старый тег Google Analytics -->
<!--<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-30314086-2']);
    _gaq.push(['_setDomainName', 'rolar.ru']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script> -->
<!-- /Google Analytics -->

<!-- Yandex.Metrika counter -->
<!-- Новый тег Yandex.Metrika -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(16253794, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/16253794" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- Старый тег Yandex.Metrika -->
<!--<script type="text/javascript">
   (function (d, w, c) {
       (w[c] = w[c] || []).push(function() {
           try {
               w.yaCounter16253794 = new Ya.Metrika({id:16253794,
                   webvisor:true,
                   clickmap:true,
                   trackLinks:true,
                   accurateTrackBounce:true});
           } catch(e) { }
       });

       var n = d.getElementsByTagName("script")[0],
           s = d.createElement("script"),
           f = function () { n.parentNode.insertBefore(s, n); };
       s.type = "text/javascript";
       s.async = true;
       s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

       if (w.opera == "[object Opera]") {
           d.addEventListener("DOMContentLoaded", f, false);
       } else { f(); }
   })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/16253794" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
<!-- /Yandex.Metrika counter -->


















<!--LiveInternet counter--><script type="text/javascript">new Image().src = "//counter.yadro.ru/hit?r" + escape(document.referrer) + ((typeof(screen)=="undefined")?"" : ";s"+screen.width+"*"+screen.height+"*" + (screen.colorDepth?screen.colorDepth:screen.pixelDepth)) + ";u"+escape(document.URL) +  ";" +Math.random();</script><!--/LiveInternet-->

<!-- Rating@Mail.ru counter -->
<script type="text/javascript">//<![CDATA[
    var a='',js=10;try{a+=';r='+escape(document.referrer);}catch(e){}try{a+=';j='+navigator.javaEnabled();js=11;}catch(e){}
    try{s=screen;a+=';s='+s.width+'*'+s.height;a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;}catch(e){}
    try{if(typeof((new Array).push('t'))==="number")js=13;}catch(e){}
    try{(new Image()).src='http://db.c1.b2.a2.top.mail.ru/counter?id=2235362;js='+js+a+';rand='+Math.random();}catch(e){}//]]></script>
<noscript><p><a href="http://top.mail.ru/jump?from=2235362"><img src="http://db.c1.b2.a2.top.mail.ru/counter?js=na;id=2235362"
                                                                 style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" /></a></p></noscript>
<!-- //Rating@Mail.ru counter -->
<?php endif; ?>