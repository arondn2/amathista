<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Sir Ideas, C. A.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 **/

 if (!empty($googleAnalitics)): ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', '<?php echo $googleAnalitics ?>', 'auto');
    ga('send', 'pageview');
  </script>
<?php endif ?>

<!--[if lt IE 9]>
  <script src="<?php Am::eUrl() ?>/vendor/ie-fixs.js"></script>
<![endif]-->

<script src="<?php Am::eUrl() ?>/vendor/vendor.js"></script>

<!--[if lt IE 9]>
  <script src="<?php Am::eUrl() ?>/vendor/nav-dep.js"></script>
<![endif]-->

<script src="<?php Am::eUrl() ?>/vendor/cookie-msg.js"></script>
<script type="text/javascript">
  $.cookieMsg('bottom', 'simposiumtos-web', '<?php Am::eUrl() ?>/politicas-de-privacidad');
</script>

<script src="<?php Am::eUrl() ?>/js/am.js"></script>
