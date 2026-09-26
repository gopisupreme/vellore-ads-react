<?php
#dashboard.php
$pageDes = "Customer Dashboard";
?>
<!--TOP SEARCH SECTION-->
<section class="bottomMenu dir-il-top-fix">
    <?php $this->load->view('templates/header-index.php'); ?>
</section>
<!--DASHBOARD-->
<?php
$lid = $h_rows['u_id'];
$dsql = "SELECT * FROM `listing` WHERE `l_userid` = '$lid'";
$dres = $this->db->query($dsql);
$dcon = $dres->num_rows();
$lsql = "SELECT * FROM `reviews` WHERE `r_userid` = '$lid'";
$lres = $this->db->query($lsql);
$lcon = $lres->num_rows();
?>
<section>
    <div class="tz">
        <!--LEFT SECTION-->
        <?php $this->load->view('templates/customer-sidemenu.php'); ?>
    </div>
</section>

<!-- Modal -->
<div class="container">
    <div class="modal fade"  id="myModal" role="dialog">
        <form role="form">
            <div class="modal-dialog modal-dialog-center ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close  modal-close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Complete Your Profile</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <div class="form-group">
                            <label>Age</label>
                            <select class="browser-default">
                                <option value="" disabled selected>Choose your Age</option>
                                <option value="1">1 to 18</option>
                                <option value="2">18 to 30</option>
                                <option value="3">30 above</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputName">Area</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Enter your Area" required/>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="Enter your Address"/>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <select class="browser-default">
                                <option value="" disabled selected>Select State*</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Pincode</label>
                            <input type="text" class="form-control" id="inputPincode" placeholder="Enter your Pincode"/>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Secondary Mobile Number</label>
                            <input type="text" class="form-control" id="inputPincode" placeholder="Enter your Mobile Number"/>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="inputEmail">Our Service</label><br>
                                <input type="checkbox" id="check">
                                <label for="check">Hotel Bookings</label> <br>
                                <input type="checkbox" id="check1">
                                <label for="check1">Real Estate</label><br>
                                <input type="checkbox" id="check2">
                                <label for="check2">Health Check-up</label><br>
                                <input type="checkbox" id="check3">
                                <label for="check3">Cab Booking</label> <br>
                                <input type="checkbox" id="check4">
                                <label for="check4">Online Shopping</label> <br>
                            </div>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submitBtn">Subscibe</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $("document").ready(function() {
        //initialize all modals
        $('.modal').modal({
            dismissible: true
        });
        //call the specific div (modal)
        $('#myModal').modal('open');
    });
</script>
<style>
    .browser-default {
        height: 35px;
    }
    .modal-dialog-center {
        margin-top: 12%;
    }
    .modal-content {
        height:auto;
        overflow:auto;
    }
    .modal-body {
        max-height: calc(100vh - 212px);
        overflow-y: auto;
    }
    .submitBtn {
        margin-right: 10px !important;
    }
  @media screen and (max-width: 767px) {
         .modal-dialog-center {
        margin-top: 37% !important;
    }
    }

</style>