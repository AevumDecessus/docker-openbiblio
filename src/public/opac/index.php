<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  session_cache_limiter(null);

  $tab = "opac";
  $nav = "home";
  $helpPage = "opac";
  $focus_form_name = "phrasesearch";
  $focus_form_field = "searchText";
  require_once("../classes/DmQuery.php");
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  $lookup = "N";
  if (isset($_GET["lookup"])) {
    $lookup = "Y";
    $helpPage = "opacLookup";
  }
  require_once("../shared/header_opac.php");
?>

<h1><?php echo $loc->getText("opac_Header");?></h1>
<?php echo $loc->getText("opac_WelcomeMsg");?>
<form name="phrasesearch" method="POST" action="../shared/biblio_search.php">
<br />
<table class="primary">
  <tr>
    <th valign="top" nowrap="yes" align="left">
      <?php echo $loc->getText("opac_SearchTitle");?>
    </td>
  </tr>
  <tr>
    <td nowrap="true" class="primary">
      <select name="searchType">
        <option value="title"><?php echo $loc->getText("opac_Title");?>
        <option value="author"><?php echo $loc->getText("opac_Author");?>
        <option value="subject"><?php echo $loc->getText("opac_Subject");?>
        <option value="all" selected><?php echo $loc->getText("opac_All");?>
      </select>
      <input type="text" name="searchText" size="30" maxlength="256">
      <input type="hidden" name="sortBy" value="default">
      <input type="hidden" name="tab" value="<?php echo H($tab); ?>">
      <input type="hidden" name="lookup" value="<?php echo H($lookup); ?>">
      <input type="submit" value="<?php echo $loc->getText("opac_Search");?>" class="button">
    </td>
  </tr>
</table>
<br>

<table class="primary">
  <tr><th valign="top" nowrap="yes" align="left"><?php
    echo $loc->getText('opac_SearchColl') ?></td>
   <th valign="top" nowrap="yes" align="left"><?php
    echo $loc->getText('opac_SearchMat') ?></td>
  </tr>
  <tr>
    <font class="small">
    <td nowrap="true" class="primary">
<script language="JavaScript">
function selectAll(ident) {
  var checkBoxes = document.getElementsByName(ident);
  for (i = 0; i < checkBoxes.length; i++) {
    if (checkBoxes[i].checked == true) {
      checkBoxes[i].checked = false;
    } else {
      checkBoxes[i].checked = true;
    }
  }
}
</script>
<input type="checkbox" name="selectall" value="select_all"
  onclick="selectAll('collec[]');"><b><?php echo $loc->getText("opac_SearchInvert"); ?></b></b><br>

<?php
  $dmQ = new DmQuery();
  $dmQ->connect();
  $dms = $dmQ->get("collection_dm");
  $dmQ->close();
  foreach ($dms as $dm) {
    echo '<input type="checkbox" value="'.$dm->getCode().
      '" name="collec[]"> '.H($dm->getDescription())."<br>\n";
  }
?>
    </td>
    <td nowrap="true" valign="top" class="primary">
<input type="checkbox" name="selectall" value="select_all"
  onclick="selectAll('material[]');"><b><?php echo $loc->getText("opac_SearchInvert"); ?></b><br>

<?php
  $dmQ = new DmQuery();
  $dmQ->connect();
  $dms = $dmQ->get("material_type_dm");
  $dmQ->close();
  foreach ($dms as $dm) {
    echo '<input type="checkbox" value="'.$dm->getCode().
      '" name="material[]"> '.H($dm->getDescription())."<br>\n";
  }
?>

</td> </tr>
</font>
</table>
</form>

<?php include("../shared/footer.php"); ?>
