
<link rel="stylesheet" href="<?php echo $url;?>vendors/jsgrid/jsgrid.min.css">
<link rel="stylesheet" href="<?php echo $url;?>vendors/jsgrid/jsgrid-theme.min.css">
    
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row grid-margin">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Subsribers</h4>
                  <div id="js-grid" class="pt-3"></div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- main-panel ends -->
    <?php require_once $theme_path.'include/footer.php';?>
    <?php require $theme_path.'include/scripts.php';?>
    <script src="<?php echo $url;?>vendors/jsgrid/jsgrid.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="<?php echo $url;?>js/js-grid.js"></script>
  <script>
			(function($) {
		  'use strict';
		  $(function() {
		
			//basic config
			if ($("#js-grid").length) {
			  $("#js-grid").jsGrid({
				height: "500px",
				width: "100%",
				filtering: true,
				editing: true,
				inserting: true,
				sorting: true,
				paging: true,
				autoload: true,
				pageSize: 15,
				pageButtonCount: 5,
				deleteConfirm: "Do you really want to delete the client?",
				data: db.clients,
				fields: [{
					name: "Name",
					type: "text",
					width: 100
				  },
				  {
					name: "LName",
					type: "text",
					width: 100
				  },
				  {
					name: "E-Mail",
					type: "text",
					width: 200
				  },
				  {
					name: "status",
					type: "select",
					items: db.countries,
					valueField: "Id",
					textField: "Name"
				  },
				  {
					type: "control"
				  }
				]
			  });
			}
			//Static
			if ($("#js-grid-static").length) {
			  $("#js-grid-static").jsGrid({
				height: "500px",
				width: "100%",
		
				sorting: true,
				paging: true,
		
				data: db.clients,
		
				fields: [{
					name: "Name",
					type: "text",
					width: 100
				  },
				  {
					name: "LName",
					type: "text",
					width: 100
				  },
				  {
					name: "E-Mail",
					type: "text",
					width: 200
				  },
				  {
					name: "status",
					type: "select",
					items: db.countries,
					valueField: "Id",
					textField: "Name"
				  },
				]
			  });
			}
		
			//sortable
			if ($("#js-grid-sortable").length) {
			  $("#js-grid-sortable").jsGrid({
				height: "500px",
				width: "100%",
		
				autoload: true,
				selecting: false,
		
				controller: db,
		
				fields: [{
					name: "Name",
					type: "text",
					width: 100
				  },
				  {
					name: "LName",
					type: "text",
					width: 100
				  },
				  {
					name: "E-Mail",
					type: "text",
					width: 200
				  },
				  {
					name: "status",
					type: "select",
					items: db.countries,
					valueField: "Id",
					textField: "Name"
				  }
				]
			  });
			}
		
			if ($("#sort").length) {
			  $("#sort").on("click", function() {
				var field = $("#sortingField").val();
				$("#js-grid-sortable").jsGrid("sort", field);
			  });
			}
		
		  });
		})(jQuery);
		  </script>	  
  <script>
    (function($) {
  (function() {

    var db = {

      loadData: function(filter) {
        return $.grep(this.clients, function(client) {
          return (!filter.Name || client.Name.indexOf(filter.Name) > -1) &&
            (filter.Lname === undefined || client.Lname === filter.Lname) &&
            (!filter.E-mail || client.E-mail.indexOf(filter.E-mail) > -1) &&
            (!filter.status || client.status === filter.status);
        });
      },

      insertItem: function(insertingClient) {
        this.clients.push(insertingClient);
      },

      updateItem: function(updatingClient) {},

      deleteItem: function(deletingClient) {
        var clientIndex = $.inArray(deletingClient, this.clients);
        this.clients.splice(clientIndex, 1);
      }

    };

    window.db = db;


    db.countries = [{
        Name: "",
        Id: 0
      },
      {
        Name: "Active",
        Id: 1
      },
      {
        Name: "Inactive",
        Id: 2
      }
    ];

    db.clients = [{
        "Name": "Mayank",
        "LName": "Patel",
        "E-Mail": "mayank.patel104@gmail.com",
        "status": 1
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 1
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
      {
        "Name": "Mayank1",
        "LName": "Patel1",
        "E-Mail": "maynk.13@gmail.com",
        "status": 2
      },
    ];

  }());
})(jQuery);
  </script>
</div>