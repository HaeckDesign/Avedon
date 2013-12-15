<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.12
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<div class="row">
  <div class="col-xs-12">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search" value="" name="s" id="s">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" id="searchsubmit">Search</button>
      </span>
    </div>
  </div>
</div>
</form>
