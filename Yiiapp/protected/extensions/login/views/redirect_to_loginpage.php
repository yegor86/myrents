<form name="redirectform" method="post" action="/login?username=<?php echo urlencode($login)?>" style="width: 30px;">
    <input type="hidden" name="vronglogin" value="vronglogin" />
</form><script type="text/javascript">
document.redirectform.submit();

 </script>