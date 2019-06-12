
<div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length">
                            <form method="post" action="<?= $name_of_page ?>"><label>Show 
                            <select name="select_entries" onchange="this.form.submit()" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                            <option hidden disabled selected value></option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            </select> entries</label></form>
                            </div></div>
                            <div class="col-sm-11 col-md-5">
                            <div id="dataTable_filter" class="dataTables_filter">
                            <form method="post" action="<?php $name_of_page?>">
                            <label>Search:<input type="search" name="search_query" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                            </label></form></div></div>