  <div class="container">
    <h1>Learn PHP CodeIgniter Framework with AJAX and Bootstrap</h1>
    <h3>Book Store</h3>
    <br />
    <button class="btn btn-success" onclick="add_book()"><i class="fa fa-plus"></i> Add Book</button>
    <br />
    <br />
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
			<th>S.no</th>
			<th>Book ISBN</th>
			<th>Book Title</th>
			<th>Book Title</th>
			<th>Action</th>
        </tr>
      </thead>
      <tbody>
				<?php $i= 1 ; 
				$books = $this->db->query("SELECT * FROM `advertise` WHERE `status` = '1'")->result();
				foreach($books as $book){?>
				     <tr>
				         <td><?php echo $i;?></td>
				         <td><?php echo $book->name;?></td>
				         <td><?php echo $book->banner_size;?></td>
				         <td><?php echo $book->amount;?></td>
								<td>
									<button class="btn btn-warning" onclick="edit_book(<?php echo $book->id;?>)"><i class="fa fa-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_book(<?php echo $book->id;?>)"><i class="fa fa-remove"></i></button>
								</td>
				      </tr>
				     <?php $i++; } ?>
      </tbody>
    </table>

  </div>

  <script type="text/javascript">
  
    var save_method; //for save method string
    var table;


    function add_book()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
       $("#add-pre").modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_book(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('connect/adsTypeEdit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="pname"]').val(data.name);
            $('[name="psize"]').val(data.banner_size);
            $('[name="pamount"]').val(data.amount);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }



    function save()
    {
      var url;
	  var save_method = 'add';
      if(save_method == 'add')
      {
          url = "<?php echo base_url('Connect/adsTypeAdd')?>";
      }
      else
      {
        url = "<?php echo site_url('Connect/adsTypeAdd')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_book(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/book/book_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>
  
  
  <div class="modal fade" id="modal_form" tabindex="-1" >
		<div class="modal-dialog" style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -30%);">
			<div class="modal-content">
				<div class="modal-header dir-pop-head">
					<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
					<h3 class="modal-title" style="color:#fff;"> Add new ads name</h3>
				</div>
				<div class="modal-body dir-pop-body">		
					<form action="" id="form" method="post" class="form-horizontal">
						<input type="hidden" name="do" value="addRow"/>
						<label>Ads Name</label>
						<input type="text" name="pname" placeholder="Ads Name" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"/>
						<label>Ads Size</label>
						<input type="text" name="psize" placeholder="Ads Size" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"/>
						<label>Ads Amount</label>
						<input type="text" name="pamount" placeholder="Ads Amount" style="border: 1px solid #ccc; padding: 5px 10px;" required="required">
						<div class="form-group has-feedback ak-field">
							<div class="col-md-6 col-md-offset-4">
								<br><br>
								<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

  