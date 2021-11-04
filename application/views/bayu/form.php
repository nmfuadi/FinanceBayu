<?php echo $this->session->flashdata('message');?>
<div class="holiday-package-form">
						<div class="bookingtab">
						<form  method="POST" action="<?php echo $action; ?>" id="aspnetForm" class="validateForm">
								<input name="q" type="hidden" value="Hotel">
								<input type="hidden" class="curUrl" name="curUrl" id="curUrl" value="">
								<div class="row">
									<div class="col-sm-12">
										<h4 data-translate="STRING_CONTACTDETAILS">Contact Details</h4>
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group"><label data-translate="STRING_NAME">Name</label> <input name="fullName" type="text" id="fullName" class="form-control" data-validation="required" placeholder="Name" data-type="string"></div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group"><label>Phone / Mobile</label> <input name="phoneNum" type="text" id="ctl279_phoneNum" class="form-control" data-validation="required" placeholder="Phone / Mobile" data-type="number"></div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"><label>E-mail</label> 
										<input name="email" type="text" id="mail" class="form-control" data-validation="required" placeholder="Email" data-type="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<h4 data-translate="STRING_HOLIDAYDETAILS">Hotel Details</h4>
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Check In Date</label> 
										<input type="date" class="form-control"  name="check_in" placeholder="Date of travel">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Check Out Date</label> 
										<input type="date" class="form-control" name="check_out" placeholder="Date of travel" ></div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label data-translate="STRING_ADULT">Total Room</label> 
											<select name="room" id="ctl279_adult" class="form-control">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label data-translate="STRING_CHILD">Room Type</label> 
											<select name="type" id="ctl279_child" class="form-control">
												<option value="All Type">All Type</option>
												<option value="Single Room">Single Room</option>
												<option value="Twin Room">Twin Room</option>
												<option value="Double Room">Double Room</option>
												<option value="Triple Room">Triple Room</option>
												<option value="Quad Room">Quad Room</option>
												<option value="Deluxe Room">Deluxe Room</option>
												<option value="Junior Suite Room">Junior Suite Room</option>
												<option value="Suite Room">Suite Room</option>													
												<option value="Presidential Suite">Presidential Suite</option>
												<option value="Family Room/Triple Room">Family Room/Triple Room</option>
												<option value="Interconnecting Room">Interconnecting Room</option>
												<option value="Apartment-style">Apartment-style</option>
												<option value="Accessible Room">Accessible Room</option>
												<option value="Penthouse">Penthouse</option>
												<option value="Cabana">Cabana</option>
												<option value="Villa">Villa</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group"><label data-translate="STRING_ADDITIONALREQ">Additional requirements</label> <textarea name="message" id="ctl279_message" class="form-control" data-validation="required" rows="4" data-type="string"></textarea></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											 <?php echo form_error('g-recaptcha-response'); ?>
											<?php echo $recaptcha_html;?>
										</div>
									</div>
									<div class="col-md-6">
										<ul class="list-inline pull-right">
								<!--<li>
								<input type="button" name="ctl279$btnResetCaptcha" value="Reset" onclick="javascript:__doPostBack(&#39;ctl279$btnResetCaptcha&#39;,&#39;&#39;)" id="ctl279_btnResetCaptcha" class="button reset btn btn-warning mt-15" type="reset" value="Reset" />
								</li>-->
											<li><input type="submit" name="submit" value="Submit" class="btn btn-warning mt-15"></li>
										</ul>
									</div>
								</div>
								
							</form>
						</div>
					</div>