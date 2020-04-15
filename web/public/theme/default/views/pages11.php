<?php
global $page_data;
?>
          <div class="main-panel">
          <div class="content-wrapper">
            <div class="card">
              <div class="card-body">
              <div class="row">
              <div class="col-md-1 col-sm-12"><label><h2 style="vertical-align:middle;">Lists</h2></label></div>
              </div>
              <div class="row searchbar">
              
              <div class="col-md-3 col-sm-6 col-xs-6"><input type="text" style="padding:11px 10px;" name="searchtext" id="searchtext" class="form-control  w-100 mb-10" value="Search By Title..."><br /></div>
              <div class="col-md-2 col-sm-12 col-xs-12"><a href="pages.html?reset=1" class="btn btn-info  w-100">Reset</a><br /><br /></div>
              <div class="col-md-2  col-sm-12 col-xs-12">
                  <select name="selectbox" id="selectbox" class="form-control  w-100">
                      <option value="">Select Action</option>
                  </select><br />
              </div>
              <div class="col-md-2 col-sm-12 col-xs-12"><input type="button" name="action" class="btn btn-success w-100" value="Apply"><br /><br /></div>
              <div class="col-md-2 col-sm-12"><a href="index.php?pg=admin_forms" class="btn btn-primary w-100">Add New</a><br /></div>
          </div>
              <br>
              <div class="row">
                <div class="col-12">
                <div class="table-responsive">
                  <table id="order-listing1" class="table">
                  <thead>
                    <tr>
                      <th>All</th>
                      <th>Purchased On</th>
                      <th>Customer</th>
                      <th>Ship to</th>
                      <th>Base Price</th>
                      <th>Purchased Price</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2012/08/03</td>
                      <td>Edinburgh</td>
                      <td>New York</td>
                      <td>$1500</td>
                      <td>$3200</td>
                      <td>
                      <label class="badge badge-info">On hold</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2015/04/01</td>
                      <td>Doe</td>
                      <td>Brazil</td>
                      <td>$4500</td>
                      <td>$7500</td>
                      <td>
                      <label class="badge badge-danger">Pending</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2010/11/21</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                      <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2016/01/12</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                      <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2017/12/28</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                      <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2000/10/30</td>
                      <td>Sam</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                      <label class="badge badge-info">On-hold</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2011/03/11</td>
                      <td>Cris</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                      <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2015/06/25</td>
                      <td>Tim</td>
                      <td>Italy</td>
                      <td>$6300</td>
                      <td>$2100</td>
                      <td>
                      <label class="badge badge-info">On-hold</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2016/11/12</td>
                      <td>John</td>
                      <td>Tokyo</td>
                      <td>$2100</td>
                      <td>$6300</td>
                      <td>
                      <label class="badge badge-success">Closed</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="chk" value="1" class="form-control"></td>
                      <td>2003/12/26</td>
                      <td>Tom</td>
                      <td>Germany</td>
                      <td>$1100</td>
                      <td>$2300</td>
                      <td>
                      <label class="badge badge-danger">Pending</label>
                      </td>
                      <td>
                      <button class="btn btn-outline-primary">View</button>
                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div>
                </div>
              </div>
              </div>
            </div>
            </div>
  <?php require_once $theme_path.'include/prefooter.php';?>
  <?php require $theme_path.'include/scripts.php';?>
</div>