<input type="text" placeholder="Filter by any date (ex. 09-19) OR Lead Status OR Assigned To" id="Filter" style="width:400px;height:25px;margin-bottom:10px;">
<style id="search_style"></style>
<script type="text/javascript">
var searchStyle = document.getElementById('search_style');
document.getElementById('Filter').addEventListener('input', function() {
  if (!this.value) {
    searchStyle.innerHTML = "";
    return;
  }
  // look ma, no indexOf!
  searchStyle.innerHTML = ".searchable:not([data-index*=\"" + this.value.toLowerCase() + "\"]) { display: none; }";
  // beware of css injections!
});
</script>

<div id="table" class="tableContainer">
<table border="1" cellspacing="1" id="table" width="100%" class="scrollTable">
<thead class="fixedHeader">
<tr style="color:#000;">
	<th>>></th>
    <th>ID</th>
    <th>Logged</th>
    <th>Lead Status</th>
    <th>Payment Status</th>
    <th>PPL</th>
    <th colspan="2">Follow Up</th>
    <th>Lead</th>
    <th>Contact</th>
    <th>Attorneys</th>
    <th>State</th>
    <th>Logged By</th>
    <th>Assigned To</th>
</tr>
</thead>