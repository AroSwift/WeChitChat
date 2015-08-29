<div id="Footer">
Copyright &copy; <?php echo date('Y'); ?> We Chit Chat. All rights reserved.
<div id="Flinks">
<ul>
<li><a href="#top">Top</a></li>
<li><a href="privacy.php"<?php if(isset($footer)){ if($footer == 'privacy'){ ?> class="selp" <?php } } ?>>Privacy</a></li>
<li><a href="donate.php"<?php if(isset($footer)){ if($footer == 'donate'){ ?> class="selp" <?php } } ?>>Donate</a></li>
</ul>
</div>
</div>


</body>
</html>