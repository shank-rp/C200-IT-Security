<?php

echo '<h1 class="invalid">Invalid Page</h1>';
echo '<div style="width:875px;margin:auto;"><p style="text-align:center">Are you sure you are supposed to have access to this page?</p><br/>';
echo '<form method="post" action="/cgi-bin/ping-cgi" >'
        . '<input type="submit" value="Check Connection!" class="button"/></form></div>';

?>