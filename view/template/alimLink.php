<?php
function alimLinkTemplate($alimName)
{
  ?>
  <a href=<?= "/aliment?" . http_build_query(["alim" => $alimName]) ?>><?= $alimName ?></a>
<?php
}
