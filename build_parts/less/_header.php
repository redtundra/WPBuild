<!-- 

	less.js is only used for dev.
	
	You can remove line 26 once the site is ready to go production.
	
	You will also remove the less.js script on line 32 becauase
	you'll be compiling all the less files into one nice css file
	
-->

<script type="text/javascript"> less = { env: 'development' }; </script>

<link rel="stylesheet/less" type="text/css" href="<?php bloginfo('template_url'); ?>/inc/css/main.less">
<script src="https://raw.github.com/cloudhead/less.js/master/dist/less-1.1.6.min.js" type="text/javascript"></script>